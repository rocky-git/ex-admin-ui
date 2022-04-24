<?php

namespace ExAdmin\ui\plugin;


use Illuminate\Support\Facades\Log;
use Symfony\Component\Filesystem\Filesystem;

class Manager
{
    /**
     * 插件基础目录
     * @var string
     */
    protected $basePath;
    /**
     * 插件目录集合
     * @var array
     */
    protected $plugPath = [];
    /**
     * 插件集合
     * @var array
     */
    protected $plug = [];

    public function __construct()
    {
        $this->basePath = rtrim(admin_config('admin.plugin.dir'), '/');
        if (is_dir($this->basePath)) {
            foreach (glob($this->basePath . '/*') as $path) {
                $name = basename($path);
                if (is_dir($path) && $this->checkFiles($name)) {
                    $this->plugPath[$name] = $path;
                    $this->plug[$name] = new Plugin($name, $path, $this);
                }
            }
        }

    }

    /**
     * 获取插件
     * @param $name
     * @return Plugin
     */
    public function getPlug($name = null)
    {
        if (is_null($name)) {
            return $this->plug;
        }
        return $this->plug[$name];
    }

    /**
     * 创建插件
     * @param $author 插件作者
     * @param $name 插件名称
     * @param $title 插件标题
     * @param string $description 插件描述
     * @return bool
     */
    public function create($author, $name, $title, $description = '')
    {
        $info = compact('name', 'title', 'description');
        $info['status'] = true;
        $info['version'] = '1.0.0';
        $info['author'] = $author;
        $info['namespace'] = admin_config('admin.plugin.namespace', 'plugin') . '\\' . $name;
        $this->setInfo($name, $info);
        $path = $this->basePath . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
        //控制器目录
        mkdir($path . 'controller');
        //模型目录
        mkdir($path . 'model');
        //语言包目录
        mkdir($path . 'lang');
        //服务目录
        mkdir($path . 'service');
        //config文件
        return file_put_contents($path . 'config.php', '<?php return [];');
    }

    /**
     * 注册插件
     */
    public function register()
    {
        $loader = include __DIR__ . '/../../../../vendor/autoload.php';

        foreach ($this->plugPath as $name => $path) {
            $info = $this->getInfo($name);
            if ($info['status']) {
                $loader->addPsr4($info['namespace'], $path);
            }
        }
    }

    /**
     * 校验插件目录内容是否正确
     * @param $name
     * @return bool
     */
    public function checkFiles($name)
    {
        $jsonFile = $this->infoPath($name);

        if (!is_file($jsonFile)) {
            return false;
        }
        $info = $this->getInfo($name);

        if (!isset($info['name'])
            || !isset($info['status'])
            || !isset($info['version'])
            || !isset($info['namespace'])
        ) {
            return false;
        }
        return true;
    }

    /**
     * 获取插件信息
     * @param string $name 插件名称
     * @return array
     */
    public function getInfo($name)
    {
        $jsonFile = $this->infoPath($name);
        if (!is_file($jsonFile)) {
            return [];
        }
        $info = json_decode(file_get_contents($jsonFile), true);
        return $info;
    }

    /**
     * 返回插件info文件路径
     * @param string $name 插件名称
     * @return string
     */
    public function infoPath($name)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'info.json';
    }

    /**
     * 设置插件信息
     * @param string $name
     * @return false|string
     */
    public function setInfo($name, array $data)
    {
        $content = $this->getInfo($name);
        $content = array_merge($content, $data);
        $file = new Filesystem();
        return $file->dumpFile($this->infoPath($name), json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
