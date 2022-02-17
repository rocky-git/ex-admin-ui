<?php

namespace component\form\field\input;

/**
 * 输入框
 * Class Input
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @method $this addonAfter(mixed $content) 带标签的 input，设置后置标签                                                	string|slot
 * @method $this addonBefore(mixed $content) 带标签的 input，设置前置标签    											 	string|slot
 * @method $this bordered(bool $bordered = true) 是否有边框    														 	boolean
 * @method $this defaultValue(string $value) 输入框默认内容 															 	string
 * @method $this disabled(bool $disabled = false) 是否禁用状态，默认为 false 											 	boolean
 * @method $this id(string $id) 输入框的 id 																			 	string
 * @method $this maxlength(int $num) 最大长度 																		 	number
 * @method $this prefix(mixed $prefix) 带有前缀图标的 input 															 	string|slot
 * @method $this size(string $size = 'default') 控件大小。注：标准表单内的输入框大小限制为 large。可选 large default small 	string|slot
 * @method $this suffix(mixed $suffix) 带有后缀图标的 input 															 	string|slot
 * @method $this type(string $type = 'text') 声明 input 类型，同原生 input 标签的 type 属性。 								string
 * @method $this value(string $content) 输入框内容    																 	string
 * @method $this allowClear(bool $is_allow) 可以点击清除图标删除内容 													 	boolean
 * @package component\form\field
 */
class Input
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AInput';

	public static function create()
	{
		return new self();
	}
}