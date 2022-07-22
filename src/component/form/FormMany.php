<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-22
 * Time: 21:00
 */

namespace ExAdmin\ui\component\form;


use ExAdmin\ui\component\Component;

/**
 * Class FormMany
 * @method static $this create($field = null,$value = []) 创建
 * @method $this table(bool $value=true) 表格模式
 * @method $this disabled(bool $disabled = true) 是否禁用状态								 	boolean
 * @method $this limit(int $value) 限制数量
 * @package ExAdmin\ui\component\form
 */
class FormMany extends Field
{
    protected $name = 'ExFormMany';

    protected $vModel = 'value';
    public function __construct($field = null,$value = [])
    {
        parent::__construct($field,$value);
    }

    /**
     * 可拖拽
     * @return $this
     */
    public function drag(){
        $this->attr('drag',true);
        $columns = $this->attr('columns');
        array_unshift($columns,[
            'type' => 'sortDrag',
            'align' => 'center',
            'dataIndex' => 'sortDrag',
        ]);
        $this->attr('columns',$columns);
        return $this;
    }
}
