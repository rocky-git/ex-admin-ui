<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\response\Response;

abstract class SystemAbstract
{
    /**
     * 头部导航右侧
     * @return array
     */
    abstract public function navbarRight(): array;

    /**
     * 头部点击用户信息下拉菜单
     * @return array
     */
    abstract public function adminDropdown(): array;

    /**
     * 用户信息
     * @return array
     */
    abstract public function userInfo(): array;

    /**
     * 菜单
     * @return array
     */
    abstract public function menu(): array;


    final public function info(): Response
    {
        return Response::success([
            'adminDropdown' => $this->adminDropdown(),
            'navbarRight' => $this->navbarRight(),
            'menu' => $this->menu(),
            'user_info' => $this->userInfo(),
        ]);
    }

    /**
     * 配置信息
     * @return Response
     */
    public function config(): Response
    {
        return Response::success(admin_config('*'));
    }
}
