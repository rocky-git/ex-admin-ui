<?php

namespace component\grid\timeline;

/**
 * 时间轴
 * Class TimeLine
 * @link    https://next.antdv.com/components/timeline-cn 时间轴组件
 * @method $this pending(mixed $pending = false) 指定最后一个幽灵节点是否存在或内容                                        	boolean|string|slot
 * @method $this pendingDot(mixed $pendingDot) 	当最后一个幽灵节点存在時，指定其时间图点                                     string|slot
 * @method $this reverse(bool $reverse = false) 节点排序                                 								boolean
 * @method $this mode(string $mode) 通过设置 mode 可以改变时间轴和内容的相对位置                                 			left | alternate | right
 * @package component\form\field
 */
class TimeLine
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATimeLine';

	public static function create()
	{
		return new self();
	}
}