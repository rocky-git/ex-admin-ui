<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-23
 * Time: 17:48
 */

namespace ExAdmin\ui\support;

use ExAdmin\ui\token\TokenManger;

/**
 * Class Token
 * @see TokenManger
 * @method static bool set(string $token) 设置token
 * @method static mixed get() 获取token
 * @method static string encode(array $data) 生成token
 * @method static mixed decode(string $token) 解密token
 * @method static mixed auth() 验证token
 * @method static mixed id() 获取用户id
 * @method static bool logout() 退出登录
 * @method static mixed user() 获取当前用户
 */
class Token
{

    // 调用实际类的方法
    public static function __callStatic($method, $params)
    {
        return call_user_func_array([Container::getInstance()->make(TokenManger::class), $method], $params);
    }
}