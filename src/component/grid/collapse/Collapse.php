<?php

namespace ExAdmin\ui\component\grid\collapse;

use ExAdmin\ui\component\Component;

/**
 * 折叠面板
 * Class Collapse
 * @link    https://next.antdv.com/components/collapse-cn 折叠面板组件
 * @method $this activeKey(mixed $activeKey) 当前激活 tab 面板的 key                                        				string[]|string
 * @method $this bordered(bool $bordered = true) 带边框风格的折叠面板                   									boolean
 * @method $this collapsible(mixed $collapsible) 所有子面板是否可折叠或指定可折叠触发区域                                    header | disabled
 * @method $this accordion(bool $accordion = false) 手风琴模式                                        					boolean
 * @method $this expandIcon(mixed $expandIcon) 自定义切换图标                                        						Function(props):VNode | slot="expandIcon" slot-scope="props"|#expandIcon="props"
 * @method $this expandIconPosition(string $expandIconPosition = 'left') 设置图标位置： left, right                       left
 * @method $this ghost(bool $ghost = false) 使折叠面板透明且无边框                                      					boolean
 * @method $this destroyInactivePanel(bool $destroyInactivePanel = false) 销毁折叠隐藏的面板                              boolean
 * @package ExAdmin\ui\component\form\field
 */
class Collapse extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'expandIcon',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ACollapse';

	
}