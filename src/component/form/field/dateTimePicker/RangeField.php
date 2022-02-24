<?php

namespace ExAdmin\ui\component\form\field\dateTimePicker;

use ExAdmin\ui\component\form\Field;

class RangeField extends Field
{

    protected $startField;
    
    protected $endField;

    public function __construct($startField, $endField, $value = [])
    {
        $this->startField = $startField;
        $this->endField = $endField;
        $this->attr('startField', $startField);
        $this->attr('endField', $endField);
        parent::__construct(null, $value);
    }
    
    public function modelValue()
    {
        $field = $this->bindAttr($this->vModel);
        $this->formItem->form()->setData($field, $this->value);
        $this->removeBind($field);
        $bindField = $this->formItem->form()->getBindField($field);
        $this->bindAttr($this->vModel, $bindField, true);
        $bindFields = [
            'startField',
            'endField',
        ];
        foreach ($bindFields as $field) {
            $bindField = $this->attr($field);
            $this->formItem->form()->setData($bindField);
            $bindField = $this->formItem->form()->getBindField($bindField);
            $this->attr($field, $bindField);
        }
    }

    /**
     * 设置缺省默认值
     * @param array $value
     * @return $this|RangePicker
     */
    public function default($value)
    {
        if(count($value) ==0){
            $value = [null,null];
        }
        if(count($value) != 2){
            throw new \Exception('传递数组参数至少2个元素');
        }
        [$startValue,$endValue] = $value;
        $this->formItem->form()->setData($this->field,$value,$value);
        $this->formItem->form()->setData($this->startField ,$startValue);
        $this->formItem->form()->setData($this->endField ,$endValue);
        return $this;

    }

    /**
     * 设置值
     * @param array $value
     * @return $this|RangePicker
     */
    public function value($value)
    {
        if(count($value) ==0){
            $value = [null,null];
        }
        if(count($value) != 2){
            throw new \Exception('传递数组参数至少2个元素');
        }
        [$startValue,$endValue] = $value;
        $this->formItem->form()->setData($this->field,$value,true);
        $this->formItem->form()->setData($this->startField ,$startValue,true);
        $this->formItem->form()->setData($this->endField ,$endValue,true);
        return $this;
    }
}
