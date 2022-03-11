<?php

namespace ExAdmin\ui\component;

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
    /**
     * ajax请求
     * @param string $url 请求url 空不请求
     * @param array $params 请求参数
     * @param string $method 请求方式
     * @param bool $gridRefresh 成功刷新grid表格
     * @return $this
     */
    public function ajax(string $url, array $params = [], $method = 'POST', $gridRefresh = true)
    {
        return $this->directive('ajax', [
            'url' => $url,
            'data' => $params,
            'method' => $method,
        ],['gridRefresh'=>$gridRefresh]);
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
