<?php

namespace component\form\field\select;

/**
 * 选择器 - 选项分组
 * Class SelectGroup
 * @link   https://next.antdv.com/components/select-cn 选择器组件
 * @method $this key(string $key)																						string
 * @method $this label(mixed $label) 组名																				string||function(h)|slot
 * @package component\form\field
 */
class SelectGroup
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASelectOptGroup';

	public static function create()
	{
		return new self();
	}
}