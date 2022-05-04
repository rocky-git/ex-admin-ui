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
    public function getStartField(){
        return $this->startField;
    }
    public function getEndField(){
        return $this->endField;
    }
    public function modelValue()
    {
        parent::modelValue();
        $form = $this->formItem->form();
        $form->except($this->field);
        $bindFields = [
            'startField',
            'endField',
        ];
        foreach ($bindFields as $field) {
            $bindField = $this->attr($field);
            $form->inputDefault($bindField);
            $bindField = $form->getBindField($bindField);
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
        if (count($value) == 0) {
            $value = [null, null];
        }
        if (count($value) != 2) {
            throw new \Exception('传递数组参数至少2个元素');
        }
        [$startValue, $endValue] = $value;
        $this->formItem->form()->inputDefault($this->field, $value);
        $this->formItem->form()->inputDefault($this->startField, $startValue);
        $this->formItem->form()->inputDefault($this->endField, $endValue);
        return $this;

    }

    /**
     * 设置值
     * @param array $value
     * @return $this|RangePicker
     */
    public function value($value)
    {
        if (count($value) == 0) {
            $value = [null, null];
        }
        if (count($value) != 2) {
            throw new \Exception('传递数组参数至少2个元素');
        }
        [$startValue, $endValue] = $value;
        $this->formItem->form()->input($this->field, $value);
        $this->formItem->form()->input($this->startField, $startValue);
        $this->formItem->form()->input($this->endField, $endValue);
        return $this;
    }
}
