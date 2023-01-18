<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\navigation\dropdown\Dropdown;
use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Container;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
     * 网站logo跳转地址
     * @return string
     */
    abstract public function logoHref(): ?string;
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
    public function exportProgress($key): Response
    {
        $data = Container::getInstance()->cache->get($key);
        return Response::success($data??[]);
    }
    /**
     * 队列初始化
     * @param $key
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function queueInit($key){
        $key = md5($key.'queue_progress');
        $progress = Container::getInstance()->cache->delete($key);
        return Response::success();
    }
    /**
     * 队列进度
     * @param $key
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function queueProgress($key){
        $key = md5($key.'queue_progress');
        $progress = Container::getInstance()->cache->get($key);
        return Response::success($progress ?? 0);
    }
    /**
     * 操作缓存
     * @param string $type
     * @param array $params
     * @return false|mixed
     */
    final public function operationCache(string $type,array $params = []){
        return Response::success(call_user_func_array([Container::getInstance()->cache,$type],$params));
    }
    final public function info(): Response
    {
        $userInfo = $this->userInfo();
        $dropdown = Dropdown::create('');
        $menu = $dropdown->getMenu();
        $menu->content($this->adminDropdown());
        $dropdown->jsonSerialize();
        return Response::success([
            'user_info' => $userInfo,
            'name'=>$this->name(),
            'logo'=>$this->logo(),
            'logo_href'=>$this->logoHref(),
            'adminDropdown' => $dropdown,
            'adminDropdownMenuItem' => $menu->getContent('default'),
            'navbarRight' => $this->navbarRight(),
            'menu' => $this->menu(),
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

    /**
     * 下载文件
     * @param $file 文件路径
     * @return BinaryFileResponse
     */
    public function download($file){
        return (new BinaryFileResponse($file))->setContentDisposition('attachment');
    }
    /**
     * 上传写入数据库
     * @param $data 上传入库数据
     * @return Response
     */
    abstract public function upload($data): Response;

    /**
     * 验证权限
     * @param $class 类名
     * @param $function 方法
     * @param $method 请求method
     * @return bool
     */
    abstract public function checkPermissions($class, $function, $method):bool;
}
