<?php

namespace ExAdmin\ui\component\navigation\menu;

/**
 * 菜单
 * Class MenuItemGroup
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this title(mixed $title) 分组标题                            	string|function|slot
 * @package ExAdmin\ui\component\form\field
 */
class MenuItemGroup
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASubMenu';

	public static function create()
	{
		return new self();
	}
}