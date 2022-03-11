<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;

interface LoginInterface
{
    /**
     * 登陆页
     * @return Component
     */
    public function index(): Component;

    /**
     * 登录验证
     * @param array $data 提交数据
     * @return Message
     */
    public function check(array $data): Message;

    /**
     * 退出登录
     * @return Message
     */
    public function logout(): Message;
}
