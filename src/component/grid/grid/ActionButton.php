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

/**
 * Class AddButton
 * @mixin Button
 * @package ExAdmin\ui\component\grid\grid
 */
class ActionButton
{
    protected $button;

    //是否隐藏添加按钮
    protected $hide = false;

    public function __construct()
    {
        $this->button = Button::create(admin_trans('grid.add'))
            ->type('primary')
            ->icon('<plus-outlined />');
    }

    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->button, $name], $arguments);
        if ($result instanceof Component) {
            $this->button = $result;
        }
        return $this;
    }
   
    public function button(){
        return $this->button;
    }
}
