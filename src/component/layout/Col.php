<?php

namespace ExAdmin\ui\component\layout;

use ExAdmin\ui\component\Component;

/**
 * 列
 * Class Col
 * @link   https://next.antdv.com/components/grid-cn 列组件
 * @method $this flex(mixed $flex = 'top') flex 布局填充									                                string|number
 * @method $this offset(int $offset = 0) 栅格左侧的间隔格数，间隔内不可以有栅格                                               number
 * @method $this order(int $order = 0) 栅格顺序，flex 布局模式下有效                                                        number
 * @method $this pull(int $pull = 0) 栅格向左移动格数														                number
 * @method $this push(int $push = 0) 栅格向右移动格数														                number
 * @method $this span(int $span) 栅格占位格数，为 0 时相当于 display: none											        number
 * @method $this xs(mixed $warp = false) <576px 响应式栅格，可为栅格数或一个包含其他属性的对象									number|object
 * @method $this sm(mixed $warp = false) ≥576px 响应式栅格，可为栅格数或一个包含其他属性的对象									number|object
 * @method $this md(mixed $warp = false) ≥768px 响应式栅格，可为栅格数或一个包含其他属性的对象									number|object
 * @method $this lg(mixed $warp = false) ≥992px 响应式栅格，可为栅格数或一个包含其他属性的对象									number|object
 * @method $this xl(mixed $warp = false) ≥1200px 响应式栅格，可为栅格数或一个包含其他属性的对象									number|object
 * @method $this xxl(mixed $warp = false) ≥1600px 响应式栅格，可为栅格数或一个包含其他属性的对象								number|object
 * @method $this xxxl(mixed $warp = false) ≥2000px 响应式栅格，可为栅格数或一个包含其他属性的对象								number|object
 * @package ExAdmin\ui\component\form\field
 */
class Col extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACol';

	public static function create()
	{
		return new self();
	}
}