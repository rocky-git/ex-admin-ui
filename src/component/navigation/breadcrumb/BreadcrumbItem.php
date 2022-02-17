<?php

namespace component\navigation\breadcrumb;

/**
 * 面包屑
 * Class BreadcrumbItem
 * @link   https://next.antdv.com/components/breadcrumb-cn 面包屑组件
 * @method $this href(string $href) 链接的目的地                                                                          string
 * @method $this overlay(mixed $overlay) 下拉菜单的内容                                                                   Menu | () => Menu
 * @package component\form\field
 */
class BreadcrumbItem
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