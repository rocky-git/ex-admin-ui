<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-18
 * Time: 21:30
 */

namespace ExAdmin\ui\component\common;


use ExAdmin\ui\component\Component;

/**
 * Class Icon
 * @method static $this create($icon) 创建
 * @method $this icon($icon) 图标
 * @package ExAdmin\ui\component\common
 */
class Icon extends Component
{
    protected $name = 'ExIcon';
    public function __construct($icon)
    {
        $this->icon($icon);
        parent::__construct();
    }
}