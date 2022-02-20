<?php

namespace ExAdmin\ui\component\grid\badge;

/**
 * 徽标数
 * Class BadgeRibbon
 * @link    https://next.antdv.com/components/badge-cn 徽标数组件
 * @method $this color(string $color) 自定义缎带的颜色                                        							string
 * @method $this placement(string $placement = 'end') 缎带的位置，start 和 end 随文字方向（RTL 或 LTR）变动                 string
 * @method $this text(mixed $text) 缎带中填入的内容                                      									string | VNode | slot
 * @package ExAdmin\ui\component\form\field
 */
class BadgeRibbon
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ABadgeRibbon';

	public static function create()
	{
		return new self();
	}
}