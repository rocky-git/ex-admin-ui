<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-01
 * Time: 16:23
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\Field;

class CheckboxTag extends Field
{
    protected $name = 'ExCheckboxTag';

    public function __construct($field = null, $value = [])
    {
        parent::__construct($field, $value);
    }
    /**
     * 选项
     * @param array $data 数据
     * @return $this
     */
    public function options(array $data)
    {
        $options = [];
        foreach ($data as $key => $value) {
            $options[] = [
                'value' => $key,
                'label' => $value,
            ];
        }
        $this->attr('options', $options);
        return $this;
    }
}