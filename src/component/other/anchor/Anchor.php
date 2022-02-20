<?php

namespace ExAdmin\ui\component\other\anchor;

/**
 * 锚点
 * Class Anchor
 * @link    https://next.antdv.com/components/anchor-cn 锚点组件
 * @method $this affix(bool $affix = false) 固定模式                                  									boolean
 * @method $this bounds(int $bounds = 5) 锚点区域边界                                        							number(px)
 * @method $this offsetBottom(int $offsetBottom) 距离窗口底部达到指定偏移量后触发                            				number
 * @method $this offsetTop(int $offsetTop) 距离窗口顶部达到指定偏移量后触发                                        			number
 * @method $this showInkInFixed(bool $showInkInFixed = false) :affix="false" 时是否显示小圆点                             boolean
 * @method $this wrapperClass(string $wrapperClass) 容器的类名                                       					string
 * @method $this wrapperStyle(mixed $wrapperStyle) 容器样式                                       						object
 * @method $this targetOffset(int $targetOffset) 锚点滚动偏移量，默认与 offsetTop 相同                                     number
 * @package ExAdmin\ui\component\form\field
 */
class Anchor
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AAnchor';

	public static function create()
	{
		return new self();
	}
}