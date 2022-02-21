<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 数字输入框
 * Class InputNumber
 * @link    https://next.antdv.com/components/input-number-cn 数字输入框组件
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this defaultValue(int $num) 初始值																			number
 * @method $this disabled(bool $disabled = false) 禁用																	boolean
 * @method $this max(int $num) 最大值																					number
 * @method $this min(int $num) 最小值																					number
 * @method $this precision(int $num) 数值精度																			number
 * @method $this decimalSeparator(string $decimal) 小数点																string
 * @method $this size(string $size) 输入框大小																			string
 * @method $this step(mixed $step = 1) 每次改变步数，可以为小数															number|string
 * @method $this value(int $num) 当前值																					number
 * @method $this bordered(bool $bordered = true) 是否有边框																boolean
 * @method $this addonAfter(mixed $content) 带标签的 input，设置后置标签													slot
 * @method $this addonBefore(mixed $content) 带标签的 input，设置前置标签													slot
 * @method $this controls(bool $controls = true) 是否显示增减按钮															boolean
 * @method $this keyboard(bool $keyboard = true) 是否启用键盘快捷行为														boolean
 * @method $this stringMode(bool $stringMode = false) 字符值模式，开启后支持高精度小数。同时 change 事件将返回 string 类型	boolean
 * @package ExAdmin\ui\component\form\field
 */
class InputNumber extends Field
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AInputNumber';
}
