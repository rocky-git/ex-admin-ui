<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-22
 * Time: 00:27
 */

namespace ExAdmin\ui\token;
abstract class TokenDriver
{
    protected $model;

    public function __construct()
    {
        $model = admin_config('admin.token.model');
        $this->model = new $model;
    }

    /**
     * 存储token
     * @param string $token token
     * @param int $expire 过期时长
     * @return bool
     */
    abstract public function set($token, $expire);

    /**
     * token是否可用
     * @param string $token
     * @return bool
     */
    abstract public function has($token);

    /**
     * 删除token
     * @param string $token token
     * @return bool
     */
    abstract public function delete($token);

    /**
     * 存储最后token
     * @param int $id 用户id
     * @param string $token
     * @param int $expire
     * @return bool
     */
    abstract public function setLastToken($id, $token, $expire);

    /**
     * 获取最后token
     * @param int $id 用户id
     * @return mixed
     */
    abstract public function getLastToken($id);

    /**
     * 获取主键
     * @return int
     */
    abstract public function getPk();

    /**
     * 获取当前用户
     * @param int $id 用户id
     * @return mixed
     */
    abstract public function user($id);
}