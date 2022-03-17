<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-20
 * Time: 20:59
 */

namespace ExAdmin\ui\component\form;


use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\traits\Validator;
use ExAdmin\ui\support\Str;

/**
 * @property FormItem $formItem
 * @method static $this create($bindField = null, $value = '') 创建
 */
class Field extends Component
{
    use Validator;
    protected $formItem;

    protected $vModel = 'value';

    protected $value;

    protected $field;

    public function __construct($field = null, $value = '')
    {
        $this->vModel($this->vModel, $field, $value);
        $this->field = $this->bindAttr($this->vModel);
        $this->value = $value;
        parent::__construct();
    }

    /**
     * form表单中绑定组件
     */
    public function modelValue(){
        if($this->formItem){
            $this->formItem->form()->inputDefault($this->field,$this->value);
            $this->removeBind($this->field);
            $field = $this->formItem->form()->getBindField($this->field);
            $this->bindAttr($this->vModel,$field,true);
        }
    }

    /**
     * 获取当前绑定字段
     * @return Field|mixed|null
     */
    public function getVmodel()
    {
        return $this->bindAttr($this->vModel);
    }

    /**
     * 设置缺省默认值
     * @param mixed $value
     * @return $this
     */
    public function default($value)
    {
        $this->formItem->form()->inputDefault($this->field,$value);
        return $this;
    }

    /**
     * 设置值
     * @param mixed $value
     * @return $this
     */
    public function value($value)
    {
        $this->formItem->form()->input($this->field,$value);
        return $this;
    }

    /**
     * 栅格占位格数
     * @param int $span
     * @return $this
     */
    public function span(int $span)
    {
        $this->formItem->attr('span', $span);
        return $this;
    }

    public function __call($name, $arguments)
    {
        if (strrpos($name, 'rule') === 0) {
            $name = substr($name, 4);
            $name = Str::camel($name);
            if (isset(static::$regex[$name])) {
                $trans = $name;
                if(isset(static::$regexMsg[$name])){
                    $trans = static::$regexMsg[$name];     
                }
                return $this->rulePattern(static::$regex[$name], $trans);
            }
        }
        return parent::__call($name, $arguments);
    }

    /**
     * 提示信息
     * @param string|Component $content
     * @return $this
     */
    public function help($content){
        $this->formItem->help($content);
        return $this;
    }
//    /**
//     * 提示信息
//     * @param string|Component $content
//     */
//    public function tip($content){
//        $this->formItem->help($content);
//    }
    /**
     * 设置FormItem
     * @param FormItem $formItem
     */
    public function setFormItem(FormItem $formItem)
    {
        $this->formItem = $formItem;
    }
    public function getFormItem(){
        return $this->formItem;
    }
}
