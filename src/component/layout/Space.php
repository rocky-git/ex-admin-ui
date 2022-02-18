<?php

namespace component\layout;

/**
 * 间距
 * Class Space
 * @link   https://next.antdv.com/components/layout-cn 间距组件
 * @method $this align(string $align) 对齐方式							                                                start | end |center |baseline
 * @method $this direction(string $direction = 'horizontal') 间距方向                                                    vertical | horizontal
 * @method $this size(mixed $size = 'small') 间距大小				                                                    small | middle | large | number
 * @package component\form\field
 */
class Space
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASpace';

	public static function create()
	{
		return new self();
	}
}