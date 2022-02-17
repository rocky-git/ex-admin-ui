<?php

namespace component\form;

/**
 * 表单
 * Class Form
 * @link   https://next.antdv.com/components/form-cn 表单
 * @link   https://github.com/stipsan/scroll-into-view-if-needed/#options options
 * @method $this model(mixed $model) 表单数据对象															                object
 * @method $this rules(mixed $rules) 表单验证规则															                object
 * @method $this hideRequiredMark(bool $hide = false) 隐藏所有表单项的必选标记												boolean
 * @method $this labelAlign(string $align = 'right') label 标签的文本对齐方式												'left' | 'right'
 * @method $this layout(string $layout = 'horizontal') 表单布局												            'horizontal'|'vertical'|'inline'
 * @method $this labelCol(mixed $column) label 标签布局，同 <Col> 组件，设置 span offset 值，如 {span: 3, offset: 12}
 *                                      或 sm: {span: 3, offset: 12}												    object
 * @method $this wrapperCol(mixed $column) 需要为输入控件设置布局样式时，使用该属性，用法同 labelCol							object
 * @method $this colon(bool $colon = true) 配置 Form.Item 的 colon 的默认值 (只有在属性 layout 为 horizontal 时有效)			boolean
 * @method $this validateOnRuleChange(bool $validate = true) 是否在 rules 属性改变后立即触发一次验证							boolean
 * @method $this scrollToFirstError(mixed $error = false) 提交失败自动滚动到第一个错误字段									boolean | options
 * @method $this name(string $name) 表单名称，会作为表单字段 id 前缀使用												        string
 * @method $this validateTrigger(mixed $validate = 'change') 统一设置字段校验规则											string | string[]
 * @method $this noStyle(bool $style = false) 为 true 时不带样式，作为纯字段控件使用											boolean
 * @package component\form
 */
class Form
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AForm';

	public static function create()
	{
		return new self();
	}
}