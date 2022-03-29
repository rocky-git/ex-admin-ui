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

   

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->resolve();
    }
    public function resolve($driver = null){
        if(is_null($driver)){
            $this->driver = new Excel();
        }elseif($driver instanceof AbstractExporter){
            $this->driver = $driver;
        }

    }
    /**
     * @return AbstractExporter
     */
    public function driver()
    {
        return $this->driver ?: $this->resolve();
    }
    /**
     * @param \Closure $closure
     */
    public function init(\Closure $closure)
    {
        call_user_func($closure,$this);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->driver,$name],$arguments);
    }
}
