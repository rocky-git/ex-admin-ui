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
        $this->drive->deling($closure);
    }

    /**
     * 删除后
     * @param \Closure $closure
     */
    public function deleted(\Closure $closure)
    {
        $this->drive->deleted($closure);
    }
    /**
     * 更新前
     * @param \Closure $closure
     */
    public function updateing(\Closure $closure)
    {
        $this->drive->updateing($closure);
    }

    /**
     * 更新后
     * @param \Closure $closure
     */
    public function updated(\Closure $closure)
    {
        $this->drive->updated($closure);
    }
}
