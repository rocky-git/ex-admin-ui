<?php

namespace ExAdmin\ui\component\grid\descriptions;

use ExAdmin\ui\component\Component;

/**
 * 描述列表
 * Class Descriptions
 * @link    https://next.antdv.com/components/descriptions-cn 描述列表组件
 * @method $this bordered(boolean $bordered = true) 是否展示边框                                        						boolean
 * @method $this colon(boolean $colon = true) 配置 Descriptions.Item 的 colon 的默认值                                        	boolean
 * @method $this column(int $column = 3) 一行的 DescriptionItems 数量，可以写成像素值或支持响应式的对象写法 { xs: 8, sm: 16, md: 24}  number
 * @method $this extra(mixed $extra) 描述列表的操作区域，显示在右上方                                        						string | VNode | slot
 * @method $this layout(string $layout = 'horizontal') 描述布局                                        							horizontal | vertical
 * @method $this size(string $size = 'default') 设置列表的大小。可以设置为 middle 、small, 或不填（只有设置 bordered={true} 生效）    default | middle | small
 * @method $this title(mixed $title) 描述列表的标题，显示在最顶部                                        							string | VNode | slot
 * @package ExAdmin\ui\component\form\field
 */
class Descriptions extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'extra',
        'title',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ADescriptions';

	
}