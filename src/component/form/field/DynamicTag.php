<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-01
 * Time: 16:22
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\Field;

class DynamicTag extends Field
{
    protected $name = 'ExDynamicTag';
    public function __construct($field = null, $value = [])
    {
        parent::__construct($field, $value);
    }
}