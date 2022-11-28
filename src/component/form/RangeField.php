<?php

namespace ExAdmin\ui\component\form;

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
        $this->vModel('startValue',$startField,null);
        $this->vModel('endValue', $endField,null);
        parent::__construct(null, $value);
    }
    public function getStartField(){
        return $this->startField;
    }
    public function getEndField(){
        return $this->endField;
    }
    public function modelValue()
    {
        parent::modelValue();
        $this->removeBind($this->startField);
        $this->removeBind($this->endField);
        $this->exceptField($this->field);
        $values = [];
        $value = $this->bindAttrValue('startValue',$this->startField);
        if(!is_null($value)){
            $values[] = $value;
        }
        $value = $this->bindAttrValue('endValue',$this->endField);
        if(!is_null($value)){
            $values[] = $value;
        }
        $this->value = $values;
        $this->form->inputDefault($this->field, $this->value);
    }
    protected function bindAttrValue($attr,$field){
        $this->form->inputDefault($field);
        $value = $this->form->input($field);
        $bindField = $this->form->getBindField($field);
        $this->bindAttr($attr, $bindField,true);
        return $value;
    }
    /**
     * 设置缺省默认值
     * @param array $value
     * @return $this|RangePicker
     */
    public function default($value)
    {
        return $this->setValueArg('inputDefault',$value);
    }

    /**
     * 设置值
     * @param array $value
     * @return $this|RangePicker
     */
    public function value($value)
    {
        return $this->setValueArg('input',$value);
    }
    protected function setValueArg($method,$value){
        if (count($value) == 0) {
            $value = [null, null];
        }
        if (count($value) != 2) {
            throw new \Exception('传递数组参数至少2个元素');
        }
        [$startValue, $endValue] = $value;
        $this->formItem->form()->$method($this->field, $value);
        $this->formItem->form()->$method($this->startField, $startValue);
        $this->formItem->form()->$method($this->endField, $endValue);
        return $this;
    }
}
