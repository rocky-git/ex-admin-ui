<?php

namespace ExAdmin\ui\plugin;


use ExAdmin\ui\support\Annotation;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Str;
use GuzzleHttp\Client;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

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

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://laravel.test/api/',
            'verify' => false,
        ]);
        $this->initialize();
    }

    protected function initialize()
    {

        $this->basePath = rtrim(admin_config('admin.plugin.dir'), '/');

        $this->plugPath = [];
        $this->plug = [];
        if (is_dir($this->basePath)) {
            foreach (glob($this->basePath . '/*') as $path) {
                $name = basename($path);
                if (is_dir($path) && $this->checkFiles($name)) {
                    $this->plugPath[$name] = $path;
                    $this->plug[$name] = new Plugin();
                    $this->plug[$name]->init($name, $path, $this);
                }
            }
        }
    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * 获取插件列表
     * @param $type 0线上，1本地已安装
     * @param string $search 搜索标题
     * @param int $cate_id 分类id
     * @param int $page 页码
     * @param int $size 页码大小
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList($type, $search = '', $cate_id = 0, $page = 1, $size = 20)
    {
        $plugs = [];
        $names = [];
        if ($type == 1) {
            $plugs = $this->getPlug();
            if ($search) {
                foreach ($plugs as $name => $plug) {
                    if (strpos($plug['title'], $search) === false &&
                        strpos($plug['name'], $search) === false &&
                        strpos($plug['description'], $search) === false &&
                        strpos($plug['author'], $search) === false) {
                        unset($plugs[$name]);
                    }
                }
            }
            $names = array_keys($this->getPlug());
        }
        $response = $this->client->get("plugin/list", [
            'query' => [
                'cate_id' => $cate_id,
                'page' => $page,
                'size' => $size,
                'search' => $search,
                'names' => $names,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);
        if ($type == 1) {
            foreach ($plugs as $name => &$plug) {
                foreach ($content['data']['data'] as $item) {
                    if ($name == $item['name']) {
                        $plug = $this->getPlug($item['name']);
                        $plug['price'] = $item['price'];
                        $plug['is_free'] = $item['is_free'];
                        $plug['online'] = true;
                    }
                }
            }
        } else {
            foreach ($content['data']['data'] as $item) {
                if (array_key_exists($item['name'], $this->plug)) {
                    $plug = $this->getPlug($item['name']);
                    $plug['price'] = $item['price'];
                    $plug['is_free'] = $item['is_free'];
                    $plug['online'] = true;
                } else {
                    $plug = new Plugin();
                    $plug->init($item['name'], $this->basePath . '/' . $item['name'], $this);
                    $info = [
                        "name" => $item['name'],
                        "title" => $item['title'],
                        "description" => $item['description'],
                        "price" => $item['price'],
                        "is_free" => $item['is_free'],
                        "status" => false,
                        "online" => true,
                        "version" => "",
                        "author" => $item['author'],
                        "namespace" => "plugin\\" . $item['name']
                    ];
                    $plug->setInfo($info);
                }
                $plugs[] = $plug;
            }
        }

        return [
            'data' => $plugs,
            'total' => $content['data']['total'],
        ];
    }

    public function upload($data)
    {
        $path = $this->getPlug($data['name'])->getPath();
        $zip = new \ZipArchive();
        $zipPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $data['name'] . '.zip';
        if ($zip->open($zipPath, \ZipArchive::CREATE) === true) {
            foreach (Finder::create()->in($path)->files() as $file) {
                $zip->addFile($file->getRealPath(), $file->getRelativePathname());
            }
            $zip->close();
            $response = $this->client->post('plugin/upload', [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($zipPath, 'r'),
                        'filename' => basename($zipPath)
                    ],
                    [
                        'name'     => 'data',
                        'contents' => json_encode($data),
                    ],
                ]
            ]);
            $content = $response->getBody()->getContents();
            $content = json_decode($content, true);
            if($content['code'] === 0){
                return true;
            }
            return $content['message'];
        } else {
            throw new \Exception('zip 创建失败');
        }
    }

    /**
     * 获取插件分类
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCate()
    {
        $response = $this->client->get("plugin/cate");
        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);
        return $content['data'];
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

    public function __get($name)
    {
        return $this->plug[$name];
    }


    /**
     * 创建插件
     * @param $author 插件作者
     * @param $name 插件名称
     * @param $title 插件标题
     * @param string $description 插件描述
     * @param string $version 版本
     * @return bool
     */
    public function create($author, $name, $title, $description = '', $version = '1.0.0')
    {
        $info = compact('name', 'title', 'description');
        $info['status'] = true;
        $info['version'] = $version;
        $info['author'] = $author;
        $info['namespace'] = admin_config('admin.plugin.namespace', 'plugin') . '\\' . $name;
        $this->setInfo($name, $info);
        $path = $this->basePath . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
        $file = new Filesystem();
        //控制器目录
        $file->mkdir($path . 'controller');
        //模型目录
        $file->mkdir($path . 'model');
        //语言包目录
        $file->mkdir($path . 'lang');
        //服务层
        $content = file_get_contents(__DIR__ . '/stub/Service.stub');
        $content = str_replace('{%namespace%}', $info['namespace'], $content);
        $file->dumpFile($path . 'service/Service.php', $content);
        //服务提供
        $content = file_get_contents(__DIR__ . '/stub/ServiceProvider.stub');
        $content = str_replace('{%namespace%}', $info['namespace'], $content);
        $file->dumpFile($path . 'ServiceProvider.php', $content);
        $this->loadPlugin($name, $path);
        //config文件
        return $file->dumpFile($path . 'config.php', '<?php return [];');
    }

    /**
     * 生成IDE
     * @return false|int
     */
    public function buildIde()
    {
        $this->initialize();
        $this->register();
        $content = file_get_contents(__DIR__ . '/stub/IDE.stub');
        $doc = '';
        $i = 0;
        $count = count($this->plug);
        foreach ($this->plug as $name => $plug) {
            if ($plug->disabled()) {
                continue;
            }
            $title = $plug['title'];
            $namespace = $plug['namespace'];
            $doc .= " * @property \\{$namespace}\\ServiceProvider \$$name $title";
            if (($i + 1) != $count) {
                $doc .= PHP_EOL;
            }
            $i++;
            $serviceContent = <<<PHP
namespace $namespace{
    /**
    {%doc%}
     */
    class ServiceProvider{}
}
PHP;
            $j = 0;
            $methodDoc = '';
            $files = glob($plug->getPath() . '/service/*.php');
            foreach ($files as $file) {
                $name = str_replace('.php', '', basename($file));
                $method = Str::camel($name);
                $class = "\\$namespace\\service\\$name";
                $ReflectionClass = new \ReflectionClass($class);
                $docArr = Annotation::parse($ReflectionClass->getDocComment());
                $title = '';
                if ($docArr) {
                    $title = $docArr['title'];
                }
                $methodDoc .= " * @method $class $method() {$title}";
                if (($j + 1) != count($files)) {
                    $methodDoc .= PHP_EOL;
                }
                $j++;
            }
            $serviceContent = str_replace('{%doc%}', $methodDoc, $serviceContent);
            $content .= $serviceContent . PHP_EOL;
        }
        $content = str_replace('{%doc%}', $doc, $content);

        return file_put_contents($this->basePath . DIRECTORY_SEPARATOR . 'IDE.php', $content);
    }

    /**
     * 注册插件
     */
    public function register()
    {

        foreach ($this->plugPath as $name => $path) {
            $this->loadPlugin($name, $path);
        }
    }

    protected function loadPlugin($name, $path)
    {
        $loader = include __DIR__ . '/../../../../autoload.php';
        $info = $this->getInfo($name);
        if ($info['status']) {
            $namespace = $info['namespace'] . '\\';
            $loader->addPsr4($namespace, $path);
            $ServiceProvider = $namespace . "ServiceProvider";
            Container::getInstance()->translator->load($path . DIRECTORY_SEPARATOR . 'lang');
            $this->plug[$name] = new $ServiceProvider();
            $this->plug[$name]->init($name, $path, $this);
            $this->plug[$name]->register();
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

    /**
     * 卸载
     * @param string $name 插件名称
     * @return bool
     */
    public function uninstall($name)
    {
        $file = new Filesystem();
        $result = $file->remove($this->plugPath[$name]);
        $this->buildIde();
        return $result;
    }
}
