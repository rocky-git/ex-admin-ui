<?php
namespace ExAdmin\ui\exception;

use Throwable;

class DelayedException extends \Exception
{
    protected $component;

    public function create(){

    }
    public function getComponent(){
        return $this->component;
    }
}
