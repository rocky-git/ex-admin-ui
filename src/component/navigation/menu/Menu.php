<?php

namespace ExAdmin\ui\component\navigation\menu;

/**
 * 菜单
 * Class Menu
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this forceSubMenuRender(bool $forceSubMenuRender = false) 在子菜单展示之前就渲染进 DOM                            boolean
 * @method $this inlineCollapsed(bool $inlineCollapsed) inline 时菜单是否收起状态                                            boolean
 * @method $this inlineIndent(int $inlineIndent = 24) inline 模式的菜单缩进宽度                                            number
 * @method $this mode(string $mode = 'vertical') 菜单类型，现在支持垂直、水平、和内嵌模式三种                                    string
 * @method $this multiple(bool $multiple = false) 是否允许多选                                                            boolean
 * @method $this openKeys(mixed $openKeys) 当前展开的 SubMenu 菜单项 key 数组                                                string[]
 * @method $this selectable(bool $selectable = true) 是否允许选中                                                            boolean
 * @method $this selectedKeys(mixed $selectedKeys) 当前选中的菜单项 key 数组                                                string[]
 * @method $this subMenuCloseDelay(int $subMenuCloseDelay = 0.1) 用户鼠标离开子菜单后关闭延时，单位：秒                        number
 * @method $this subMenuOpenDelay(int $forceSubMenuRender = 0) 用户鼠标进入子菜单后开启延时，单位：秒                            number
 * @method $this theme(string $theme = 'light') 主题颜色                                                                    string: light dark
 * @method $this triggerSubMenuAction(string $triggerSubMenuAction = 'hover') 修改 Menu 子菜单的触发方式                    click | hover
 * @package ExAdmin\ui\component\form\field
 */
class Menu
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AMenu';

	public static function create()
	{
		return new self();
	}
}