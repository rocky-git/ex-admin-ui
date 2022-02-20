<?php

namespace ExAdmin\ui\component\navigation;

use ExAdmin\ui\component\Component;

/**
 * 固钉
 * Class Affix
 * @link   https://next.antdv.com/components/affix-cn 固钉组件
 * @method $this offsetBottom(int $offsetBottom) 距离窗口底部达到指定偏移量后触发								            number
 * @method $this offsetTop(int $offsetTop) 距离窗口顶部达到指定偏移量后触发                                                  number
 * @package ExAdmin\ui\component\form\field
 */
class Affix extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AAffix';

	public static function create()
	{
		return new self();
	}
}