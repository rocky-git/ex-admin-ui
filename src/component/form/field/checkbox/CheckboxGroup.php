<?php

namespace ExAdmin\ui\component\form\field\checkbox;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 多选框
 * Class CheckboxGroup
 * @link   https://next.antdv.com/components/checkbox-cn 多选框组件
 * @method $this disabled(bool $disabled = true) 	整组失效																boolean
 * @method $this name(string $name) CheckboxGroup 下所有 input[type="checkbox"] 的 name 属性								string
 * @method $this value(mixed $value = []) 指定选中的选项																	string[]
 * @package ExAdmin\ui\component\form\field
 */
class CheckboxGroup extends Field
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ACheckboxGroup';

    protected $options = [];

    public function __construct($field = null, $value = [])
    {
        parent::__construct($field, $value);
    }

    /**
     * 设置选项
     * @param array $data 数据源 $data = [1 =>'选项1', 2=>'选项2'];
     * @return $this
     */
    public function options(array $data)
    {

        foreach ($data as $key => $value) {
            $this->options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        $this->attr('options', $this->options);
        return $this;
    }
    public function getOptions()
    {
        return $this->options;
    }
}
