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
 * @method static $this create($bindField = null,$value = '') 创建
 */
class Field extends Component
{
    protected $formItem;
    
    protected $vModel = 'value';
    
    public function __construct($field = null,$value = '')
    {
       
        $this->vModel($this->vModel, $field, $value);
        parent::__construct();
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
            'message' => ui_trans('please_enter', 'form') . $this->formItem->attr('label'),
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
