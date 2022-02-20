<?php

namespace ExAdmin\ui\component\form\field\checkbox;

use ExAdmin\ui\component\Component;

/**
 * 多选框
 * Class CheckboxGroup
 * @link   https://next.antdv.com/components/checkbox-cn 多选框组件
 * @method $this disabled(bool $disabled = false) 	整组失效																boolean
 * @method $this name(string $name) CheckboxGroup 下所有 input[type="checkbox"] 的 name 属性								string
 * @method $this options(mixed $options = []) 指定可选项，可以通过 slot="label" slot-scope="option" 定制label				string[] | Array<{ label: string value: string disabled?: boolean, indeterminate?: boolean, onChange?: function }>												boolean
 * @method $this value(mixed $value = []) 指定选中的选项																	string[]
 * @package ExAdmin\ui\component\form\field
 */
class CheckboxGroup extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACheckboxGroup';

	
}