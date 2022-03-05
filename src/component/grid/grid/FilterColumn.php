<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-05
 * Time: 21:40
 */

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\form\traits\FormComponent;

/**
 * @method static FormComponent eq(\Closure $closure = null) 等于
 * @method static FormComponent neq(\Closure $closure = null) 不等于
 * @method static FormComponent egt(\Closure $closure = null) 大于等于
 * @method static FormComponent elt(\Closure $closure = null) 小于等于
 * @method static FormComponent gt(\Closure $closure = null) 大于
 * @method static FormComponent lt(\Closure $closure = null) 小于
 * @method static FormComponent between(\Closure $closure = null) 区间
 * @method static FormComponent notBetween(\Closure $closure = null) NOT区间查询
 * @method static FormComponent like(\Closure $closure = null) 模糊
 * @method static FormComponent json(\Closure $closure = null) json查询
 * @method static FormComponent jsonLike(\Closure $closure = null) json模糊查询
 * @method static FormComponent jsonArrLike(\Closure $closure = null) json数组模糊查询
 * @method static FormComponent in(\Closure $closure = null) in查询
 * @method static FormComponent notIn(\Closure $closure = null) not in查询
 * @method static FormComponent findIn(\Closure $closure = null) findIn查询
 */
class FilterColumn
{

    protected $call = [];

    public static function __callStatic($name, $arguments)
    {
        $self = new self();
        $self->call($name, $arguments);
        return $self;
    }
    public function __call($name, $arguments)
    {
        $this->call($name, $arguments);
        return $this;
    }

    public function call($name, $arguments)
    {
        $this->call[] = [
            'name' => $name,
            'arguments' => $arguments,
        ];
    }
    public function getCall()
    {
       return $this->call;
    }
}