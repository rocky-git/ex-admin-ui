<?php

namespace ExAdmin\ui\component\grid\tabs;

use ExAdmin\ui\component\Component;

/**
 * 标签页
 * Class TabsPane
 * @link    https://next.antdv.com/components/tabs-cn 标签页组件
 * @method $this forceRender(bool $forceRender = false) 被隐藏时是否渲染 DOM 结构                                        	boolean
 * @method $this key(string $key) 对应 activeKey                                        								string
 * @method $this tab(mixed $tab) 选项卡头显示文字                                        									string|slot
 * @package ExAdmin\ui\component\form\field
 */
class TabsPane extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'tab',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATabsPane';

	
}