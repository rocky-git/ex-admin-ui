<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\response\Response;

interface CommonInterface
{
    /**
     * 头部导航右侧
     * @return array
     */
    public function navbarRight(): array;

    /**
     * 头部点击用户信息下拉菜单
     * @return array
     */
    public function adminDropdown(): array;

    /**
     * 配置信息
     * @return Response
     */
    public function config(): Response;
}
