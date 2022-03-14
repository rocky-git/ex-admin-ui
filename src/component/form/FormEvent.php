<?php

namespace ExAdmin\ui\component\form;

trait FormEvent
{
    /**
     * 保存前
     * @param \Closure $closure
     */
    public function saving(\Closure $closure)
    {
        $this->drive->saving($closure);
    }

    /**
     * 保存后
     * @param \Closure $closure
     */
    public function saved(\Closure $closure)
    {
        $this->drive->saved($closure);
    }
}
