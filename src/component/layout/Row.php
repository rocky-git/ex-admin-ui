<?php

namespace component\layout;

/**
 * 行
 * Class Row
 * @link   https://next.antdv.com/components/grid-cn 行组件
 * @method $this align(bool $align = 'top') flex 布局下的垂直对齐方式：top middle bottom									string
 * @method $this gutter(mixed $gutter = 0) 栅格间隔，可以写成像素值或支持响应式的对象写法来设置水平间隔 { xs: 8, sm: 16, md: 24}。
 *                              或者使用数组形式同时设置 [水平间距, 垂直间距]（1.5.0 后支持）。									number/object/array
 * @method $this justify(string $justify = 'start') flex 布局下的水平排列方式：
 *                                                      start end center space-around space-between	                    string
 * @method $this wrap(bool $warp = false) 是否自动换行														            boolean
 * @package component\form\field
 */
class Row
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ARow';

	public static function create()
	{
		return new self();
	}
}