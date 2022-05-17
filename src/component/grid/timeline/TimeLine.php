<?php

namespace ExAdmin\ui\component\grid\timeline;

use ExAdmin\ui\component\Component;

/**
 * 时间轴
 * Class TimeLine
 * @link    https://next.antdv.com/components/timeline-cn 时间轴组件
 * @method $this pending(mixed $pending = false) 指定最后一个幽灵节点是否存在或内容                                        	boolean|string|slot
 * @method $this pendingDot(mixed $pendingDot) 	当最后一个幽灵节点存在時，指定其时间图点                                     string|slot
 * @method $this reverse(bool $reverse = false) 节点排序                                 								boolean
 * @method $this mode(string $mode) 通过设置 mode 可以改变时间轴和内容的相对位置                                 			left | alternate | right
 * @package ExAdmin\ui\component\form\field
 */
class TimeLine extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'pending',
        'pendingDot',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATimeline';

    /**
     * 添加一个子项
     * @param string|Component $value 值
     * @param string $color 颜色
     * @param string $position 位置仅在mode=alternate生效  left | right
     * @return $this
     */
	public function item($value, string $color = 'blue', string $position = 'left')
    {
        $item = new TimeLineItem();
        $item->content($value)
            ->position($position)
            ->color($color);
        $this->content($item);
        return $this;
    }

    /**
     * 设置选项(数组)
     * @param array $dataSource 数据源 $dataSource = ['时间轴1', '时间轴2, '时间轴3];
     */
    public function options($dataSource)
    {
        $options = [];
        foreach ($dataSource as $value) {
            $options[] = [
                'slotDefault' => $value
            ];
        }
        $item = TimeLineItem::create()
            ->map($options)
            ->mapAttr('slotDefault');
        $this->content($item);
        return $this;
    }
}
