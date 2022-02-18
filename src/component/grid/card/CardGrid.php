<?php

namespace component\grid\card;

/**
 * 卡片 - 网格型内嵌卡片
 * Class CardGrid
 * @link    https://next.antdv.com/components/card-cn 卡片组件
 * @package component\form\field
 */
class CardGrid
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACardGrid';

	public static function create()
	{
		return new self();
	}
}