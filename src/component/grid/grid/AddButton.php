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
    
    protected $grid;
    
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->button = Button::create(ui_trans('add','grid'))
            ->type('primary')
            ->icon('<plus-outlined />');
    }

    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->button,$name],$arguments);
        if($result instanceof Component){
            $this->button = $result;
        }
        $this->grid->attr('addButton',$this->button);
        return $this;
    }
}