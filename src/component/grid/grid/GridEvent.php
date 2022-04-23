<?php

namespace ExAdmin\ui\component\grid\grid;

trait GridEvent
{
    /**
     * 删除前
     * @param \Closure $closure
     */
    public function deling(\Closure $closure)
    {
        $this->driver->deling($closure);
    }

    /**
     * 删除后
     * @param \Closure $closure
     */
    public function deleted(\Closure $closure)
    {
        $this->driver->deleted($closure);
    }
    /**
     * 更新前
     * @param \Closure $closure
     */
    public function updateing(\Closure $closure)
    {
        $this->driver->updateing($closure);
    }

    /**
     * 更新后
     * @param \Closure $closure
     */
    public function updated(\Closure $closure)
    {
        $this->driver->updated($closure);
    }
}
