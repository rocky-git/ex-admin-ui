<?php

namespace component\grid\collapse;

/**
 * 折叠面板
 * Class CollapsePanel
 * @link    https://next.antdv.com/components/collapse-cn 折叠面板组件
 * @method $this collapsible(mixed $collapsible) 是否可折叠或指定可折叠触发区域                                        		header | disabled
 * @method $this forceRender(bool $forceRender = false) 被隐藏时是否渲染 DOM 结构                   						boolean
 * @method $this header(mixed $header) 面板头内容                                       									string|slot
 * @method $this key(mixed $key) 对应 activeKey                                        									string | number
 * @method $this showArrow(bool $showArrow = true) 是否展示当前面板上的箭头                                        		boolean
 * @method $this extra(mixed $extra) 自定义渲染每个面板右上角的内容                                     					VNode | slot
 * @package component\form\field
 */
class CollapsePanel
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACollapsePanel';

	public static function create()
	{
		return new self();
	}
}