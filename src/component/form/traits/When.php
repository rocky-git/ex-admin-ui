<?php

namespace ExAdmin\ui\component\form\traits;

trait When
{
    /**
     *
     * @param $operator
     * @param $value
     * @param null $closure
     * @return $this
     */
    public function when($operator, $value, $closure = null)
    {
        if (func_num_args() == 2) {
            $closure  = $value;
            $value    = $operator;
            $operator = '=';
        }
        if ($operator == 'in') {
            $operator = '=';
        }
        $form = $this->formItem->form();
        $formItems = $form->collectFields($closure);
        $field = $form->getBindField($this->field);
        $form->except($field);
        foreach ($formItems as $formItem) {
            $formItem->where(function($where) use($value,$operator,$field){
                if (is_array($value)) {
                    foreach ($value as $val) {
                        if ($operator == 'notIn') {
                            $where->where($field, $operator, $val);
                        } else {
                            $where->whereOr($field, $operator, $val);
                        }
                    }

                } else {
                    $where->where($field, $operator, $value);
                }
            });
            $form->push($formItem);
        }
        return $this;
    }
}
