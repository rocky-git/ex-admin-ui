<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\feedback\Process;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\form\field\Switches;
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

    protected $hide = false;

    protected $default = '--';

    public function __construct($field, $label = '', Grid $grid)
    {
        $this->grid = $grid;
        $this->dataIndex($field);
        if (!empty($label)) {
            $this->attr('title', $label);
            $this->header(
                Html::create($label)->attr('class', 'ex_admin_table_th_' . $this->attr('dataIndex'))
            );
        }
    }
    /**
     * 设置缺失值
     * @param $value
     */
    public function default($value){
        $this->default = $value;
    }
    /**
     * 解析每行数据
     * @param array $data 数据
     * @return mixed
     */
    public function row($data)
    {

        $field = $this->attr('dataIndex');
        $originValue = Arr::get($data, $field);
        if (is_null($originValue)) {
            $value = $this->default;
        } else {
            $value = $originValue;
        }
        //自定义内容显示处理
        if (!is_null($this->closure)) {
            $value = call_user_func_array($this->closure, [$originValue, $data]);
        }
        $html = Html::create($value)->attr('class', 'ex_admin_table_td_' . $field);
        $fontSize = $this->grid->attr('fontSize');
        if ($fontSize) {
            $html->style(['fontSize' => $fontSize . 'px']);
        }
        return $html;
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
     * 开启排序 #TODO 没有排序效果
     * @return $this
     */
    public function sortable()
    {
        $this->attr('sorter', true);
        return $this;
    }

    /**
     * 开关 #todo
     * @return $this
     */
    public function switch($swithArr)
    {
        $this->display(function ($value) use ($swithArr) {
            return $this->getSwitch($value, $data, $this->prop, $swithArr);
        });
        return $this;
    }

    /**
     * 开关组 #TODO
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
     * switch开关Html::create中直接使用 #TODO
     * @param string $text 开关名称
     * @param string $field 开关的字段
     * @param array $data 当前行的数据
     * @param array $switchArr 二维数组 开启的在下标0 关闭的在下标1
     *                              $arr = [
     *                              [1 => '开启'],
     *                              [0 => '关闭'],
     *                              ];
     * @return Html
     */
    public function switchHtml($text, $field, $data, $switchArr = [[1 => '开启'], [0 => '关闭']])
    {
        if (!empty($text)) $text .= "：";
        return Html::create([
            $text,
            $this->getSwitch($data[$field], $data, $field, $switchArr)
        ])->tag('p');
    }

    /**
     * 获取开关
     * @param string $value 当前值
     * @param array $data 行数据
     * @param string $field 字段
     * @param array $switchArr 开关选项
     * @return mixed
     */
    protected function getSwitch($value, $data, $field, $switchArr = [])
    {
        $params = $this->grid->getCallMethod();
        $params['eadmin_ids'] = [$data[$this->grid->drive()->getPk()]];
        return Switches::create(null, $value)
                       ->options($switchArr ?? admin_trans('admin.switch'))
                       ->url('/eadmin/batch.rest')
                       ->field($field)
                       ->params($params);
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
    
    public function filter(FilterColumn $filterColumn){
        $filter = $this->grid->getFilter();
        $form = $filter->form();
        $form->actions()->hide();
        foreach ($filterColumn->getCall() as $key=>$item){
            $arguments = $item['arguments'];
            if($key == 1 && count($arguments) == 0){
                $arguments = [$this->attr('dataIndex')];
            }
            $filter = call_user_func_array([$filter,$item['name']],$arguments);
        }
        $filter->getFormItem()->style(['display' => 'none']);
        $form->popItem();
        $this->attr('customFilterDropdown',true);
        $this->attr('customFilterForm',$filter);
    }
   
}
