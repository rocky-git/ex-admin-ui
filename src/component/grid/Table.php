<?php

namespace component\grid;

/**
 * 表格 TODO
 * Class Popover
 * @link    https://next.antdv.com/components/popover-cn 气泡卡片组件
 * @method $this content(mixed $content) 卡片内容                                        								string|slot|VNode
 * @method $this title(mixed $title) 卡片标题                                        									string|slot|VNode
 * @package component\form\field
 */
class Table
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'APopover';

	public static function create()
	{
		return new self();
	}
}