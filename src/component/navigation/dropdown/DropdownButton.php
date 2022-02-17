<?php

namespace component\navigation\dropdown;

/**
 * 下拉菜单 - 按钮
 * Class DropdownButton
 * @link   https://next.antdv.com/components/dropdown-cn 下拉菜单组件
 * @method $this disabled(bool $disabled) 菜单是否禁用								                                    boolean
 * @method $this icon(mixed $icon) 右侧的 icon								                                            VNode | slot
 * @method $this overlay(mixed $overlay) 菜单								                                            Menu
 * @method $this placement(string $placement = 'bottomLeft') 菜单弹出位置：
 *                                              bottomLeft bottomCenter bottomRight topLeft topCenter topRight          string
 * @method $this size(string $size = 'default') 按钮大小，和 Button 一致		                                            string
 * @method $this trigger(mixed $trigger = ['hover']) 触发下拉的行为, 移动端不支持 hover		                                Array<click|hover|contextmenu>
 * @method $this type(string $type = 'default') 按钮类型，和 Button 一致		                                            string
 * @method $this visible(bool $visible) 菜单是否显示								                                        boolean
 * @package component\form\field
 */
class DropdownButton
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ADropdownButton';

	public static function create()
	{
		return new self();
	}
}