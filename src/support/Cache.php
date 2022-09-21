<?php

namespace ExAdmin\ui\support;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Cache
{
    protected $filesystemAdapter;

    public function __construct()
    {
        $frame = php_frame();
        $dir = sys_get_temp_dir();
        try {
            $dir = plugin()->$frame->config('cache.directory');
        }catch (\Throwable $exception){

        }
        $this->filesystemAdapter = new FilesystemAdapter('ex_admin_cache', 0, $dir);
    }

    /**
     * 设置缓存
     * @param string $name 缓存名称
     * @param mixed $value 缓存值
     * @param int|null $ttl 过期时间（秒）
     * @return void
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function set($name, $value, int $ttl = null)
    {
        $item = $this->filesystemAdapter->getItem($name);
        $item->set($value);
        if(!empty($ttl)){
            $item->expiresAfter($ttl);
        }
        return $this->filesystemAdapter->save($item);
    }

    /**
     * 获取缓存
     * @param string $name
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function get($name){
        $item = $this->filesystemAdapter->getItem($name);
        return $item->get();
    }
    /**
     * 删除缓存
     * @param string $name 缓存名称
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function delete($name){
        return $this->filesystemAdapter->delete($name);
    }
}
