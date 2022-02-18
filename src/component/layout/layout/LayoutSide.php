<?php

namespace component\layout\layout;

/**
 * 侧边栏
 * Class LayoutSide
 * @link   https://next.antdv.com/components/layout-cn 侧边栏组件
 * @method $this breakpoint(bool $class) 触发响应式布局的断点								                                Enum { 'xs', 'sm', 'md', 'lg', 'xl', 'xxl' }
 * @method $this class(string $class) 容器 class                                                                         string
 * @method $this collapsed(bool $collapsed) 当前收起状态				                                                    boolean
 * @method $this collapsedWidth(int $collapsedWidth = 80) 收缩宽度，设置为 0 会出现特殊 trigger				                number
 * @method $this collapsible(bool $collapsible) 是否可收起				                                                boolean
 * @method $this defaultCollapsed(bool $defaultCollapsed) 是否默认收起				                                    boolean
 * @method $this reverseArrow(bool $reverseArrow = false) 翻转折叠提示箭头的方向，当 Sider 在右边时可以使用				    boolean
 * @method $this style(mixed $style) 指定样式				                                                            object|string
 * @method $this theme(string $theme) 主题颜色				                                                            string: light dark
 * @method $this trigger(mixed $trigger) 自定义 trigger，设置为 null 时隐藏 trigger				                        string|slot
 * @method $this width(mixed $width = 200) 宽度				                                                            number|string
 * @method $this zeroWidthTriggerStyle(mixed $zeroWidthTriggerStyle) 指定当 collapsedWidth 为 0 时出现的特殊 trigger 的样式	object
 * @package component\form\field
 */
class LayoutSide
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ALayoutSider';

	public static function create()
	{
		return new self();
	}
}