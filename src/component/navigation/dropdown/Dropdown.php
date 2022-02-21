<?php

namespace ExAdmin\ui\component\navigation\dropdown;

use ExAdmin\ui\component\Component;

/**
 * 下拉菜单
 * Class Dropdown
 * @link   https://next.antdv.com/components/dropdown-cn 下拉菜单组件
 * @method $this disabled(bool $disabled) 菜单是否禁用								                                    boolean
 * @method $this overlayClassName(string $overlayClassName) 下拉根元素的类名称								                string
 * @method $this overlayStyle(mixed $overlayStyle) 下拉根元素的样式								                        object
 * @method $this placement(string $placement = 'bottomLeft') 菜单弹出位置：
 *                                              bottomLeft bottomCenter bottomRight topLeft topCenter topRight          string
 * @method $this trigger(mixed $trigger = ['hover']) 触发下拉的行为, 移动端不支持 hover		                                Array<click|hover|contextmenu>
 * @method $this visible(bool $visible) 菜单是否显示								                                        boolean
 * @package ExAdmin\ui\component\form\field
 */
class Dropdown extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ADropdown';

	
}