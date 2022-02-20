<?php

namespace ExAdmin\ui\component\form\field\checkbox;

/**
 * 多选框
 * Class Checkbox
 * @link   https://next.antdv.com/components/checkbox-cn 多选框组件
 * @method $this autofocus(bool $focus = false) 	自动获取焦点															boolean
 * @method $this checked(bool $checked = false) 指定当前是否选中															boolean
 * @method $this disabled(bool $disabled = false) 失效状态																boolean
 * @method $this indeterminate(bool $disabled = false) 设置 indeterminate 状态，只负责样式控制								boolean
 * @method $this value(mixed $value) 与 CheckboxGroup 组合使用时的值														boolean | string | number
 * @package ExAdmin\ui\component\form\field
 */
class Checkbox
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACheckbox';

	public static function create()
	{
		return new self();
	}
}