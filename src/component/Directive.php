<?php

namespace ExAdmin\ui\component;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\navigation\menu\MenuItem;

trait Directive
{
    //自定义指令
    protected $directive = [];
    /**
     * @param string $name 指令名称
     * @param string|array $value 值
     * @param string|array $argument 参数(可选)
     * @return $this
     */
    public function directive($name, $value = '', $argument = '')
    {
        $this->directive[] = ['name' => $name, 'argument' => $argument, 'value' => $value];
        return $this;
    }
    public function getDirective(){
        return $this->directive;
    }
    public function setDirective(array $directive){
        $this->directive = $directive;
    }

    /**
     * ajax请求
     * @param string|array $url 请求url 空不请求
     * @param array $params 请求参数
     * @param string $method 请求方式
     * @return Ajax
     */
    public function ajax($url, array $params = [],string $method = 'POST')
    {
        $url = $this->parseUrl($url);
        return new Ajax($this,[
            'url' => $url,
            'data' => $params,
            'method' => $method,
        ]);
    }
    /**
     * 跳转路径
     * @param string $url
     * @param array $params
     * @return $this
     */
    public function redirect($url, $params = [])
    {
        list($url, $params) = $this->parseComponentCall($url, $params);
        $url = $url . '?' . http_build_query($params);
        $style = $this->attr('style') ?? [];
        $style = array_merge($style, ['cursor' => 'pointer']);
        $this->attr('style', $style);
        return $this->directive('redirect', $url);

    }

    /**
     * 拷贝
     * @param string $content 复制文本
     * @return Component
     */
    public function copy(string $content){
        return $this->directive('copy', $content);
    }
}
