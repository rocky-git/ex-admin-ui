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
 * @method static $this create($value = '', $bindField = null) 创建
 */
class Field extends Component
{
    protected $formItem;

    public function __construct($value = '', $field = null)
    {
        parent::__construct();
        $this->vModel('value', $field, $value);
    }

    /**
     * 列占位（等于前端的md）
     * @param int $span
     * @return $this
     */
    public function span(int $span): Field
    {
        $this->formItem->attr('span', $span);
        return $this;
    }

    /**
     * 是否必填
     * @return $this
     */
    public function required(): Field
    {
        $this->formItem->attr('rules', [
            'required' => true,
            'trigger'  => ['change', 'blur'],
            'message'  => ui_trans('please_enter', 'form').$this->formItem->attr('label'),
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

    /**
     * 获取设置的表单成员
     * @return FormItem
     */
    public function getFormItem(): FormItem
    {
        return $this->formItem;
    }
}
