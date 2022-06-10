<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\feedback\Process;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\component\form\field\AutoComplete;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\InputNumber;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\form\field\Switches;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\FormAction;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\image\ImagePreviewGroup;
use ExAdmin\ui\component\grid\Popover;
use ExAdmin\ui\component\grid\statistic\Statistic;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\component\grid\ToolTip;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\traits\ColumnFilter;
use ExAdmin\ui\traits\Display;

/**
 * 表格列
 * Class Column
 * @method $this dataIndex(string $value) 对应列内容的字段名
 * @method $this header(string $value)    自定义内容
 * @method $this width(int $width) 宽度
 */
class Column extends Component
{
    use Display;

    protected $name = 'ATableColumn';

    protected $grid;

    protected $closure = null;

    protected $exportClosure = null;

    protected $editable = null;

    protected $when = null;

    protected $hide = false;

    protected $default = '--';

    protected $field;


    public function __construct($field, $label = '', Grid $grid)
    {
        $this->grid = $grid;
        $this->field = $field;
        $this->dataIndex($field);
        if (!empty($label)) {
            $this->attr('title', $label);
            $this->header(
                Html::create($label)->attr('class', 'ex_admin_table_th_' . $this->attr('dataIndex'))
            );
        }
    }

    public function getField()
    {
        return $this->field;
    }

    /**
     * 设置缺失值
     * @param $value
     */
    public function default($value)
    {
        $this->default = $value;
    }

    /**
     * 解析每行数据
     * @param array $data 数据
     * @param bool $export 是否导出
     * @return mixed
     */
    public function row($data, $export = false)
    {
        $originValue = Arr::get($data, $this->field);
        if (is_null($originValue)) {
            $value = $this->default;
        } else {
            $value = $originValue;
        }
        $resetClosure = [$this->editable,$this->closure,$this->exportClosure];
        //条件显示
        if (!is_null($this->when)) {
            list($condition, $closure, $other) = $this->when;
            if($condition instanceof \Closure){
                $condition = call_user_func_array($condition, [$originValue, $data]);
            }
            if ($condition) {
                call_user_func_array($closure, [$this]);
            } else {
                if ($other instanceof \Closure) {
                    call_user_func_array($other, [$this]);
                }
            }
        }
        //自定义内容显示处理
        if (!is_null($this->closure)) {
            $value = call_user_func_array($this->closure, [$originValue, $data]);
        }
        if (!is_null($this->editable)) {
            $value = call_user_func_array($this->editable, [$originValue, $data,$value]);
        }
        if ($export) {
            //自定义导出
            if (!is_null($this->exportClosure)) {
                $value = call_user_func_array($this->exportClosure, [$originValue, $data]);
            } elseif (!is_string($value) && !is_numeric($value)) {
                $value =  $originValue;
            }
        } else {
            $html = Html::create($value)->attr('class', 'ex_admin_table_td_' . $this->field);
            $fontSize = $this->grid->attr('fontSize');
            if ($fontSize) {
                $html->style(['fontSize' => $fontSize . 'px']);
            }
            $value = $html;
        }
        //重置
        [$this->editable,$this->closure,$this->exportClosure] = $resetClosure;
        return $value;
    }

    /**
     * 自定义导出
     * @param \Closure $closure
     */
    public function export(\Closure $closure)
    {
        $this->exportClosure = $closure;
        return $this;
    }

    /**
     * 关闭当前列导出
     * @return $this
     */
    public function closeExport()
    {
        $this->attr('closeExport', true);
        return $this;
    }

    /**
     * 隐藏
     * @return \Eadmin\grid\Column|$this
     */
    public function hide()
    {
        $this->hide = true;
        $this->attr('hide', true);
        return $this;
    }

    /**
     * 获取当前列是否隐藏
     * @return bool
     */
    public function isHide()
    {
        return $this->hide;
    }

    /**
     * 开启排序
     * @return $this
     */
    public function sortable()
    {
        $this->attr('sorter', true);
        return $this;
    }

    /**
     * 开关
     * @return $this
     */
    public function switch($switchArr = [[1 => '开启'], [0 => '关闭']])
    {
        $this->display(function ($value, $data) use ($switchArr) {
            return $this->getSwitch($value, $data, $this->field, $switchArr);
        });
        return $this;
    }

    /**
     * 开关组
     * @param array $fields
     * @return $this
     */
    public function switchGroup($fields)
    {
        $this->display(function ($value, $data) use ($fields) {
            $content = [];
            foreach ($fields as $field => $label) {
                $content[] = Html::create([
                    Html::create($label . ': '),
                    $this->getSwitch($data[$field], $data, $field),
                ])->style(['display' => 'flex', 'justifyContent' => 'space-between'])->tag('p');
            }
            return $content;
        });
        return $this;
    }


