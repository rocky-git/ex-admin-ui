<?php

namespace ExAdmin\ui\component\grid\avatar;

use ExAdmin\ui\component\Component;

/**
 * 头像组
 * Class AvatarGroup
 * @link    https://next.antdv.com/components/avatar-cn 头像组件
 * @method $this maxCount(int $number) 设置头像的图标类型，可设为 Icon 的 type 或 VNode                                     number
 * @method $this maxPopoverPlacement(string $maxPopoverPlacement = 'top') 指定头像的形状                                  top | bottom
 * @method $this size(mixed $size = 'default') 设置头像的大小                                                        		number | large | small | default | { xs: number, sm: number, ...}
 * @package ExAdmin\ui\component\form\field
 */
class AvatarGroup extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AAvatarGroup';

	public static function create()
	{
		return new self();
	}
}