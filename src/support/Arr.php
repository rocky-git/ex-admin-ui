<?php

namespace ExAdmin\ui\support;

class Arr
{
    /**
     * 树形
     * @param array $data 数据
     * @param string $id
     * @param string $pid
     * @param string $children
     * @return array
     */
    public static function tree(array $data, $id = 'id', $pid = 'pid', $children = 'children')
    {
        $items = array();
        foreach ($data as $v) {
            $items[$v[$id]] = $v;
        }
        $tree = array();
        foreach ($items as $k => $item) {
            if (isset($items[$item[$pid]])) {
                $items[$item[$pid]][$children][] = &$items[$k];
            } else {
                $tree[] = &$items[$k];
            }
        }
        return $tree;
    }
}
