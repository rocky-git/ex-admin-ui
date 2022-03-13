<?php

namespace ExAdmin\ui\component;

trait Event
{
    //事件
    protected $event = [];

    /**
     * 移除事件
     * @param $name 事件名称
     * @param $type 类型
     */
    public function removeEvent($name,$type)
    {
        $name = ucfirst($name);
        unset($this->event[$name][$type]);
        return $this;
    }

    /**
     * 触发组件函数
     * @param string $name 事件名称 例如点击直接click
     * @param string $function 函数称
     * @param array $params 函数传参
     * @param Component $component 要执行函数的组件，默认当前组件
     * @return $this
     */
    public function eventFunction(string $name, string $function, array $params = [], Component $component = null)
    {
        if (is_null($component)) {
            $component = $this;
        }
        $field = $component->ref();
        return $this->event($name, ['function' => $function, 'params' => $params, 'ref' => $field, 'name' => $component->getName()], 'function');
    }

    /**
     * 触发自定义
     * @param string $name 事件名称 例如点击直接click
     * @param string $type 自定义类型
     * @param array $params 参数
     * @return Component
     */
    public function eventCustom(string $name, string $type, array $params = [])
    {
        return $this->event($name, ['type' => $type, 'params' => $params], 'custom');
    }

    /**
     * 触发事件
     * @param string $name 事件名称 例如点击直接click
     * @param array $value
     * @param string $type variable-设置bind变量 , function-执行组件函数
     * @return $this
     */
    public function event(string $name, array $value = [], string $type = 'variable')
    {
        $name = ucfirst($name);
        $this->event[$name][$type][] = $value;
        return $this;
    }
    public function getEvent($name,$type){
        return $this->event[$name][$type];
    }
    public function setEvent($name,$type,$event){
        $this->event[$name][$type] = $event;
    }
}
