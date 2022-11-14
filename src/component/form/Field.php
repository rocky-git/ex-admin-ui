<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-20
 * Time: 20:59
 */

namespace ExAdmin\ui\component\form;


use ExAdmin\ui\component\common\Icon;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\traits\Validator;
use ExAdmin\ui\component\form\traits\When;
use ExAdmin\ui\component\grid\ToolTip;
use ExAdmin\ui\support\Str;

/**
 * @property FormItem $formItem
 * @property Form $form
 * @method static $this create($bindField = null, $value = '') 创建
 */
class Field extends Component
{
    use Validator, When;

    protected $form;
    
    protected $formItem;

    protected $vModel = 'value';

    protected $value;

    protected $field;

    public function __construct($field = null, $value = '')
    {
        $this->attr('data-tag', 'component');
        $this->vModel($this->vModel, $field, $value);
        $this->field = $this->bindAttr($this->vModel);
        $this->value = $value;
        parent::__construct();
    }

    protected function modelValueArray()
    {
        $this->value = [];
        if (!$this->formItem) {
            $value = $this->getbindAttrValue('value');
            if (!is_array($value)) {
                $field = $this->bindAttr('value');
                $this->bind($field, $this->value);
            }
        }
        $this->modelValue();
    }

    /**
     * form表单中绑定组件
     */
    public function modelValue()
    {
        if ($this->formItem) {
            $this->formItem->form()->inputDefault($this->field, $this->value, $this instanceof Input ? false : true);
            $this->removeBind($this->field);
            $field = $this->formItem->form()->getBindField($this->field);
            $this->bindAttr($this->vModel, $field, true);
        }
    }
    public function setField($value){
        $this->field = $value;
        return $this;
    }
    public function getField(){
        return $this->field;
    }

    
    /**
     * 设置缺省默认值
     * @param mixed $value
     * @return $this
     */
    public function default($value)
    {
        $this->formItem->form()->inputDefault($this->field, $value);
        return $this;
    }

    /**
     * 设置值
     * @param mixed $value
     * @return $this
     */
    public function value($value)
    {
        $this->formItem->form()->input($this->field, $value);
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
            if ($this->getRegex($name)) {
                $trans = $name;
                if ($this->getRegexMsg($name)) {
                    $trans = $this->getRegexMsg($name);
                }
                return $this->rulePattern($this->getRegex($name), $trans);
            }
        }
        return parent::__call($name, $arguments);
    }

    /**
     * 提示信息
     * @param string|Component $content
     * @return $this
     */
    public function help($content)
    {
        $this->formItem->extra($content);
        return $this;
    }

    /**
     * icon形式的帮助内容
     * @param mixed $content 提示的信息
     * @param string $icon 图标样式
     * @param string $placement 气泡框位置，可选 top left right bottom topLeft topRight bottomLeft bottomRight leftTop leftBottom rightTop rightBottom
     * @return $this
     */
    public function tip($content, string $icon = 'InfoCircleOutlined', string $placement = 'top')
    {
        $this->formItem->content(
            ToolTip::create([
                Icon::create($icon)->style(['marginLeft'=>'5px'])
            ])
                ->title($content)
                ->placement($placement), 'label');
        return $this;
    }

    /**
     * 追加item到后面
     * @param \Closure $closure 闭包 Form参数
     * @return $this
     */
    public function pushItem(\Closure $closure)
    {
        $form = $this->formItem->form();
        $formItems = $form->collectFields($closure);
        foreach ($formItems as $formItem) {
            $form->push($formItem);
        }
        return $this;
    }

    /**
     * 设置FormItem
     * @param FormItem $formItem
     */
    public function setFormItem(FormItem $formItem)
    {
        $this->formItem = $formItem;
        
        $this->form = $formItem->form();
    }

    public function getFormItem()
    {
        return $this->formItem;
    }

    /**
     * 排除提交字段
     * @param string $field
     * @return void
     */
    protected function exceptField($field){
        $exceptFields = $this->form->manyField;
        array_push($exceptFields,$field);
        $except = implode('.',$exceptFields);
        $this->form->except($except);
    }
}
