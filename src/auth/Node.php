<?php

namespace ExAdmin\ui\auth;

use ExAdmin\ui\support\Annotation;
use ExAdmin\ui\support\Arr;
use Symfony\Component\Finder\Finder;
use function Composer\Autoload\includeFile;

class Node
{
    protected $node = [];
    public function __construct()
    {
        $calss = $this->scan();
        $this->parse($calss);
    }

    /**
     * 获取权限节点
     * @param bool $tree 是否树形
     * @return array
     */
    public function all(bool $tree=false)
    {
        if($tree){
            return Arr::tree($this->node);
        }
        return $this->node;
    }

    /**
     * 扫描权限目录获取类
     * @return array
     */
    public function scan()
    {
        $scan = ui_config('config.auth_scan', []);
        $class = [];
        foreach ($scan as $dir) {
            foreach (Finder::create()->files()->in($dir)->name('*.php') as $file) {
                if (preg_match('/namespace (.*);/u', $file->getContents(), $arr)) {
                    $namespace = $arr[1];
                    $className = str_replace('.php', '', $file->getFilename());
                    $class[] = "$namespace\\$className";
                }
            }
        }
        return $class;
    }

    /**
     * 解析返回权限节点
     * @param array $data 类命名空间集合
     * @return array
     * @throws \ReflectionException
     */
    public function parse(array $data)
    {
        foreach ($data as $class) {
            $node = [];
            $reflectionClass = new \ReflectionClass($class);
            $doc = Annotation::parse($reflectionClass->getDocComment());
            $title = $class;
            if (is_array($doc)) {
                $title = $doc['title'];
            }
            $node[] = [
                'id' => $class,
                'title' => $title,
                'children' => [],
            ];
            foreach ($reflectionClass->getMethods() as $method) {
                if ($method->class == $class && $method->isPublic()) {
                    $action = $method->getName();
                    $doc = Annotation::parse($method->getDocComment());
                    $title = $action;
                    if (is_array($doc)) {
                        $title = $doc['title'];
                    }
                    if (isset($doc['auth']) && $doc['auth'] === 'true') {
                        $node[] = [
                            'id' => $class . '\\' . $action,
                            'pid' => $class,
                            'method' => $action,
                            'title' => $title,
                        ];
                    }
                }
            }
            if (count($node) > 1) {
                $this->node[] = $node;
            }
        }
        return $this->node;
    }
}
