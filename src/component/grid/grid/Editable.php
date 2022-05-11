<?php

namespace ExAdmin\ui\component\grid\grid;
use ExAdmin\ui\component\form\traits\FormComponent;

/**
 * @mixin FormComponent
 */
class Editable
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
