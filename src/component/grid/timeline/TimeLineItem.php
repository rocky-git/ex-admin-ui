<?php

namespace ExAdmin\ui\component\grid\timeline;

use ExAdmin\ui\component\Component;

/**
 * 时间轴
 * Class TimeLineItem
 * @link    https://next.antdv.com/components/timeline-cn 时间轴组件
 * @method $this color(string $color = 'blue') 指定圆圈颜色 blue, red, green，或自定义的色值                                string
 * @method $this dot(mixed $dot) 自定义时间轴点                                      										string|slot
 * @method $this position(string $position) 自定义节点位置                                 								left | right
 * @method $this label(mixed $label) 设置标签                                 											string | slot
 * @package ExAdmin\ui\component\form\field
 */
class TimeLineItem extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATimeLineItem';

	public static function create()
	{
		return new self();
	}
}