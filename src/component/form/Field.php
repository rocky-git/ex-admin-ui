<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-20
 * Time: 20:59
 */

namespace ExAdmin\ui\component\form;


use ExAdmin\ui\component\Component;

class Field extends Component
{
    public function __construct($value = '', $field = null)
    {
        parent::__construct();
        empty($field) ? $field = $this->random() : $field;
        $this->bind($field, $value);
        $this->bindAttr('value', $field, true);
    }
}