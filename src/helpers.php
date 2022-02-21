<?php
if (!function_exists('ui_config')) {
    /**
     * 获取和设置配置参数
     * @param string|array $name  参数名
     * @param mixed        $value 参数值
     * @return mixed
     */
    function ui_config($name = '', $value = null)
    {
        $config = \ExAdmin\ui\support\Container::getInstance()
            ->make(ExAdmin\ui\support\Config::class,[__DIR__.'/config']);
        if (is_array($name)) {
            return $config->set($name, $value);
        }
        return 0 === strpos($name, '?') ? $config->has(substr($name, 1)) : $config->get($name, $value);
    }
}
if (!function_exists('ui_trans')) {
    /**
     * 翻译
     * @param $id 名称
     * @param null $domain 作用域
     * @param array $parameters 替换参数
     * @param null $locale 语言
     * @return string
     */
    function ui_trans($id, $domain = null, array $parameters = [], $locale = null)
    {
        return \ExAdmin\ui\support\Container::getInstance()
            ->make(\ExAdmin\ui\support\Translator::class,[ui_config('lang')])
            ->trans($id,$parameters,$domain,$locale);
       
    }
}
