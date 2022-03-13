<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-01
 * Time: 22:24
 */

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\feedback\Drawer;
use ExAdmin\ui\component\feedback\Modal;

/**
 * Class AddButton
 * @mixin Button
 * @package ExAdmin\ui\component\grid\grid
 */
class ActionButton
{
    //是否隐藏添加按钮
    protected $hide = false;

    protected $action;

    protected $button;

    public function __construct()
    {
        $this->button = Button::create();
        $this->action = $this->button;
    }

    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->action, $name], $arguments);
        if ($result instanceof Component) {
            $this->action = $result;
        }
        return $this;
    }

    public function button()
    {
        return $this->button;
    }

    public function action()
    {
        return $this->action;
    }

    public function __clone()
    {
        $this->action = clone $this->action;
        $this->button = clone $this->button;
        if($this->action instanceof Modal || $this->action instanceof Drawer){
            $this->action->attr('reference',$this->button);
        }else{
            $this->action = $this->button;
        }
    }
}
