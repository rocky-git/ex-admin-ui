<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\grid\Grid;
use ExAdmin\ui\support\Arr;

/**
 * 表格列
 * Class Column
 * @method $this dataIndex(string $value) 对应列内容的字段名
 * @method $this header(string $value)    自定义内容
 */
class Column extends Component
{
    protected $name = 'ATableColumn';

    protected $grid;

    public function __construct($field, $label, Grid $grid){
        $this->grid = $grid;
        $this->dataIndex($field);
        if (!empty($label)) {
            $this->attr('title',$label);
            $this->header(
                Html::create($label)->attr('class', 'ex_admin_table_th_' . $this->attr('dataIndex'))
            );
        }
    }
    /**
     * 解析每行数据
     * @param array $data 数据
     * @return mixed
     */
    public function row($data){

        $field = $this->attr('dataIndex');
        $originValue = Arr::get($data, $field);
        if (is_null($originValue)) {
            //空默认占位符
            $value = '--';
        } else {
            $value = $originValue;
        }
        $html = Html::create($value)->attr('class', 'ex_admin_table_td_' . $field);
        $fontSize = $this->grid->attr('fontSize');
        if ($fontSize) {
            $html->style(['fontSize' => $fontSize . 'px']);
        }
        return $html;
    }
}
