<?php

namespace ExAdmin\ui\contract;

abstract class MenuAbstract
{
    /**
     * 菜单
     * @return array
     */
    abstract public function all() :array;

    /**
     * 创建菜单
     * @param array $data
     * @param $plugin
     * @return mixed
     */
    abstract public function create(array $data,$plugin);

    /**
     * 启用菜单
     * @param $plugin
     * @return mixed
     */
    abstract public function enable($plugin);

    /**
     * 禁用菜单
     * @param $plugin
     * @return mixed
     */
    abstract public function disable($plugin);

    /**
     * 删除菜单
     * @param $plugin
     * @return mixed
     */
    abstract public function delete($plugin);

}
