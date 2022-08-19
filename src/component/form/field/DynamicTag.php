<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-01
 * Time: 16:22
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\Field;

/**
 * @method $this add(bool $value) 可添加
 * @method $this edit(bool $value) 可编辑
 * @method $this del(bool $value) 可删除
 */
class DynamicTag extends Field
{
    protected $name = 'ExDynamicTag';
    public function __construct($field = null, $value = [])
    {
        parent::__construct($field, $value);
    }
}