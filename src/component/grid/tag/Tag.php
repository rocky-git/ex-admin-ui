<?php

namespace component\grid\tag;

/**
 * 标签
 * Class Tag
 * @link    https://next.antdv.com/components/tag-cn 标签组件
 * @method $this closable(bool $closable = false) 标签是否可以关闭                                        				boolean
 * @method $this color(string $color) 标签色                                        										string
 * @method $this visible(bool $visible = true) 是否显示标签                                 								boolean
 * @package component\form\field
 */
class Tag
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATag';

	public static function create()
	{
		return new self();
	}
}