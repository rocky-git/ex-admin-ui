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
class AddButton
{
    protected $button;
    
    //是否隐藏添加按钮
    protected $hideAddButton = false;
    
    public function __construct()
    {
        $this->button = Button::create(ui_trans('add', 'grid'));
        $this->type('primary')
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
    /**
     * 隐藏添加按钮
     * @param bool $bool
     */
    public function hideAddButton(bool $bool = true)
    {
        $this->hideAddButton = $bool;
    }
    public function button(){
        if($this->hideAddButton){
            return null;
        }else{
            return $this->button;
        }
    }
}
