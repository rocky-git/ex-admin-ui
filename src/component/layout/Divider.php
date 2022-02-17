<?php

namespace component\layout;

/**
 * 分割线
 * Class Divider
 * @link   https://next.antdv.com/components/divider-cn 分割线组件
 * @method $this dashed(bool $dashed = false) 是否虚线															        boolean
 * @method $this orientation(string $orientation = 'center') 分割线标题的位置												string
 * @method $this type(string $type = 'horizontal') 水平还是垂直类型														string
 * @method $this plain(bool $plain = false) 文字是否显示为普通正文样式														boolean
 * @package component\form\field
 */
class Divider
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ADivider';

	public static function create()
	{
		return new self();
	}
}