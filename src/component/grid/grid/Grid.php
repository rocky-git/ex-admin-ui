<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\grid\avatar\Avatar;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\Table;
use ExAdmin\ui\component\navigation\Pagination;
use ExAdmin\ui\contract\GridInterface;
use ExAdmin\ui\Route;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Request;
use ExAdmin\ui\traits\CallProvide;
use Illuminate\Support\Facades\Log;


/**
 * Class Grid
 * @method static $this create($data) 创建
 * @method $this hideDelete(bool $bool = true) 隐藏清空按钮
 * @method $this hideDeleteSelection(bool $bool = true) 隐藏删除选中按钮
 * @method $this hideSelection(bool $bool = true) 隐藏选择框
 * @method $this expandFilter(bool $bool = true) 展开筛选
 * @method $this hideTools(bool $bool = true) 隐藏工具栏
 * @method $this hideTrashed(bool $bool = true) 隐藏回收站
 * @method $this hideTrashedDelete(bool $bool = true) 隐藏回收站删除按钮
 * @method $this hideTrashedRestore(bool $bool = true) 隐藏回收站恢复按钮
 * @method $this hideFilter(bool $bool = true) 隐藏筛选
 * @method $this hideExport(bool $bool = true) 隐藏导出
 * @method $this quickSearch(bool $bool = true) 快捷搜索
 * @method $this quickSearchText(string $string) 快捷提示文本内容
 * @method $this url(string $url) 加载数据地址
 * @method $this params(array $params) 加载数据附加参数
 */
class Grid extends Table
{
    use GridEvent;

    protected $name = 'ExGrid';
    /**
     * @var Column
     */
    protected $column = [];
    /**
     * @var Column
     */
    protected $childrenColumn = [];
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * @var AddButton
     */
    protected $addButton;
    /**
     * @var GridInterface
     */
    protected $drive;
    /**
     * @var Actions
     */
    protected $actionColumn;
    /**
     * @var ActionButton
     */
    protected $setForm;
    /**
     * @var Filter
     */
    protected $filter = null;
    //展开行
    protected $expandRow = null;

    protected $hideAction = false;
    //是否开启树形表格
    protected $isTree = false;
    //树形上级id
    protected $treePid;
    //树形id
    protected $treeId;

    public function __construct($data)
    {
        parent::__construct();
        $drive = admin_config('admin.request_interface.grid');
        $this->drive = (new $drive($data, $this))->getDriver();
        $this->pagination = Pagination::create();
        //操作列
        $this->actionColumn = new Actions($this);
        $this->rowKey('ex_admin_id');
        $this->url("ex-admin/{$this->call['class']}/{$this->call['function']}");
        $this->params($this->call['params']);
        $this->scroll(['x' => 'max-content']);
        $this->hideTrashed(!$this->drive->trashed());
    }

    public function drive()
    {
        return $this->drive;
    }

    /**
     * 头部
     * @param mixed $content
     */
    public function header($content)
    {
        $this->arrayComponent($content, __FUNCTION__);
    }

    /**
     * 工具栏
     * @param mixed $content
     */
    public function tools($content)
    {
        $this->arrayComponent($content, __FUNCTION__);
    }

    /**
     * 尾部
     * @param mixed $content
     */
    public function footer($content)
    {
        $this->arrayComponent($content, __FUNCTION__);
    }

    protected function arrayComponent($content, $name)
    {
        if ($content instanceof Component || is_string($content)) {
            $content = [$content];
        }
        foreach ($content as &$item) {
            if (!($item instanceof Component)) {
                $item = Html::create($item);
            }
        }
        $this->attr($name, $content);
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        if (is_null($this->filter)) {
            $this->filter = new Filter();
        }
        return $this->filter;
    }

    /**
     * 筛选表单
     * @param \Closure $callback
     * @return Filter
     */
    public function filter(\Closure $callback)
    {
        $this->getFilter();
        call_user_func($callback, $this->filter);
        $this->drive->filter($this->filter->getRule());
        return $this->filter;
    }

