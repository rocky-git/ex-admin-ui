<?php

namespace ExAdmin\ui\component\grid\tag;

/**
 * 可选中标签
 * Class CheckAbleTag
 * @link    https://next.antdv.com/components/tag-cn 标签组件
 * @method $this checked(bool $checked = false) 	设置标签的选中状态                                        			boolean
 * @package ExAdmin\ui\component\form\field
 */
class CheckAbleTag
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACheckableTag';

	public static function create()
	{
		return new self();
	}
}