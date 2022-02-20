<?php

namespace ExAdmin\ui\component\grid\tabs;

use ExAdmin\ui\component\Component;

/**
 * 标签页
 * Class Tabs
 * @link    https://next.antdv.com/components/tabs-cn 标签页组件
 * @method $this activeKey(string $activeKey) 当前激活 tab 面板的 key                                        				string
 * @method $this animated(mixed $animated) 是否使用动画切换 Tabs，在 tabPosition=top | bottom 时有效                       boolean | {inkBar:boolean, tabPane:boolean}
 * @method $this centered(bool $centered = false) 标签居中展示                                        					boolean
 * @method $this hideAdd(bool $hideAdd = false) 是否隐藏加号图标，在 type="editable-card" 时有效                           boolean
 * @method $this size(string $size = 'default') 大小，提供 large default 和 small 三种大小                                string
 * @method $this tabBarStyle(mixed $tabBarStyle) tab bar 的样式对象                                        				object
 * @method $this tabPosition(string $tabPosition = 'top') 页签位置，可选值有 top right bottom left                        string
 * @method $this type(string $type = 'line') 页签的基本样式，可选 line、card editable-card 类型                            string
 * @method $this tabBarGutter(int $tabBarGutter) tabs 之间的间隙                                        					number
 * @package ExAdmin\ui\component\form\field
 */
class Tabs extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATabs';

	
}