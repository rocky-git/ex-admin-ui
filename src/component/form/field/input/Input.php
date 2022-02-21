<?php

namespace ExAdmin\ui\component\form\field\input;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 输入框
 * Class Input
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @method $this bordered(bool $bordered = true) 是否有边框    														 	boolean
 * @method $this defaultValue(string $value) 输入框默认内容 															 	string
 * @method $this disabled(bool $disabled = false) 是否禁用状态，默认为 false 											 	boolean
 * @method $this id(string $id) 输入框的 id 																			 	string
 * @method $this maxlength(int $num) 最大长度 																		 	number
 * @method $this size(string $size = 'default') 控件大小。注：标准表单内的输入框大小限制为 large。可选 large default small 	string|slot
 * @method $this type(string $type = 'text') 声明 input 类型，同原生 input 标签的 type 属性。 								string
 * @method $this allowClear(bool $is_allow) 可以点击清除图标删除内容 													 	boolean
 * @package ExAdmin\ui\component\form\field
 */
class Input extends Field
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AInput';

    public function __construct($value = '', $field = null)
    {
        parent::__construct($value, $field);
        $this->allowClear();
    }
    /**
     * 带有前缀图标的 input
     * @param $content
     * @return Input
     */
    public function prefix($content){
        return $this->content($content,'prefix');
    }
    /**
     * 带有后缀图标的 input
     * @param $content
     * @return Input
     */
    public function suffix($content){
        return $this->content($content,'suffix');
    }
    /**
     * 带标签的 input，设置后置标签
     * @param $content
     * @return Input
     */
    public function addonAfter($content){
        return $this->content($content,'addonAfter');
    }
    /**
     * 带标签的 input，设置前置标签
     * @param $content
     * @return Input
     */
    public function addonBefore($content){
        return $this->content($content,'addonBefore');
    }
}
