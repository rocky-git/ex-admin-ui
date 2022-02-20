<?php

namespace ExAdmin\ui\component\navigation\breadcrumb;

use ExAdmin\ui\component\Component;

/**
 * 面包屑
 * Class BreadcrumbItem
 * @link   https://next.antdv.com/components/breadcrumb-cn 面包屑组件
 * @method $this href(string $href) 链接的目的地                                                                          string
 * @method $this overlay(mixed $overlay) 下拉菜单的内容                                                                   Menu | () => Menu
 * @package ExAdmin\ui\component\form\field
 */
class BreadcrumbItem extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ABreadcrumbItem';

	public static function create()
	{
		return new self();
	}
}