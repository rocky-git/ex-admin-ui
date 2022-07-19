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
use Illuminate\Support\Facades\Log;


trait CallbackDefinition
{
    public $callbackField;

    protected $callbacks = [];
    protected $callback = [];

    public function setCallback($callback, $custom)
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

    public function handle($value)
    {
        Log::error(123);
        $data = call_user_func($this->callback['callback'], $value);
        Log::error('fff');
        return call_user_func($this->callback['custom'], $data);
    }
}