<?php

namespace ExAdmin\ui\component\grid\descriptions;

/**
 * 描述列表 - 成员
 * Class DescriptionsItem
 * @link    https://next.antdv.com/components/descriptions-cn 描述列表组件
 * @method $this label(mixed $label) 内容的描述                                        									string | VNode | slot
 * @method $this span(int $span = 1) 包含列的数量                                        								number
 * @package ExAdmin\ui\component\form\field
 */
class DescriptionsItem
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ADescriptionsItem';

	public static function create()
	{
		return new self();
	}
}