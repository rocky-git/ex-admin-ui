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
use ExAdmin\ui\component\navigation\menu\MenuItem;

/**
 * Class AddButton
 * @mixin Button
 * @package ExAdmin\ui\component\grid\grid
 */
class ActionButton
{
    //是否隐藏添加按钮
    protected $hide = false;

    protected $dropdown = false;

    protected $actionButton;

    protected $actionMenuItem;

    protected $button;

    protected $menuItem;


    public function __construct()
    {
        $this->button = Button::create();
        $this->menuItem = MenuItem::create();
        $this->actionButton = $this->button;
        $this->actionMenuItem = $this->menuItem;
    }

    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->actionButton, $name], $arguments);
        if ($result instanceof Component) {
            $this->actionButton = $result;
        }
        $result = call_user_func_array([$this->actionMenuItem, $name], $arguments);
        if ($result instanceof Component) {
            $this->actionMenuItem = $result;
        }
        return $this;
    }

    public function dropdown($bool=true)
    {
        if($bool){
            $this->menuItem->attrs($this->button->getAttrs());
            $this->menuItem->setContent($this->button->getContent());
        }
        $this->dropdown = $bool;
    }

    public function button()
    {
        if ($this->dropdown) {
            return $this->menuItem;
        } else {
            return $this->button;
        }

    }

    public function action()
    {
        if ($this->dropdown) {
            return $this->actionMenuItem;
        } else {
            return $this->actionButton;
        }
    }

    public function __clone()
    {
        $this->actionMenuItem = clone $this->actionMenuItem;
        $this->actionButton = clone $this->actionButton;
        $this->button = clone $this->button;
        $this->menuItem = clone $this->menuItem;
        if ($this->actionButton instanceof Modal || $this->actionButton instanceof Drawer) {
            $this->actionButton->attr('reference', $this->button);
        } else {
            $this->actionButton = $this->button;
        }
        if ($this->actionMenuItem instanceof Modal || $this->actionMenuItem instanceof Drawer) {
            $this->actionMenuItem->attr('reference', $this->menuItem);
        } else {
            $this->actionMenuItem = $this->menuItem;
        }
    }
}
