<?php

namespace ExAdmin\ui\component\navigation\breadcrumb;

use ExAdmin\ui\component\Component;

/**
 * 面包屑
 * Class BreadcrumbSeparator
 * @link   https://next.antdv.com/components/breadcrumb-cn 面包屑组件
 * @package ExAdmin\ui\component\form\field
 */
class BreadcrumbSeparator extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ABreadcrumbSeparator';

	public static function create()
	{
		return new self();
	}
}