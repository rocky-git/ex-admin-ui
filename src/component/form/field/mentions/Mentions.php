<?php

namespace ExAdmin\ui\component\form\field\mentions;

/**
 * 提及
 * Class Mentions
 * @link    https://next.antdv.com/components/mentions-cn 提及组件
 * @method $this autofocus(bool $focus = false) 自动获得焦点																boolean
 * @method $this defaultValue(string $value) 默认值																		boolean
 * @method $this placement(string $placement = 'bottom') 弹出层展示位置 													top | bottom
 * @method $this prefix(mixed $prefix = '@') 设置触发关键字																string | string[]
 * @method $this split(string $split = ' ') 设置选中项前后分隔符															string
 * @method $this value(string $value) 设置值																				string
 * @package ExAdmin\ui\component\form\field
 */
class Mentions
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AMentions';

	public static function create()
	{
		return new self();
	}
}