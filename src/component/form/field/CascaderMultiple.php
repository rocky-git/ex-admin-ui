<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * 级联选择
 * Class CascaderMultiple
 * @package ExAdmin\ui\component\form\field
 */
class CascaderMultiple extends Cascader
{
    public function __construct(...$arguments)
    {
        $this->attr('relation', array_shift($arguments));
        parent::__construct($arguments);
    }

    public function modelValue()
    {
        $form = $this->formItem->form();
        $form->except($this->field);
        $relation = $this->attr('relation');
        $data = $form->input($relation) ?? [];
        $form->input($relation, $data);
        $data = $this->parseRelationData($data);
        $form->input($this->field, $data);
        $this->removeBind($this->field);
        $field = $form->getBindField($this->field);
        $this->bindAttr($this->vModel, $field, true);
        $this->attr('bindField', $this->attr('fields'));
        $this->attr('relation',$form->getBindField($relation));
        foreach ($this->attr('fields') as $bindField) {
            $form->removeInput($bindField);
        }
    }

    /**
     * 解析关联数据成Cascader绑定数据格式
     * @param $data
     * @return array
     */
    protected function parseRelationData($data)
    {
        $bindData = [];
        foreach ($data as $row) {
            $value = [];
            foreach ($this->attr('fields') as $field) {
                $value[] = $row[$field];
            }

            $bindData[] = $value;
        }
        return $bindData;
    }
}
