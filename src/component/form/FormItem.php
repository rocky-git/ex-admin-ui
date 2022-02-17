<?php

namespace component\form;

/**
 * 表单
 * Class FormItem
 * @link   https://next.antdv.com/components/form-cn 表单
 * @method $this name(string $name) 表单域 model 字段，在使用 validate、resetFields 方法的情况下，该属性是必填的				string
 * @method $this rules(mixed $rules) 表单验证规则				                                                            object | array
 * @method $this autoLink(bool $link = true) 是否自动关联表单域，对于大部分情况都可以使用自动关联，如果不满足自动关联的条件
 *                                      ，可以手动关联，参见下方注意事项				                                        boolean
 * @method $this colon(string $colon = true) 配合 label 属性使用，表示是否显示 label 后面的冒号				                boolean
 * @method $this extra(mixed $extra) 额外的提示信息，和 help 类似，当需要错误信息和提示文案同时出现时，可以使用这个。				string|slot
 * @method $this hasFeedback(bool $feedback = false) 配合 validateStatus 属性使用，展示校验状态图标，建议只配合 Input 组件使用	boolean
 * @method $this help(mixed $help) 提示信息，如不设置，则会根据校验规则自动生成				                                string|slot
 * @method $this htmlFor(string $htmlFor) 设置子元素 label htmlFor 属性				                                    string
 * @method $this label(mixed $label) label 标签的文本				                                                        string|slot
 * @method $this labelCol(mixed $labelCol) label 标签布局，同 <Col> 组件，设置 span offset 值，如 {span: 3, offset: 12} 或
 *                                          sm: {span: 3, offset: 12}	                                                object
 * @method $this labelAlign(string $align = 'right') 标签文本对齐方式				                                        'left' | 'right'
 * @method $this required(bool $required = false) 是否必填，如不设置，则会根据校验规则自动生成				                    boolean
 * @method $this validateStatus(string $validateStatus) 校验状态，如不设置，则会根据校验规则自动生成，
 *                                                      可选：'success' 'warning' 'error' 'validating'				    string
 * @method $this wrapperCol(mixed $wrapperCol) 需要为输入控件设置布局样式时，使用该属性，用法同 labelCol				        object
 * @method $this validateFirst(bool $validateFirst = false) 当某一规则校验不通过时，是否停止剩下的规则的校验。				    boolean
 * @method $this validateTrigger(mixed $validateTrigger = 'change') 设置字段校验的时机				                        string | string[]
 * @package component\form
 */
class FormItem
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AFormItem';

	public static function create()
	{
		return new self();
	}
}