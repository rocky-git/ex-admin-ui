<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\grid\avatar\Avatar;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\grid\excel\AbstractExporter;
use ExAdmin\ui\component\grid\lists\Lists;
use ExAdmin\ui\component\grid\Table;
use ExAdmin\ui\component\navigation\Pagination;
use ExAdmin\ui\contract\GridAbstract;
use ExAdmin\ui\Route;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Request;


/**
 * Class Grid
 * @method static $this create($data = [], \Closure $closure = null) 创建
 * @method $this hideAdd(bool $bool = true) 隐藏添加按钮
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
 * @method $this hidePage(bool $bool = true) 关闭分页
 * @method $this hideExportCurrentPage(bool $bool = true) 隐藏导出当前页
 * @method $this hideExportSelection(bool $bool = true) 隐藏导出选中
 * @method $this hideExportAll(bool $bool = true) 隐藏导出所有
 * @method $this queueExport(bool $bool = true) 是否启动队列导出
 * @method $this quickSearchText(string $string) 快捷提示文本内容
 * @method $this url(string $url) 加载数据地址
 * @method $this params(array $params) 加载数据附加参数
 * @method $this selectionType(string $string) 选择框类型checkbox radio
 * @method $this selectionLimit(int $number) 选中数量限制
 * @method $this selectionField(string $string) 选中字段
 * @method $this selection(array $data) 选中项
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
     * @var GridAbstract
     */
    protected $driver;
    /**
     * @var Actions
     */
    protected $actionColumn;

    protected $setForm = false;

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
    //自定义列表元素
    protected $customClosure = null;
    /**
     * @var Sidebar
     */
    protected $sidebar;
    /**
     * @var Export
     */
    protected $export;
    /**
     * 快捷搜索条件
     * @var
     */
    protected $search;

    protected $exec;

    public function __construct($data = [], \Closure $closure = null)
    {
        parent::__construct();
        $this->exec = $closure;
        $manager = admin_config('admin.grid.manager');
        $this->driver = (new $manager($data, $this))->getDriver();
        $this->pagination = Pagination::create();
        //操作列
        $this->actionColumn = new Actions($this);
        $this->rowKey('ex_admin_id');
        $this->url("ex-admin/{$this->call['class']}/{$this->call['function']}");
        $this->params([]);
        $callParams = ['ex_admin_class' => $this->call['class'], 'ex_admin_function' => $this->call['function']];
        $callParams = array_merge($callParams, $this->call['params']);
        $this->attr('callParams', $callParams);
        $this->scroll(['x' => 'max-content']);
        $this->hideTrashed(!$this->driver->trashed());
        $this->hideExport();
        $this->description(admin_trans('admin.list'));
    }

    public function title($title)
    {
        return $this->attr('ex_admin_title', $title);
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return $this->driver->model();
    }

    /**
     * @return GridAbstract
     */
    public function driver()
    {
        return $this->driver;
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
     * 纯表格
     */
    public function table()
    {
        $this->hideTools();
        $this->hideSelection();
        $this->hidePage();
        $this->hideAction();
    }

    public function getColumn()
    {
        return $this->column;
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

    public function parseColumn($data, $export = false)
    {
        $columns = array_merge($this->column, $this->childrenColumn);
        $tableData = [];
        foreach ($data as $key => $row) {
            $pk = $this->driver->getPk();
            $rowData = ['ex_admin_id' => $row[$pk] ?? $key];
            $selectionField = $this->attr('selectionField') ?? $pk;
            $rowData[$selectionField] = $row[$selectionField];
            if (is_null($this->customClosure)) {
                //树形父级pid
                if ($this->isTree) {
                    $rowData['ex_admin_tree_id'] = $row[$this->treeId];
                    $rowData['ex_admin_tree_parent'] = $row[$this->treePid];
                }
                foreach ($columns as $column) {
                    $field = $column->attr('dataIndex');
                    $rowData[$field] = $column->row($row, $export);
                }
                if (!is_null($this->expandRow)) {
                    $expandRow = call_user_func($this->expandRow, $row);
                    $rowData['ExAdminExpandRow'] = Html::create($expandRow);
                }
            } else {
                $rowData['custom'] = call_user_func($this->customClosure, $row);
            }
            if (!$this->hideAction && !$export) {
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
     * 导出
     * @param string|AbstractExporter $driver
     * @return Export
     */
    public function export($driver = null)
    {
        $this->hideExport(false);
        $this->export = new Export($this);
        $this->export->filename(date('YmdHis'));
        if (is_string($driver)) {
            $this->export->filename($driver);
        } elseif ($driver instanceof AbstractExporter) {
            $this->export->resolve($driver);
        }
        return $this->export;
    }

    /**
     * @return Export
     */
    public function getExport()
    {
        return $this->export;
    }

    /**
     * 添加按钮
     * @return ActionButton
     */
    public function addButton()
    {
        $this->addButton = new ActionButton();
        $this->addButton->button()->content(admin_trans('grid.add'))
        ->type('primary')
        ->icon('<plus-outlined />');
        return $this->addButton;
    }

    /**
     * 设置添加编辑表单
     * @return ActionButton
     */
    public function setForm()
    {
        $this->setForm = true;
        return $this->actionColumn->edit();
    }

    /**
     * 设置详情
     * @return ActionButton
     */
    public function setDetail()
    {
        return $this->actionColumn->detail();
    }

    /**
     * 当前是否回收站请求
     * @return mixed
     */
    public function isTrashed()
    {
        return Request::input('ex_admin_trashed') ? true : false;
    }

    /**
     * 快捷搜索
     * @param string|array|\Closure $search
     */
    public function quickSearch($search = null)
    {
        $this->attr('quickSearch', true);
        $this->search = $search;
    }

    protected function dispatch($method)
    {
        if (Request::has('ex_admin_sidebar')) {
            $this->driver = $this->sidebar->driver();
        }
        return Container::getInstance()
            ->make(Route::class)
            ->invokeMethod($this->driver, $method, Request::input());
    }

    /**
     * 侧边栏
     * @param string $field 筛选字段
     * @param mixed $data 数据源
     * @param string $label 名称
     * @param string $id 主键
     * @return Sidebar
     */
    public function sidebar(string $field, $data, string $label = 'name', string $id = 'id')
    {
        $this->sidebar = Sidebar::create($data, $label, $id, $this);
        $this->sidebar->field($field);
        $this->attr('sidebar', $this->sidebar);
        return $this->sidebar;
    }

    /**
     * 自定义列表元素
     * @param \Closure $closure
     * @param string $container 容器标签
     * @param string $customStyle card
     * @return Lists
     */
    public function custom(\Closure $closure, $container = 'div', $customStyle = null)
    {
        $this->customClosure = $closure;
        $list = Lists::create();
        $this->attr('custom', $list);
        $list->attr('customStyle', $customStyle);
        $list->attr('container', $container);
        return $list;
    }

    public function jsonSerialize()
    {
        if ($this->exec) {
            call_user_func($this->exec, $this);
        }
        if ($this->filter) {
            if ($this->filter->isHide()) {
                $this->hideFilter();
            }
            $this->attr('filter', $this->filter->form());
        }

        $this->driver->filter($this->getFilter()->getRule());
        $this->driver->quickSearch(Request::input('quickSearch', ''), $this->search);
        if (Request::has('ex_admin_action')) {
            return $this->dispatch(Request::input('ex_admin_action'));
        }
        //添加操作列
        if (!$this->hideAction) {
            $this->column[] = $this->actionColumn->column();
        }
        //添加编辑表单
        if ($this->setForm) {
            if (!$this->addButton) {
                $this->addButton = clone $this->actionColumn->edit();
                $this->addButton->button()->content(admin_trans('grid.add'))
                    ->type('primary')
                    ->icon('<plus-outlined />');
            }
        }

        $page = Request::input('ex_admin_page', 1);
        $size = Request::input('ex_admin_size', $this->pagination->attr('pageSize'));

        if (Request::has('ex_admin_sort_field')) {
            $this->driver->tableSort(Request::input('ex_admin_sort_field'), Request::input('ex_admin_sort_by'));
        }

        $data = $this->driver->data($page, $size, $this->attr('hidePage') ? true : false);
        $total = $this->driver->getTotal();
        $this->pagination->total($total);

        $data = $this->parseColumn($data);
        if ($this->isTree) {
            $data = Arr::tree($data, 'ex_admin_tree_id', 'ex_admin_tree_parent', $this->attr('childrenColumnName') ?? 'children');
        }
        if ($this->addButton) {
            $this->attr('addButton', $this->addButton->action());
        }

        if (Request::input('grid_request_data')
            && Request::input('ex_admin_class') == $this->call['class']
            && Request::input('ex_admin_function') == $this->call['function']) {
            return [
                'data' => $data,
                'header' => $this->attr('header'),
                'footer' => $this->attr('footer'),
                'tools' => $this->attr('tools'),
                'addButton' => $this->attr('addButton'),
                'total' => $total,
                'code' => 200,
            ];
        } else {
            $this->attr('pagination', $this->pagination);
            $this->attr('dataSource', $data);
            $this->attr('columns', array_column($this->column, 'attribute'));
            return parent::jsonSerialize(); // TODO: Change the autogenerated stub
        }
    }
}
