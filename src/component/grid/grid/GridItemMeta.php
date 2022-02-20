<?php

namespace ExAdmin\ui\component\grid\grid;

/**
 * 列表
 * Class GridItemMeta
 * @link    https://next.antdv.com/components/list-cn 列表组件
 * @method $this avatar(mixed $avatar) 列表元素的图标                                        								slot
 * @method $this description(mixed $description) 列表元素的描述内容                                        				string|slot
 * @method $this title(mixed $title) 列表元素的标题                                 										string|slot
 * @package ExAdmin\ui\component\form\field
 */
class GridItemMeta
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AListItemMeta';

	public static function create()
	{
		return new self();
	}
}