<?php

namespace ExAdmin\ui\plugin;

use ExAdmin\ui\support\Arr;
use Illuminate\Support\Facades\Log;

class Plugin implements \ArrayAccess
{
    /**
     * 插件目录
     * @var array
     */
    protected $path;
    /**
     * 插件名称
     * @var string
     */
    protected $name;
    /**
     * 插件管理
     * @var Manager
     */
    protected $manager;
    /**
     * 插件信息
     * @var array
     */
    protected $info;

    public function init($name, $path, Manager $manager)
    {
        $this->name = $name;
        $this->path = $path;
        $this->manager = $manager;
        $this->info = $this->manager->getInfo($name);
    }

    /**
     * 获取版本号
     * @return string
     */
    final public function version()
    {
        return $this->info['version'];
    }

    /**
     * 判断是否启用.
     *
     * @return bool
     */
    final public function enabled()
    {
        return $this->info['status'];
    }

    /**
     * 判断是否禁用.
     *
     * @return bool
     */
    final public function disabled()
    {
        return !$this->enabled();
    }

    /**
     * 获取路径
     * @return mixed
     */
    final public function getPath()
    {

        return $this->path;
    }

    /**
     * 获取名称
     * @return mixed
     */
    final public function getName()
    {
        return $this->name;
    }

    /**
     * 获取标题
     * @return string
     */
    final public function getTitle()
    {
        return $this->info['title'];
    }

    /**
     * 启用
     * @return bool
     */
    public function enable()
    {
        admin_menu()->enable($this->name);
        return $this->manager->setInfo($this->name, ['status' => true]) !== false;
    }

    /**
     * 禁用
     * @param $name 插件名称
     * @return bool
     */
    public function disable()
    {
        admin_menu()->disable($this->name);
        return $this->manager->setInfo($this->name, ['status' => false]) !== false;
    }

    /**
     * 获取插件logo
     * @return null|string
     */
    public function getLogo()
    {
        $file = $this->path . DIRECTORY_SEPARATOR . 'logo.png';
        if (is_file($file)) {
            $content = file_get_contents($file);
            return 'data:image/png;base64,' . base64_encode($content);
        }
        return null;
    }

    /**
     * 已安装
     * @return bool
     */
    final public function installed()
    {
        return is_dir($this->path) ? true : false;
    }

    /**
     * @param $data
     */
    final public function setInfo($data)
    {
        $this->info = $data;
    }

    /**
     * 获取插件信息
     * @return array
     */
    final public function getInfo()
    {
        return $this->info;
    }

    /**
     * 获取命名空间
     * @return string
     */
    final public function getNamespace()
    {
        return $this->info['namespace'] . '\\';
    }

    /**
     * 插入菜单
     */
    final public function addMenu()
    {
        if (method_exists($this, 'menu')) {
            $menu = $this->menu();
            if (!empty($menu)) {
                $this->parseMenu($menu);
            }
        }
    }

    private function parseMenu($menu, $pid = 0)
    {
        foreach ($menu as $item) {
            $item['pid'] = $pid;
            $item['plugin'] = $this->name;
            $item['url'] = admin_url($item['url']);
            $subPid = admin_menu()->create($item);
            if (isset($item['children'])) {
                $this->parseMenu($item['children'],$subPid);
            }
        }
    }
    /**
     * 翻译
     * @param string $name 语言变量名
     * @param mixed $default 默认值
     * @param array $parameters 替换参数
     * @param null $locale 语言
     * @return string
     */
    final public function trans($name, $default = null, array $parameters = [], $locale = null){
        return admin_trans($name,$default,$parameters,$locale,$this->name);
    }
    /**
     * 获取或保存配置.
     * @param string $key
     * @param string $value
     * @return array|\ArrayAccess|false|int|mixed
     */
    final public function config($key = null, $value = null)
    {
        $file = $this->path . DIRECTORY_SEPARATOR . 'config.php';
        $data = include $file;
        if (is_null($key)) {
            return $data;
        }
        if (is_null($value)) {
            return Arr::get($data, $key);
        }
        Arr::set($data, $key, $value);
        $content = var_export($data, true);
        $content = <<<PHP
<?php
return $content;
PHP;
        return file_put_contents($file, $content);
    }

    public function offsetExists($offset)
    {
        return Arr::exists($this->info, $offset);
    }


    public function offsetGet($offset)
    {
        return Arr::get($this->info, $offset);
    }

    public function offsetSet($offset, $value)
    {
        Arr::set($this->info, $offset, $value);
    }


    public function offsetUnset($offset)
    {
        unset($this->info, $offset);
    }

    public function __call($method, $arguments)
    {
        foreach (glob($this->path . '/service/*.php') as $file) {
            $name = str_replace('.php', '', basename($file));
            if (strtolower($method) == strtolower($name)) {
                $class = '\\' . $this->getNamespace() . 'service\\' . $name;
                return new $class($name, $arguments);
            }
        }
        return null;
    }

}
