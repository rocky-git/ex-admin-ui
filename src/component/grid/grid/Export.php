<?php

namespace ExAdmin\ui\component\grid\grid;
use ExAdmin\ui\component\grid\grid\excel\AbstractExporter;
use ExAdmin\ui\component\grid\grid\excel\Excel;

/**
 * @mixin AbstractExporter
 */
class Export
{
    /**
     * @var Grid
     */
    protected $grid;
    /**
     * @var AbstractExporter
     */
    protected $driver;

    protected $init;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->resolve();
        if($this->init){
            call_user_func($this->init,$this);
        }
    }
    public function resolve($driver = null){
        if(is_null($driver)){
            $this->driver = new Excel();
        }elseif($driver instanceof AbstractExporter){
            $this->driver = $driver;
        }
    }

    /**
     * @param \Closure $closure
     */
    public function init(\Closure $closure)
    {
        $this->init = $closure;
    }
    
    public function __call($name, $arguments)
    {
        call_user_func_array([$this->driver,$name],$arguments);
        return $this;
    }
}
