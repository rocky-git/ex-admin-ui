<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;

/**
 * 开关
 * Class Switches
 * @link   https://next.antdv.com/components/switch-cn 开关组件
 * @method $this autofocus(bool $focus = false) 组件自动获取焦点															boolean
 * @method $this checked(bool $checked = false) 指定当前是否选中															checkedValue | unCheckedValue
 * @method $this disabled(bool $disabled = false) 是否禁用																boolean
 * @method $this loading(bool $loading = false) 加载中的开关																boolean
 * @method $this size(bool $size = 'default') 开关大小，可选值：default small												string
 * @method $this checkedChildren(mixed $content) 选中时的内容															string|slot
 * @method $this unCheckedChildren(mixed $content) 非选中时的内容															string|slot
 * @method $this checkedValue(mixed $value = true) 选中时的值															boolean | string | number
 * @method $this unCheckedValue(mixed $value = false) 非选中时的值														boolean | string | number
 * @package ExAdmin\ui\component\form\field
 */
class Switches extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASwitch';

	public static function create()
	{
		return new self();
	}
}