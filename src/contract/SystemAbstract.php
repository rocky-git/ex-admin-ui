<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\response\Response;

abstract class SystemAbstract
{

    /**
     * 网站名称
     * @return string
     */
    abstract public function name(): ?string;
    /**
     * 网站logo
     * @return string
     */
    abstract public function logo(): ?string;
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

    /**
     * 导出进度
     * @param $key
     * @return Response
     */
    abstract public function exportProgress($key): Response;

    final public function info(): Response
    {
        return Response::success([
            'name'=>$this->name(),
            'logo'=>$this->logo(),
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
