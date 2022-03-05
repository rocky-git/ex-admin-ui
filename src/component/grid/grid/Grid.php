<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\Table;
use ExAdmin\ui\component\navigation\Pagination;
use ExAdmin\ui\contract\GridInterface;
use ExAdmin\ui\support\Request;
use ExAdmin\ui\traits\CallProvide;
use Illuminate\Support\Facades\Log;


/**
 * Class Grid
 * @method static $this create($data) 创建
 * @method $this hideDeleteButton(bool $bool = true) 隐藏清空按钮
 * @method $this hideDeleteSelection(bool $bool = true) 隐藏删除选中按钮
 * @method $this hideSelection(bool $bool = true) 隐藏选择框
 * @method $this expandFilter(bool $bool = true) 展开筛选
 * @method $this hideTools(bool $bool = true) 隐藏工具栏
 * @method $this hideExport(bool $bool = true) 隐藏导出
 * @method $this quickSearch(bool $bool = true) 快捷搜索
 * @method $this quickSearchText(string $string) 快捷提示文本内容
 * @method $this url(string $url) 加载数据地址
 * @method $this params(array $params) 加载数据附加参数
 */
class Grid extends Table
{
    use CallProvide;

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


    protected $hideAction = false;

    public function __construct($data)
    {
        $drive = ui_config('config.request_interface.grid');
        $this->drive = new $drive($data);
        $this->pagination = Pagination::create();
        $this->addButton = new ActionButton();
        $this->addButton->content(ui_trans('add', 'grid'))
            ->type('primary')
            ->icon('<plus-outlined />');
        //操作列
        $this->actionColumn = new Actions($this);
        $this->rowKey('ex_admin_id');
        $this->parseCallMethod();
        $this->url("ex-admin/{$this->call['class']}/{$this->call['function']}");
        $this->params($this->call['params']);
        $this->scroll(['x' => 'max-content']);
        parent::__construct();
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
        $this->arrayComponent($content,__FUNCTION__);
    }
    /**
     * 工具栏
     * @param mixed $content
     */
    public function tools($content)
    {
        $this->arrayComponent($content,__FUNCTION__);
    }
    /**
     * 尾部
     * @param mixed $content
     */
    public function footer($content)
    {
        $this->arrayComponent($content,__FUNCTION__);
    }
    protected function arrayComponent($content,$name){
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
     * 筛选表单
     * @param \Closure $callback
     */
    public function filter(\Closure $callback)
    {
        $filter = new Filter();
        call_user_func($callback,$filter);
        $this->drive->filter($filter->getRule());
        $this->attr('filter',$filter->form());
        return $filter;
    }
    /**
     * 拖拽排序
     * @param string $field 排序字段
     * @param string $label 标题
     */
    public function sortDrag($field = 'sort', $label = null)
    {
        return $this->column($field, $label ?? ui_trans('sort', 'grid'))
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
        return $this->column($field, $label ?? ui_trans('sort', 'grid'))
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
            $rowData = ['ex_admin_id' => $key];
            foreach ($columns as $column) {
                $field = $column->attr('dataIndex');
                $rowData[$field] = $column->row($row);
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
     * 隐藏添加按钮
     * @param bool $bool
     */
    public function hideAddButton(bool $bool = true)
    {
        $this->addButton->hide($bool);
    }

    /**
     * 添加按钮
     * @return ActionButton
     */
    public function addButton()
    {
        return $this->addButton;
    }

    public function jsonSerialize()
    {
        //添加操作列
        if (!$this->hideAction) {
            $this->column[] = $this->actionColumn->column();
        }
        $this->pagination->total($this->drive->total());
        $page = Request::input('page', 1);
        $size = Request::input('size', $this->pagination->attr('defaultPageSize'));
        $this->drive->quickSearch(Request::input('quickSearch',''));
        if(Request::has('ex_admin_sort_field')){
            $this->drive->tableSort(Request::input('ex_admin_sort_field'),Request::input('ex_admin_sort_by'));
        }
        $data = $this->drive->data($page, $size);
        $data = $this->parseColumn($data);
        $dispatch = $this->dispatch();
        if (Request::input('grid_request_data') && $dispatch['class'] == $this->call['class'] && $dispatch['function'] == $this->call['function']) {
            return [
                'data' => $data,
                'header' => $this->attr('header'),
                'tools' => $this->attr('tools'),
                'footer' => $this->attr('footer'),
                'total' => $this->drive->total(),
                'code' => 200,
            ];
        } else {
            $this->attr('addButton', $this->addButton->button());
            $this->attr('pagination', $this->pagination);
            $this->attr('dataSource', $data);
            $this->attr('columns', array_column($this->column, 'attribute'));
            return parent::jsonSerialize(); // TODO: Change the autogenerated stub
        }
    }
}
