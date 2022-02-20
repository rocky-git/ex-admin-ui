<?php

namespace ExAdmin\ui\component\grid\grid;

/**
 * 列表
 * Class GridItem
 * @link    https://next.antdv.com/components/list-cn 列表组件
 * @method $this actions(mixed $actions) 列表操作组，根据 itemLayout 的不同, 位置在卡片底部或者最右侧                                   Array<vNode>/
 * @method $this extra(mixed $extra) 额外内容, 通常用在 itemLayout 为 vertical 的情况下, 展示右侧内容; horizontal 展示在列表元素最右侧   string|slot
 * @package ExAdmin\ui\component\form\field
 */
class GridItem
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AListItem';

	public static function create()
	{
		return new self();
	}
}