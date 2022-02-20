<?php

namespace ExAdmin\ui\component\form\field\input;

use ExAdmin\ui\component\Component;

/**
 * 输入框组合
 * Class InputGroup
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @method $this compact(boolean $compact = false) 是否用紧凑模式															boolean
 * @method $this size(string $size = 'default') Input.Group 中所有的 Input 的大小，可选 large default small				string
 * @package ExAdmin\ui\component\form\field
 */
class InputGroup extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AInputGroup';

	public static function create()
	{
		return new self();
	}
}