    /**
     * 头像昵称咧
     * @param string $avatar 头像
     * @param string $nickname 昵称
     * @param string $label 标签
     * @return Column
     */
    public function userInfo($avatar = 'avatar', $nickname = 'nickname', $label = null)
    {
        if (is_null($label)) {
            $label = admin_trans('admin.user_info');
        }
        $column = $this->column($nickname, $label);
        return $column->display(function ($val, $data) use ($column, $avatar) {
            $avatarValue = Arr::get($data, $avatar);
            $image = Avatar::create()
                ->size(50)
                ->src($avatarValue);
            return Html::create()->content($image)->content("<br>{$val}");
        })->align('center');
    }

    /**
     * 开启树形表格
     * @param string $pidField 父级字段
     * @param string $idField 下级字段
     * @param bool $expand 是否展开
     */
    public function tree($pidField = 'pid', $idField = 'id', $expand = true)
    {
        $this->treePid = $pidField;
        $this->treeId = $idField;
        $this->isTree = true;
        $this->hidePage();
        $this->defaultExpandAllRows($expand);
    }

    /**
     * 展开行
     * @param \Closure $closure
     * @param bool $defaultExpandAllRow 默认是否展开
     */
    public function expandRow(\Closure $closure, bool $defaultExpandAllRow = false)
    {
        $this->expandRow = $closure;
        $this->attr('expandedRow', true);
        $this->defaultExpandAllRows($defaultExpandAllRow);
    }

    /**
     * 拖拽排序
     * @param string $field 排序字段
     * @param string $label 标题
     */
    public function sortDrag($field = 'sort', $label = null)
    {
        return $this->column($field, $label ?? admin_trans('grid.sort'))
            ->attr('type', 'sortDrag')
            ->width(50)
            ->align('center');
    }

    /**
     * 输入框排序
     * @param string $field 排序字段
     * @param string $label 标题
     * @return Column
     */
    public function sortInput($field = 'sort', $label = null)
    {
        return $this->column($field, $label ?? admin_trans('grid.sort'))
            ->attr('type', 'sortInput')
            ->width(100)
            ->align('center');
    }

    /**
     * 操作列定义
     * @param \Closure|null $closure
     * @return Column
     */
    public function actions(\Closure $closure = null)
    {
        if (!is_null($closure)) {
            $this->actionColumn->setClosure($closure);
        }
        return $this->actionColumn->column();
    }

    /**
     * 添加表格列
     * @param string|\Closure $field 字段
     * @param string $label 显示的标题
     * @return Column
     */
    public function column($field, $label = '')
    {
        if ($field instanceof \Closure) {
            $childrenColumns = $this->collectColumns($field);
            $column = new Column(null, $label, $this);
            $column->attr('children', array_column($childrenColumns, 'attribute'));
            foreach ($childrenColumns as $childrenColumn) {
                $this->childrenColumn[] = $childrenColumn;
            }
        } else {
            $column = new Column($field, $label, $this);
        }
        $this->column[] = $column;
        return $column;
    }

    /**
     * 关闭分页
     * @param bool $bool
     */
    public function hidePage(bool $bool = true)
    {
        $this->attr('hidePage', $bool);
    }

    /**
     * 分页组件
     * @return Pagination
     */
    public function pagination()
    {
        return $this->pagination;
    }

    public function collectColumns(\Closure $closure)
    {
        $offset = count($this->column);
        call_user_func($closure, $this);
        $columns = array_slice($this->column, $offset);
        $this->column = array_slice($this->column, 0, $offset);
        return $columns;
    }

