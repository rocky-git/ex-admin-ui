<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-11
 * Time: 14:36
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\FormItem;

trait CallbackDefinition
{
    public $callbackField;
    
    protected $callbackClosure;

    protected $callbackCustom;
    
    public function setFormItem(FormItem $formItem)
    {
        parent::setFormItem($formItem); // TODO: Change the autogenerated stub
        $this->callbackField = $this->getValidateField();
    }

    public function handle($value){
        $data = call_user_func($this->callbackClosure,$value);
        return call_user_func($this->callbackCustom,$data);
    }
}