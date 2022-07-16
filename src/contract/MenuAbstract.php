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
     * @return int
     */
    abstract public function create(array $data):int;
    /**
     * 获取菜单
     * @param array $data
     * @return array
     */
    abstract public function get($id);
    /**
     * 更新菜单
     * @param int $id
     * @param array $data
     * @return mixed
     */
    abstract public function update($id,array $data);
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
