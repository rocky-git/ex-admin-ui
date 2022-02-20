<?php

namespace ExAdmin\ui\component\grid\badge;

/**
 * 徽标数
 * Class Badge
 * @link    https://next.antdv.com/components/badge-cn 徽标数组件
 * @method $this color(string $color) 自定义小圆点的颜色                                        							string
 * @method $this count(mixed $count) 展示的数字，大于 overflowCount 时显示为 ${overflowCount}+，为 0 时隐藏                 number | string | slot
 * @method $this dot(bool $dot = false) 不展示数字，只有一个小红点                                        					boolean
 * @method $this offset(array $offset) 设置状态点的位置偏移，格式为 [x, y]                                        			[number|string, number|string]
 * @method $this overflowCount(int $overflowCount = 99) 展示封顶的数字值                                        			number
 * @method $this showZero(bool $showZero = false) 当数值为 0 时，是否展示 Badge                                       	boolean
 * @method $this status(string $status = '') 设置 Badge 为状态点                                        					Enum{ 'success', 'processing, 'default', 'error', 'warning' }
 * @method $this text(string $text = '') 在设置了 status 的前提下有效，设置状态点的文本                                      string
 * @method $this numberStyle(mixed $numberStyle) 设置状态点的样式                                        					object
 * @method $this title(string $title = 'count') 设置鼠标放在状态点上时显示的文字                                        	string
 * @package ExAdmin\ui\component\form\field
 */
class Badge
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ABadge';

	public static function create()
	{
		return new self();
	}
}