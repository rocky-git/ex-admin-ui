<?php


namespace ExAdmin\ui\response;


use ExAdmin\ui\support\Container;

trait MessageTrait
{
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
    public function refreshMenu()
    {
        $class = admin_config('admin.request_interface.system');
        $this->data['menu'] = Container::getInstance()->route->invokeMethod($class, 'menu');
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
}