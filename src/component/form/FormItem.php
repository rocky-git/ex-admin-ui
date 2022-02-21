<?php

namespace ExAdmin\ui\component\form;

use ExAdmin\ui\component\Component;

/**
 * 表单
 * Class FormItem
 * @link   https://next.antdv.com/components/form-cn 表单
 * @method $this name(string $name) 表单域 model 字段，在使用 validate、resetFields 方法的情况下，该属性是必填的                string
 * @method $this rules(mixed $rules) 表单验证规则                                                                            object | array
 * @method $this autoLink(bool $link = true) 是否自动关联表单域，对于大部分情况都可以使用自动关联，如果不满足自动关联的条件
 *                                      ，可以手动关联，参见下方注意事项                                                        boolean
 * @method $this colon(string $colon = true) 配合 label 属性使用，表示是否显示 label 后面的冒号                                boolean
 * @method $this hasFeedback(bool $feedback = false) 配合 validateStatus 属性使用，展示校验状态图标，建议只配合 Input 组件使用    boolean
 * @method $this htmlFor(string $htmlFor) 设置子元素 label htmlFor 属性                                                    string
 * @method $this labelCol(mixed $labelCol) label 标签布局，同 <Col> 组件，设置 span offset 值，如 {
span: 3, offset: 12
} 或
 *                                          sm: {span: 3, offset: 12}                                                    object
 * @method $this labelAlign(string $align = 'right') 标签文本对齐方式                                                        'left' | 'right'
 * @method $this required(bool $required = false) 是否必填，如不设置，则会根据校验规则自动生成                                    boolean
 * @method $this validateStatus(string $validateStatus) 校验状态，如不设置，则会根据校验规则自动生成，
 *                                                      可选：'success' 'warning' 'error' 'validating'                    string
 * @method $this wrapperCol(mixed $wrapperCol) 需要为输入控件设置布局样式时，使用该属性，用法同 labelCol                        object
 * @method $this validateFirst(bool $validateFirst = false) 当某一规则校验不通过时，是否停止剩下的规则的校验。                    boolean
 * @method $this validateTrigger(mixed $validateTrigger = 'change') 设置字段校验的时机                                        string | string[]
 * @package ExAdmin\ui\component\form
 */
class FormItem extends Component
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'help',
        'extra',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'AFormItem';

    /**
     * label 标签的文本
     * @param string|Component $content
     * @return FormItem
     */
    public function label($content): FormItem
    {
        $this->attr('label', $content);
        return $this->content($content, 'label');
    }
}
