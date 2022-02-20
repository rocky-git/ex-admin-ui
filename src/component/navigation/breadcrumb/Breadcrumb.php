<?php

namespace ExAdmin\ui\component\navigation\breadcrumb;

/**
 * 面包屑
 * Class Breadcrumb
 * @link   https://next.antdv.com/components/breadcrumb-cn 面包屑组件
 * @link   https://next.antdv.com/components/breadcrumb-cn#routes routes
 * @method $this params(mixed $params) 路由的参数                                                                         object
 * @method $this routes(mixed $routes) router 的路由栈信息                                                                routes[]
 * @method $this separator(mixed $separator = '/') 分隔符自定义                                                           string|slot
 * @package ExAdmin\ui\component\form\field
 */
class Breadcrumb
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ABreadcrumb';

	public static function create()
	{
		return new self();
	}
}