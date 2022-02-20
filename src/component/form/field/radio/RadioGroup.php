<?php

namespace ExAdmin\ui\component\form\field\radio;

use ExAdmin\ui\component\Component;

/**
 * 单选框 - 按钮组
 * Class RadioGroup
 * @link    https://next.antdv.com/components/radio-cn 单选框组件
 * @method $this buttonStyle(string $style = 'outline') RadioButton 的风格样式，目前有描边和填色两种风格					outline | solid
 * @method $this disabled(bool $disabled = false) 禁选所有子单选器														boolean
 * @method $this name(string $name) RadioGroup 下所有 input[type="radio"] 的 name 属性									string
 * @method $this optionType(string $type = 'default') 用于设置 Radio options 类型										default | button
 * @method $this size(string $size = 'default') 大小，只对按钮样式生效														large | default | small
 * @method $this value(mixed $value) 用于设置当前选中的值																	any
 * @package ExAdmin\ui\component\form\field
 */
class RadioGroup extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ARadioGroup';

	
}