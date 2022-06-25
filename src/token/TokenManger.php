<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-21
 * Time: 21:26
 */

namespace ExAdmin\ui\token;


use ExAdmin\ui\support\Request;


use think\Model;

class TokenManger
{
    protected $token;
    //过期时间
    protected $expire = null;
    //密钥
    protected $key;
    //是否唯一登录
    protected $unique;

    protected $authField = [];

    protected $pk;
    /**
     * @var TokenDriver
     */
    protected $driver;

    public function __construct()
    {
        $config = admin_config('admin.token');
        $this->key = $config['key'];
        $this->expire = $config['expire'];
        $this->unique = $config['unique'];
        $this->authField = $config['auth_field'];
        $this->driver = new $config['driver'];
        $this->pk = $this->driver->getPk();
        $this->token = Request::header('Authorization') ?? urldecode(Request::input('Authorization'));
    }

    /**
     * 设置token
     * @param $token
     */
    public function set($token)
    {
        $this->token = $token;
    }

    /**
     * 获取token
     * @return mixed
     */
    public function get()
    {
        return $this->token;
    }

    /**
     * 生成token
     * @param array $data
     * @return string
     */
    public function encode(array $data)
    {
        if ($this->expire) {
            $data['token_expire'] = time() + $this->expire;
        }
        $data['token_time'] = time();
        $token = openssl_encrypt(json_encode($data), 'DES-ECB', $this->key);
        if ($this->unique && isset($data[$this->pk])) {

            $this->driver->setLastToken($data[$this->pk], $token, $this->expire);
        }
        $this->driver->set($token, $this->expire);
        return $token;
    }

    /**
     * 解密token
     * @param $token
     * @return mixed
     */
    public function decode($token)
    {
        $data = openssl_decrypt($token, 'DES-ECB', $this->key);
        if ($data) {
            $data = json_decode($data, true);
        }
        return $data;
    }

    /**
     * 验证
     * @return bool
     * @throws AuthException
     */
    public function auth()
    {
        if (!$this->token) {
            throw new AuthException('请先登陆再访问', 40000);
        }
        $data = $this->decode($this->token);
        if ($data === false || !$this->driver->has($this->token)) {
            throw new AuthException('授权认证失败', 40001);
        } elseif ($this->unique && $this->token != $this->driver->getLastToken($data[$this->pk])) {
            throw new AuthException('账号已在其他地方登陆', 40002);
        } elseif (isset($data['token_expire']) && $data['token_expire'] < time()) {
            throw new AuthException('认证身份过期，请重新登陆', 40003);
        }
        $user = $this->user();
        if ($user){
            foreach ($this->authField as $field) {
                if (isset($data[$field]) && $data[$field] != $user[$field]) {
                    throw new AuthException('认证身份失效，请重新登陆', 40004);
                }
            }
        }else{
            throw new AuthException('用户身份失效，请重新登陆', 40005);
        }
        return true;
    }

    /**
     * 获取用户id
     * @return mixed
     */
    public function id()
    {
        $data = $this->decode($this->token);
        if ($data) {
            return $data[$this->pk];
        }
        return null;
    }

    /**
     * 退出登录
     * @return bool
     */
    public function logout()
    {
        return $this->driver->delete($this->token);
    }

    /**
     * 获取当前用户
     * @return mixed
     */
    public function user()
    {
        if (!$this->id()) {
            return null;
        }
        return $this->driver->user($this->id());
    }
}