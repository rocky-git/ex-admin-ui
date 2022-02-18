<?php

namespace component\layout\layout;

/**
 * 布局 - 标题
 * Class LayoutHeader
 * @link   https://next.antdv.com/components/layout-cn 侧边栏组件
 * @package component\form\field
 */
class LayoutHeader
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ALayoutHeader';

	public static function create()
	{
		return new self();
	}
}