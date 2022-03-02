<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\Table;
use ExAdmin\ui\component\navigation\Pagination;

/**
 * Class Grid
 * @method static $this create($data = []) 创建
 * @method $this hideDeleteButton(bool $bool = true) 隐藏删除按钮
 * @method $this hideSelection(bool $bool = true) 隐藏选择框
 * @method $this quickSearch(bool $bool = true) 快捷搜索
 * @method $this quickSearchText(string $string) 快捷提示文本内容
 */
class Grid extends Table
{
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

    protected $data = [];

    public function __construct($data = [])
    {
        $this->pagination = Pagination::create();
        $this->addButton = new AddButton();
        $this->data = $data;
        $this->rowKey('ex_admin_id');
        parent::__construct();
    }
    /**
     * 头部
     * @param mixed $header
     */
    public function header($header)
    {
        if ($header instanceof Component || is_string($header)) {
            $header = [$header];
        }
        foreach ($header as &$item) {
            if (!($item instanceof Component)) {
                $item = Html::create($item);
            }
        }
        $this->attr('header', $header);
    }
    /**
     * 尾部
     * @param mixed $footer
     */
    public function footer($footer)
    {
        if ($footer instanceof Component || is_string($footer)) {
            $footer = [$footer];
        }
        foreach ($footer as &$item) {
            if (!($item instanceof Component)) {
                $item = Html::create($item);
            }
        }
        $this->attr('footer', $footer);
    }
    /**
     * 拖拽排序
     * @param string $field 排序字段
     * @param string $label 标题
     */
    public function sortDrag($field = 'sort', $label = null)
    {
        return $this->column($field, $label ?? ui_trans('sort', 'grid'))
            ->attr('type','sortDrag')
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
            ->attr('type','sortInput')
            ->width(100)->align('center');
    }
    /**
     * 添加表格列
     * @param string|\Closure $field 字段
     * @param string $label 显示的标题
     * @return Column
     */
    public function column($field, $label = '')
    {

        $childrenColumns = [];
        if ($field instanceof \Closure) {
            $prop = 'group' . md5($label . time());
            $childrenColumns = $this->collectColumns($field);
            $column = new Column($prop, $label, $this);
            $column->attr('children', array_column($childrenColumns, 'attribute'));
            foreach ($childrenColumns as $childrenColumn) {
                $childrenColumn->attr('children_row', true);
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
            $tableData[] = $rowData;
        }
        return $tableData;
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
        $this->attr('addButton', $this->addButton->button());
        $this->attr('pagination', $this->pagination);
        $data = $this->parseColumn($this->data);
        $this->attr('dataSource', $data);
        $this->attr('columns', array_column($this->column, 'attribute'));
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
