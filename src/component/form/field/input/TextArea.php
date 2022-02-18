<?php

namespace component\form\field\input;

/**
 * 文本域
 * Class TextArea
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @link    https://developer.mozilla.org/zh-CN/docs/Web/HTML/Element/input#%E5%B1%9E%E6%80%A7 MDN
 * @method $this autosize(mixed $size = false) 自适应内容高度，可设置为 true | false 或对象：{ minRows: 2, maxRows: 6 }		boolean|object
 * @method $this defaultValue(string $content) 输入框默认内容																string
 * @method $this value(string $content) 输入框内容																		string
 * @method $this allowClear(bool $is_allow = false) 可以点击清除图标删除内容												boolean
 * @method $this showCount(bool $is_show = false) 是否展示字数															boolean
 * @package component\form\field
 */
class TextArea
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATextArea';

	public static function create()
	{
		return new self();
	}
}