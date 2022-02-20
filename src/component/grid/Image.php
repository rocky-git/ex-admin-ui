<?php

namespace ExAdmin\ui\component\grid;

/**
 * 图片
 * Class Image
 * @link    https://next.antdv.com/components/image-cn 图片组件
 * @method $this alt(string $alt) 图像描述                                        										string
 * @method $this fallback(string $fallback) 加载失败容错地址                                        						string
 * @method $this height(mixed $height) 图像高度                                        									string | number
 * @method $this placeholder(mixed $placeholder) 加载占位, 为 true 时使用默认占位                                        	boolean | slot
 * @method $this preview(mixed $preview = true) 预览参数，为 false 时禁用                                        			boolean | previewType
 * @method $this src(string $src) 图片地址                                        										string
 * @method $this width(mixed $width) 图像宽度                                        									string | number
 * @package ExAdmin\ui\component\form\field
 */
class Image
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AImage';

	public static function create()
	{
		return new self();
	}
}