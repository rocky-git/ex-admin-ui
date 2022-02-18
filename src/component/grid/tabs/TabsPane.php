<?php

namespace component\grid\tabs;

/**
 * 标签页
 * Class TabsPane
 * @link    https://next.antdv.com/components/tabs-cn 标签页组件
 * @method $this forceRender(bool $forceRender = false) 被隐藏时是否渲染 DOM 结构                                        	boolean
 * @method $this key(string $key) 对应 activeKey                                        								string
 * @method $this tab(mixed $tab) 选项卡头显示文字                                        									string|slot
 * @package component\form\field
 */
class TabsPane
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATabsPane';

	public static function create()
	{
		return new self();
	}
}