    /**
     * 获取开关
     * @param string $value 当前值
     * @param array $data 行数据
     * @param string $field 字段
     * @param array $switchArr 开关选项
     * @return mixed
     */
    protected function getSwitch($value, $data, $field, $switchArr = [[1 => '开启'], [0 => '关闭']])
    {
        return Switches::create(null, $value)
            ->options($switchArr)
            ->url($this->grid->attr('url'))
            ->field($field)
            ->params([
                'ex_admin_action' => 'update',
                'ids' => [$data[$this->grid->driver()->getPk()]],
            ]);
    }


    /**
     * 自定义显示
     * @param \Closure $closure
     * @return $this
     */
    public function display(\Closure $closure)
    {
        $this->closure = $closure;
        return $this;
    }
    /**
     * 条件执行
     * @param $condition
     * @param \Closure $closure
     * @param \Closure|null $other
     * @return $this
     */
    public function when($condition, \Closure $closure, $other = null)
    {
        $this->when = [$condition,$closure,$other];
        return $this;
    }

    /**
     * 可编辑
     * @param Field $editable
     * @param bool $alwaysShow 总是显示
     * @return $this
     */
    public function editable($editable = null, $alwaysShow = false)
    {
        $this->editable = function ($value,$data,$html) use($editable, $alwaysShow){
            $form = Form::create();
            $form->style(['padding' => '0px']);
            $form->layout('inline');
            $form->removeAttr('labelCol');
            $form->url($this->grid->attr('url'));
            $form->method('PUT');
            $form->params($this->grid->getCall()['params'] + [
                    'ex_admin_action' => 'update',
                    'ids' => [$data[$this->grid->driver()->getPk()]],
                ]);
            if (is_null($editable)) {
                $editable = Editable::text()->allowClear(false);
            }
            foreach ($editable->getCall() as $key => $item) {
                $arguments = $item['arguments'];
                if ($key == 0) {
                    $component = call_user_func_array([$form, $item['name']], [$this->field]);
                } else {
                    call_user_func_array([$component, $item['name']], $arguments);
                }
            }
            if ($alwaysShow) {
                $field = $component->random();
                $component->vModel($component->getModelField(), $field, $value === ''?null:$value);
                if ($component instanceof Input || $component instanceof InputNumber || $component instanceof AutoComplete) {
                    $component->style(['width'=>'100%']);
                    $component->eventCustom('blur', 'Ajax', [
                        'ex_admin_field' => $this->field,
                        'url' => $this->grid->attr('url'),
                        'data' => $this->grid->getCall()['params'] + [
                                'ex_admin_action' => 'update',
                                'ids' => [$data[$this->grid->driver()->getPk()]],
                            ],
                        'method' => 'PUT',
                    ]);
                } else {
                    $component->changeAjax($this->field, $this->grid->attr('url'), $this->grid->getCall()['params'] + [
                            'ex_admin_action' => 'update',
                            'ids' => [$data[$this->grid->driver()->getPk()]],
                        ], 'PUT');
                }

                return $component;
            } else {
                $component->default($value);
                return Html::div()->content([
                    Html::create($html),
                    Popover::create(Html::create()->tag('i')->attr('class', ['far fa-edit', 'editable-cell-icon']))
                        ->trigger('click')
                        ->content($form)
                ])->attr('class', 'ex-admin-editable-cell');
            }
        };
        return $this;

    }

    /**
     * 列筛选
     * @param Field|array $filterColumn
     */
    public function filter($filterColumn)
    {

        if (!is_array($filterColumn)) {
            $filterColumn = [$filterColumn];
        }
        $filter = $this->grid->getFilter();
        $form = Form::create([], null, $filter->form()->getModel());
        $form->actions()->hide();
        $form->removeAttr('labelCol')
            ->layout('vertical')
            ->removeAttr('url');
        foreach ($filterColumn as $item) {
            $this->filterForm($item, $form);
        }
        $form->content(
            Html::create([
                Button::create(admin_trans('antd.Grid.search'))
                    ->eventFunction('click', 'submit', [], $form)
                    ->size('small')
                    ->type('primary'),
                Button::create(admin_trans('form.reset'))
                    ->size('small')
                    ->eventFunction('click', 'form.resetFields', [], $form)
            ])
                ->style(['borderTop' => '1px solid #DCDFE6', 'paddingTop' => '10px'])
                ->tag('div')
            , 'footer');
        $this->attr('customFilterDropdown', true);
        $this->attr('customFilterForm', $form->style(['padding' => '8px']));
    }

    /**
     * @param $filterColumn
     */
    protected function filterForm($filterColumn, $form)
    {
        $filter = $this->grid->getFilter();
        foreach ($filterColumn->getCall() as $key => $item) {
            $arguments = $item['arguments'];
            if ($key == 1 && count($arguments) == 0) {
                $arguments = [$this->attr('dataIndex')];
            }
            if ($key < 2) {

                $filter = $filter->setRule($item['name'], $arguments, $form);
            } else {
                $filter = call_user_func_array([$filter, $item['name']], $arguments);
            }
        }
    }

}
