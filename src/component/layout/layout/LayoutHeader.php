<?php

namespace ExAdmin\ui\component\layout\layout;

use ExAdmin\ui\component\Component;

/**
 * 布局 - 标题
 * Class LayoutHeader
 * @link   https://next.antdv.com/components/layout-cn 侧边栏组件
 * @package ExAdmin\ui\component\form\field
 */
class LayoutHeader extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ALayoutHeader';

	public static function create()
	{
		return new self();
	}
}