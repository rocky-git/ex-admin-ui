<?php

namespace ExAdmin\ui\component\form\field\radio;

/**
 * 单选框
 * Class Radio
 * @link    https://next.antdv.com/components/radio-cn 单选框组件
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this checked(bool $checked = false) 指定当前是否选中															boolean
 * @method $this disabled(bool $disabled = false) 禁用 Radio															boolean
 * @method $this value(mixed $value) 根据 value 进行比较，判断是否选中														any
 * @package ExAdmin\ui\component\form\field
 */
class Radio
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ARadio';

	public static function create()
	{
		return new self();
	}
}