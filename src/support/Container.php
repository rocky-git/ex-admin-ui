<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-21
 * Time: 22:32
 */

namespace ExAdmin\ui\support;


class Container
{
    protected static $instance;

    protected $instances = [];
    /**
     * 获取当前容器的实例（单例）
     * @access public
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
    public function make($name,array $arguments = [], bool $newInstance = false){
        if($newInstance || !isset($this->instances[$name])){
            $this->instances[$name] = new $name(...$arguments);

        }
        return $this->instances[$name];
    }
}