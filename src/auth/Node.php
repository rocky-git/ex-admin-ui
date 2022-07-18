<?php

namespace ExAdmin\ui\auth;

use ExAdmin\ui\support\Annotation;
use ExAdmin\ui\support\Arr;
use Symfony\Component\Finder\Finder;


class Node
{
    protected $node = [];

    /**
     * 获取权限节点
     * @param bool $tree 是否树形
     * @return array
     */
    public function all(bool $tree = false)
    {
        $dirs = admin_config('admin.auth_scan', []);
        $dir = dirname(__DIR__,5).'/plugin';
        if(is_dir($dir)){
            foreach (Finder::create()->directories()->in($dir)->name('controller') as $file) {
                array_push($dirs,$file->getPathname());
            }
        }
        $calss = $this->scan($dirs);
        $this->parse($calss);
        if ($tree) {
            return Arr::tree($this->node);
        }
        return $this->node;
    }

    /**
     * 扫描权限目录获取类
     * @param array $path 目录
     * @return array
     */
    public function scan(array $path)
    {
        $class = [];
        foreach ($path as $dir) {
            if(!is_dir($dir)) continue;
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
            $nodes = [];
            $reflectionClass = new \ReflectionClass($class);
            $doc = Annotation::parse($reflectionClass->getDocComment());
            $title = $class;
            if (is_array($doc)) {
                $title = $doc['title'];
            }
            $pid = $class.'-';
            $nodes[] = [
                'id' => $pid,
                'pid' => 0,
                'url' => '',
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
                        $returnType = $method->getReturnType();
                        $idPrefix = $class . '\\' . $action . '-';
                        $node = [
                            'id' => $class . '\\' . $action,
                            'pid' => $pid,
                            'action' => $action,
                            'method' => '',
                            'url' => 'ex-admin/' . str_replace('\\', '-', $class) . '/' . $action,
                            'title' => $title,
                        ];
                        $nodes[] = $node;
                        if ($returnType) {
                            if ($returnType->getName() === 'ExAdmin\ui\component\grid\grid\Grid') {
                                array_pop($nodes);
                                $node['title'] = $title . '列表';
                                $node['method'] = 'get';
                                $nodes[] = $node;
                                $node['method'] = 'delete';
                                $node['id'] = $idPrefix . $node['method'];
                                $node['title'] = $title . '删除';
                                $nodes[] = $node;
                            } elseif ($returnType->getName() === 'ExAdmin\ui\component\form\Form') {
                                array_pop($nodes);
                                $node['method'] = 'post';
                                $node['id'] = $idPrefix . $node['method'];
                                $node['title'] = $title . '添加';
                                $nodes[] = $node;
                                $node['method'] = 'put';
                                $node['id'] = $idPrefix . $node['method'];
                                $node['title'] = $title . '修改';
                                $nodes[] = $node;
                            }
                        }

                    }
                }
            }
            if (count($nodes) > 1) {
                $this->node = array_merge($this->node, $nodes);
            }
        }
        return $this->node;
    }
}
