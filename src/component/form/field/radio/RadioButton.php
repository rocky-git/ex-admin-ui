<?php

namespace component\form\field\radio;

/**
 * 单选框 - 按钮
 * Class RadioButton
 * @link    https://next.antdv.com/components/radio-cn 单选框组件
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this checked(bool $checked = false) 指定当前是否选中															boolean
 * @method $this disabled(bool $disabled = false) 禁用 Radio															boolean
 * @method $this value(mixed $value) 根据 value 进行比较，判断是否选中														any
 * @package component\form\field
 */
class RadioButton
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ARadioButton';

	public static function create()
	{
		return new self();
	}
}