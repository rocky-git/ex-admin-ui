<?php

namespace component\form\field\select;

/**
 * 选择器 - 选项
 * Class SelectOption
 * @link   https://next.antdv.com/components/select-cn 选择器组件
 * @method $this disabled(bool $disabled = false) 是否禁用																boolean
 * @method $this key(string $key) 和 value 含义一致。如果 Vue 需要你设置此项，此项值与 value 的值相同，
 * 											然后可以省略 value 设置      													string
 * @method $this title(string $title) 选中该 Option 后，Select 的 title													string
 * @method $this value(mixed $value) 默认根据此属性值进行筛选																string|number
 * @method $this class(string $class) Option 器类名																		string
 * @package component\form\field
 */
class SelectOption
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASelectOption';

	public static function create()
	{
		return new self();
	}
}