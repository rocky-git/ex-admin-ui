<?php

namespace ExAdmin\ui;

abstract class Manager
{
    protected $driver;

    abstract function __construct($repository,$component);

    final public function getDriver()
    {
        return $this->driver;
    }

    final public function __call($name, $arguments)
    {
        return call_user_func_array([$this->driver, $name], $arguments);
    }
}
