<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-11
 * Time: 14:36
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\FormItem;
use ExAdmin\ui\support\Request;



trait CallbackDefinition
{
    public $callbackField;

    protected $callbacks = [];
    protected $callback = [];

    public function setCallback(\Closure $callback, \Closure $custom = null)
    {
        $num = count($this->callbacks);
        $mark = $this->getValidateField() . $num;
        $this->callbacks[$mark] = [
            'callback' => $callback,
            'custom' => $custom,
        ];
        return $mark;
    }

    public function isCallback()
    {
        $mark = Request::input('ex_admin_callback_field');
        if (isset($this->callbacks[$mark])) {
            $this->callback = $this->callbacks[$mark];
            return true;
        }
        return false;
    }

    public function handle($value,$formData)
    {
        $data = call_user_func($this->callback['callback'], $value,$formData);
        if($this->callback['custom'] instanceof \Closure){
            $data = call_user_func($this->callback['custom'], $data);
        }
        return $data;
    }
}