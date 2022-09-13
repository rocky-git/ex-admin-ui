<?php

namespace ExAdmin\ui\traits;

use ExAdmin\ui\support\Container;

trait queueProgress
{
    /**
     * 进度.
     * @var string
     */
    protected $progress = 0;

    /**
     * 更新进度百分比.
     * @param mixed $total 总和
     * @param mixed $percent 百分比
     */
    protected function percentage($total, $percent = 100)
    {
        $total = max($total, 1);
        $progress = bcadd(bcdiv(strval($percent), strval($total), 2), strval($this->progress), 2);
        $this->progress($progress);
    }

    /**
     * 设置进度.
     * @param mixed $progress 进度
     */
    protected function progress($progress)
    {
        $key = md5(self::class . 'queue_progress');
        Container::getInstance()->cache->set($key, $this->progress = $progress);
    }

    /**
     * 成功
     * @return void
     */
    protected function success()
    {
        $this->progress(100);
    }

    /**
     * 失败
     * @param string $message
     * @return void
     */
    protected function error(string $message)
    {
        $this->progress($message);
    }
}
