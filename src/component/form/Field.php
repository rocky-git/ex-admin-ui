<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-20
 * Time: 20:59
 */

namespace ExAdmin\ui\component\form;


use ExAdmin\ui\component\Component;

/**
 * @property FormItem $formItem
 * @method static $this create($bindField = null, $value = '') 创建
 */
class Field extends Component
{
    protected $formItem;

    protected $vModel = 'value';

    protected $default = null;

    protected $value = null;

    protected $field = null;
    public function __construct($field = null, $value = '')
    {

        $this->vModel($this->vModel, $field, $value);
        $this->field = $this->bindAttr($this->vModel);
        parent::__construct();
    }
    public function modelValue(){
        $this->formItem->form()->setData($this->field);
        $this->removeBind($this->field);
        $field = $this->formItem->form()->getBindField($this->field);
        $this->bindAttr($this->vModel,$field,true);
    }

    public function getVmodel()
    {
        return $this->bindAttr($this->vModel);
    }

    /**
     * 设置缺省默认值
     * @param mixed $value
     */
    public function default($value)
    {
        $this->formItem->form()->setData($this->field,$value);
        return $this;
    }

    /**
     * 设置值
     * @param mixed $value
     */
    public function value($value)
    {
        $this->formItem->form()->setData($this->field,$value,true);
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

    /**
     * 是否必填
     * @return $this
     */
    public function required()
    {

        $this->formItem->attr('rules', [
            'required' => true,
            'trigger' => ['change', 'blur'],
            'message' => $this->formItem->attr('label') . ui_trans('required', 'form'),
        ]);
        return $this;
    }

    /**
     * 设置一个表单成员
     * @param FormItem $formItem
     */
    public function setFormItem(FormItem $formItem)
    {
        $this->formItem = $formItem;
    }


}
