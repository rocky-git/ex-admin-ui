<?php
namespace ExAdmin\ui\response;
use ExAdmin\ui\support\Container;

/**
 * Message 响应提示
 * @method $this success(string $message) 成功
 * @method $this error(string $message) 失败
 * @method $this info(string $message) 信息
 * @method $this warning(string $message) 警告
 */
class Notification implements \JsonSerializable
{
    protected $response = [
        'code' => 80010,
    ];
    protected $data = [
        'placement' => 'topRight',
        'type' => 'success',
        'message' => '',
        'description' => '',
        'url' => ''
    ];
    protected $config = [];

    public function __construct($config = [])
    {
        $this->data = $config;

    }

    public function __call($name, $arguments)
    {
        $this->data['type'] = $name;
        $this->data['message'] = $arguments[0];
        $this->data['description'] = $arguments[1];
        return $this;
    }

    /**
     * 跳转url
     * @param string $url
     * @return $this
     */
    public function redirect($url)
    {
        $this->data['url'] = $url;
        return $this;
    }
    /**
     * 刷新菜单
     * @return $this
     */
    public function refreshMenu(){
        $class = admin_config('admin.request_interface.system');
        $this->data['menu'] = Container::getInstance()->route->invokeMethod($class,'menu');
        return $this;
    }
    /**
     * 刷新当前页面
     */
    public function refresh()
    {
        $this->data['refresh'] = true;
        return $this;
    }
    public function data(array $data)
    {
        $this->data = array_merge($this->data, ['data' => $data]);
        return $this;
    }
    public function jsonSerialize()
    {
        $this->response['data'] = $this->data;
        return $this->response;
    }
}
