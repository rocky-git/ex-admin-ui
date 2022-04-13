<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;

abstract class LoginAbstract
{
    /**
     * 登陆页
     * @return Component
     */
    abstract public function index(): Component;

    /**
     * 登录验证
     * @param array $data 提交数据
     * @return Message
     */
    abstract public function check(array $data): Message;

    /**
     * 退出登录
     * @return Message
     */
    abstract public function logout(): Message;
}