    protected function parseColumn($data)
    {
        $columns = array_merge($this->column, $this->childrenColumn);
        $tableData = [];
        foreach ($data as $key => $row) {

            $rowData = ['ex_admin_id' => $row[$this->drive->getPk()] ?? $key];
            //树形父级pid
            if ($this->isTree) {
                $rowData['ex_admin_tree_id'] = $row[$this->treeId];
                $rowData['ex_admin_tree_parent'] = $row[$this->treePid];
            }
            foreach ($columns as $column) {
                $field = $column->attr('dataIndex');
                $rowData[$field] = $column->row($row);
            }
            if (!is_null($this->expandRow)) {
                $expandRow = call_user_func($this->expandRow, $row);
                $rowData['ExAdminExpandRow'] = Html::create($expandRow);
            }
            if (!$this->hideAction) {
                $actionColumn = clone $this->actionColumn;
                $rowData[$actionColumn->column()->attr('dataIndex')] = $actionColumn->row($row);
            }
            $tableData[] = $rowData;
        }
        return $tableData;
    }

    /**
     * 隐藏操作列
     * @param bool $bool
     */
    public function hideAction(bool $bool = true)
    {
        $this->hideAction = $bool;
    }


    /**
     * 添加按钮
     * @return ActionButton
     */
    public function addButton()
    {
        $this->addButton = new ActionButton();
        return $this->addButton;
    }

    /**
     * 设置添加编辑表单
     * @return ActionButton
     */
    public function setForm()
    {
        $this->setForm = new ActionButton();
        return $this->setForm;
    }

    /**
     * 当前是否回收站请求
     * @return mixed
     */
    public function isTrashed()
    {
        return Request::input('ex_admin_trashed') ? true : false;
    }

    protected function dispatch($method)
    {
        return Container::getInstance()
            ->make(Route::class)
            ->invokeMethod($this->drive, $method, Request::input());
    }

    public function jsonSerialize()
    {
        if (Request::has('ex_admin_action')) {
            return $this->dispatch(Request::input('ex_admin_action'));
        }
        if ($this->filter) {
            if ($this->filter->isHide()) {
                $this->hideFilter();
            }
            $this->attr('filter', $this->filter->form());
        }
        //添加操作列
        if (!$this->hideAction) {
            $this->column[] = $this->actionColumn->column();
        }
        //添加编辑表单
        if ($this->setForm) {
            $this->addButton = clone $this->setForm;
            $this->actionColumn->setEditButton($this->setForm);
        }
        //添加按钮
        if ($this->addButton) {
            $this->addButton->button()->content(admin_trans('grid.add'))
                ->type('primary')
                ->icon('<plus-outlined />');
        }
        $this->pagination->total($this->drive->total());
        $page = Request::input('page', 1);
        $size = Request::input('size', $this->pagination->attr('defaultPageSize'));
        $this->drive->filter($this->getFilter()->getRule());
        $this->drive->quickSearch(Request::input('quickSearch', ''));
        if (Request::has('ex_admin_sort_field')) {
            $this->drive->tableSort(Request::input('ex_admin_sort_field'), Request::input('ex_admin_sort_by'));
        }
        $data = $this->drive->data($page, $size);

        $data = $this->parseColumn($data);
        if ($this->isTree) {
            $data = Arr::tree($data, 'ex_admin_tree_id', 'ex_admin_tree_parent', $this->attr('childrenColumnName') ?? 'children');
        }
        if (Request::has('ex_admin_export')) {
            return $this->dispatch('export');
        }
        if (Request::input('grid_request_data') && Request::input('ex_admin_class') == $this->call['class'] && Request::input('ex_admin_function') == $this->call['function']) {
            return [
                'data' => $data,
                'header' => $this->attr('header'),
                'tools' => $this->attr('tools'),
                'footer' => $this->attr('footer'),
                'total' => $this->drive->total(),
                'code' => 200,
            ];
        } else {
            if ($this->addButton) {
                $this->attr('addButton', $this->addButton->action());
            }
            $callParams = ['ex_admin_class' => $this->call['class'], 'ex_admin_function' => $this->call['function']];
            $callParams = array_merge($callParams, $this->call['params']);
            $this->attr('callParams', $callParams);
            $this->attr('pagination', $this->pagination);
            $this->attr('dataSource', $data);
            $this->attr('columns', array_column($this->column, 'attribute'));
            return parent::jsonSerialize(); // TODO: Change the autogenerated stub
        }
    }
}
