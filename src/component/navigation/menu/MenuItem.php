<?php

namespace component\navigation\menu;

/**
 * 菜单
 * Class MenuItem
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this disabled(bool $disabled = false) 是否禁用                            	boolean
 * @method $this key(string $key) item 的唯一标志                            			string
 * @method $this title(mixed $title) 设置收缩时展示的悬浮标题                            	string | slot
 * @method $this icon(mixed $icon) 菜单图标                           					slot
 * @package component\form\field
 */
class MenuItem
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AMenuItem';

	public static function create()
	{
		return new self();
	}
}