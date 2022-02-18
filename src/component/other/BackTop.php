<?php

namespace component\other;

/**
 * 回到顶部
 * Class BackTop
 * @link    https://next.antdv.com/components/back-top-cn 回到顶部组件
 * @method $this visibilityHeight(int $visibilityHeight = 400) 滚动高度达到此参数值才出现 BackTop                          number
 * @package component\form\field
 */
class BackTop
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ABackTop';

	public static function create()
	{
		return new self();
	}
}