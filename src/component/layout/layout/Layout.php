<?php

namespace component\layout\layout;

/**
 * 布局容器
 * Class Layout
 * @link   https://next.antdv.com/components/layout-cn 布局容器组件
 * @method $this class(bool $class) 容器 class									                                        string
 * @method $this style(mixed $style) 指定样式                                                                            object
 * @method $this hasSider(bool $hasSider) 表示子元素里有 Sider，一般不用指定。可用于服务端渲染时避免样式闪动				        boolean
 * @package component\form\field
 */
class Layout
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ALayout';

	public static function create()
	{
		return new self();
	}
}