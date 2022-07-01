<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-01
 * Time: 11:43
 */

namespace ExAdmin\ui\component\common;


use ExAdmin\ui\component\Component;

/**
 * Class Copy
 * @package ExAdmin\ui\component\common
 * @method static $this create($copy = '') 创建
 */
class Copy extends Component
{
    public function __construct($content)
    {
        parent::__construct();
        $this->attr('data-tag', 'i')
            ->copy($content)
            ->style(['cursor' => 'pointer'])
            ->attr('class', ['far fa-copy', 'editable-cell-icon']);
    }
}