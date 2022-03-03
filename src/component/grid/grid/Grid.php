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

/**
 * Class Grid
 * @method static $this create($data) 创建
 * @method $this hideDeleteButton(bool $bool = true) 隐藏清空按钮
 * @method $this hideDeleteSelection(bool $bool = true) 隐藏删除选中按钮
 * @method $this hideSelection(bool $bool = true) 隐藏选择框
 * @method $this hideTools(bool $bool = true) 隐藏工具栏
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
        $this->addButton = new AddButton();
        //操作列
        $this->actionColumn = new Actions($this);
        $this->rowKey('ex_admin_id');
        $call = $this->parseCallMethod();
        $this->url("ex-admin/{$call['class']}/{$call['function']}");
        $this->params($call['params']);
        parent::__construct();
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
                $rowData['ExadminAction'] = $actionColumn->row($data);
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
        $this->addButton->hideAddButton($bool);
    }

    /**
     * 添加按钮
     * @return AddButton
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
        $data = $this->drive->data($page, $size);
        $data = $this->parseColumn($data);

        if (Request::input('grid_request_data')) {
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
