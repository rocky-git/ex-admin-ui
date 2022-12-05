<?php

namespace ExAdmin\ui\component;

trait Event
{
    //事件
    protected $event = [];

    /**
     * 移除事件
     * @param string $name 事件名称
     * @param string $type 类型
     */
    public function removeEvent($name, $type)
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
     * @param Component|string $component 要执行函数的组件，默认当前组件
     * @return $this
     */
    public function eventFunction(string $name, string $function, array $params = [], $component = null)
    {
        if (is_null($component)) {
            $component = $this;
        }
        if ($component instanceof Component) {
            $field = $component->ref();
        } else {
            $field = $component;
        }
        return $this->event($name, ['function' => $function, 'params' => $params, 'ref' => $field], 'function');
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
     * 触发自定义函数
     * @param string $name  事件名称 例如点击直接click
     * @param string $function 函数方法代码
     * @param array $params 函数方法参数
     * @return Component
     */
    public function eventCustomFunction(string $name, string $function, array $params = [])
    {
        array_push($params, $function);
        return $this->eventCustom($name, 'Function',$params);
    }

    /**
     * 触发ajax
     * @param string $name 事件名称 例如点击直接click
     * @param $url
     * @param array $params
     * @param string $method
     * @param bool $gridRefresh
     * @param bool $gridBatch
     * @return Component
     */
    public function eventAjax(string $name, $url, array $params = [], string $method = 'POST', bool $gridRefresh = false, bool $gridBatch = false){
        $url = admin_url($url);
        $this->whenShow(admin_check_permissions($url,$method));
        return $this->eventCustom($name, 'Ajax',[
            'ajax'=>[
                'url' => $url,
                'data' => $params,
                'method' => $method,
            ],
            'gridRefresh'=>$gridRefresh,
            'gridBatch'=>$gridBatch,
        ]);
    }

    /**
     * 刷新表格grid
     * @param string $name 事件名称 例如点击直接click
     * @param array $params 参数
     * @return $this
     */
    public function eventGridRefresh(string $name,array $params = []){
        return $this->eventCustom($name, 'GridRefresh',$params);
    }

    /**
     * 移除自定义事件类型
     * @param string $type
     */
    public function removeEventCustom(string $type){
        foreach ($this->event as $name=>$item){
            foreach ($item as $t=>$events){
                foreach ($events as $key=>$event){
                    if($t == 'custom' && $event['type'] == $type){
                        unset($this->event[$name][$t][$key]);
                        $this->event[$name][$t] = array_values($this->event[$name][$t]);
                    }
                }
            }
        }
    }
    /**
     * 刷新当前弹窗
     * @param string $name 事件名称 例如点击直接click
     * @param array $params 参数
     * @return $this
     */
    public function eventModalRefresh(string $name,array $params = []){
        $this->removeEventCustom('GridRefresh');
        return $this->eventCustom($name, 'ModalRefresh',$params);
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

    public function getEvent($name, $type)
    {
        return $this->event[$name][$type];
    }

    public function setEvent($name, $type, $event)
    {
        $this->event[$name][$type] = $event;
    }
}
