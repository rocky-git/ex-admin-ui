<?php

namespace ExAdmin\ui\manager;

abstract class Manager
{
    protected $driver = null;
    function __construct($repository,$component){
        $this->setDriver($repository,$component);
        if($this->driver){
            $this->driver->initialize($component,$repository);
        }
    }

    abstract public function setDriver($repository,$component);

    final public function getDriver()
    {
        return $this->driver;
    }

    final public function __call($name, $arguments)
    {
        return call_user_func_array([$this->driver, $name], $arguments);
    }
}
