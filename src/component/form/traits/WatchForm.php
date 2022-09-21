<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-17
 * Time: 22:20
 */

namespace ExAdmin\ui\component\form\traits;


use ExAdmin\ui\component\form\Watch;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Request;

trait WatchForm
{
    protected $watch = [];

    /**
     * 设置监听数据方法
     * @param array $data
     */
    public function watch(array $data)
    {
        $this->watch = $data;
        $fields = array_keys($this->watch);
        $this->attr('watch',$fields);
    }
    /**
     * 初始化触发一次watch
     * @return void
     */
    protected function initWatch(){
        $watch   = new Watch($this->data,true);
        foreach ($this->watch as $field=>$closure){
            if(strpos($field,'.*.') !== false){
                continue;
            }
            $value = Arr::get($this->data,$field);
            if(is_object($value) && method_exists($value,'toArray')){
                $value = $value->toArray();
            }
            call_user_func_array($closure, [$value, $watch,$value]);
        }
        $this->data = array_merge($this->data,$watch->get());
    }
    public function getWatch(){
        return $this->watch;
    }
}
