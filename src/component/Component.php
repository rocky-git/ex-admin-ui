<?php

namespace ExAdmin\ui\component;


use ExAdmin\ui\component\feedback\Confirm;
use ExAdmin\ui\component\feedback\Drawer;
use ExAdmin\ui\component\feedback\Modal;
use ExAdmin\ui\traits\CallProvide;
use think\helper\Str;
use think\app\Url;

/**
 * Class Component
 * @package Eadmin\component
 * @method $this style(array $value) 样式
 * @method static $this create() 创建
 */
abstract class Component implements \JsonSerializable
{
    use Where, ForMap, Event, Directive, CallProvide;

    //组件名称
    protected $name;
    //属性
    protected $attribute = [];
    //内容
    protected $content = [];
    //绑定值
    protected $bind = [];
    //属性绑定
    protected $bindAttribute = [];
    //属性绑定自定义函数
    protected $bindFunction = [];
    //双向绑定
    protected $modelBind = [];
    //expose绑定
    protected $bindExpose = [];
    //初始化
    protected static $init = [];

    protected $vModel = 'value';
    // 插槽
    protected $slot = [];

    public function __construct()
    {
        $this->parseCallMethod();
        foreach (self::$init as $class => $init) {
            if (static::class == $class) {
                call_user_func($init, $this);
            }
        }
    }

    /**
     * 初始化
     * @param \Closure $closure
     */
    public static function init(\Closure $closure)
    {
        self::$init[static::class] = $closure;
    }


    /**
     * 设置属性
     * @param string $name 属性名
     * @param null $value 值
     * @return $this|mixed
     */
    public function attr(string $name, $value = null)
    {
        if (func_num_args() == 1) {
            return $this->attribute[$name] ?? null;
        } else {
            $this->attribute[$name] = $value;
            return $this;
        }
    }

    public function attrs(array $attrs)
    {
        $this->attribute = array_merge($this->attribute, $attrs);
        return $this;
    }

    public function removeAttr($name)
    {
        unset($this->attribute[$name]);
        return $this;
    }

    public function removeBind($name)
    {
        unset($this->bind[$name]);
    }

    public function removeAttrBind($name)
    {
        unset($this->modelBind[$name]);
        unset($this->bindAttribute[$name]);
    }

    /**
     * 绑定属性对应绑定字段
     * @param string $name 属性名称
     * @param string $field 绑定字段名称
     * @param bool $model 是否双向绑定
     */
    public function bindAttr(string $name, $field = null, $model = false)
    {
        if (is_null($field)) {
            return $this->bindAttribute[$name] ?? null;
        } else {
            if ($model) {
                $this->modelBind[$name] = $field;
            }
            $this->bindAttribute[$name] = $field;
            return $this;
        }
    }

    /**
     * 绑定组件暴露属性
     * @param string $expose 组件暴露出来的属性
     * @param string|null $attr 绑定属性
     * @param Component|null $component 暴露属性的组件
     * @return $this
     */
    public function bindExpose(string $expose, string $attr = null, Component $component = null)
    {
        if (is_null($component)) {
            $component = $this;
        }
        if (is_null($attr)) {
            $attr = $expose;
        }
        $field = $component->ref();
        $this->bindExpose[] = ['ref' => $field, 'expose' => $expose, 'attr' => $attr];
        return $this;
    }

    /**
     * 绑定属性函数
     * @param string $attr 属性
     * @param string $function 函数体js
     * @param array $params 函数参数定义
     */
    public function bindFunction(string $attr, string $function, array $params = [])
    {
        array_push($params, $function);
        $this->bindFunction[$attr] = $params;
    }

    /**
     * 绑定ref
     * @return string
     */
    public function ref()
    {
        $field = $this->bindAttr('ref');
        if (is_null($field)) {
            $field = $this->random();
            $this->vModel('ref', $field, '', false);
        }
        return $field;
    }

    /**
     * 获取绑定属性字段值
     * @param $attr
     * @return $this|null
     */
    public function getbindAttrValue($attr)
    {
        $field = $this->bindAttr($attr);
        return empty($field) ? null : $this->bind($field);
    }

    /**
     * 绑定值
     * @param string $name 字段名称
     * @param mixed $value 值
     * @return $this
     */
    public function bind(string $name, $value = null)
    {
        if (is_null($value)) {
            return $this->bind[$name] ?? null;
        } else {
            $this->bind[$name] = $value;
            return $this;
        }
    }

    protected function random()
    {
        $str = '';
        for ($i = 0; $i < 30; $i++) {
            $str .= chr(rand(97, 122));
        }
        return $str;
    }


    public function __call($name, $arguments)
    {
        if (in_array($name, $this->slot)) {
            return $this->content($arguments[0], $name);
        }
        if (empty($arguments)) {
            return $this->attr($name, true);
        } else {
            return $this->attr($name, ...$arguments);
        }

    }

    public static function __callStatic($name, $arguments)
    {
        if ($name == 'create') {
            return new static(...$arguments);
        }
    }


    /**
     * 插槽内容
     * @param mixed $content 内容
     * @param string $name 插槽名称
     * @return $this
     */
    public function content($content, $name = 'default')
    {

        if (is_null($content)) {
            return $this;
        }
        if (is_array($content)) {
            foreach ($content as $item) {
                $this->content($item, $name);
            }
        } else {
            if ($content instanceof Component) {
                if ($content->componentVisible) {
                    $this->content[$name][] = $content;
                }
            } else {
                $this->content[$name][] = $content;
            }
        }
        return $this;
    }


    /**
     * 条件执行
     * @param $condition
     * @param \Closure $closure
     * @param \Closure|null $other
     * @return $this
     */
    public function when($condition, \Closure $closure, $other = null)
    {
        $res = null;
        if ($condition) {
            $res = $closure($this, $condition);
        } else {
            if ($other instanceof \Closure) {
                $res = $other($this, $condition);
            }
        }
        if ($res) {
            return $res;
        } else {
            return $this;
        }
    }

    /**
     * 双向绑定
     * @param string $name 双向绑定属性名称
     * @param null $field 双向绑定js字段
     * @param string $value js默认字段值
     * @param bool $model 是否双向绑定
     * @return string
     */
    public function vModel($name = 'value', $field = null, $value = '', $model = true)
    {
        if (empty($field)) {
            $field = $this->random();
        }
        $this->bind($field, $value);
        $this->bindAttr($name, $field, $model);
        return $field;
    }

    public function getModel()
    {
        return $this->bindAttr($this->vModel);
    }

    /**
     * @param $url
     * @param $params
     * @return array
     */
    protected function parseComponentCall($component, $params): array
    {
        if ($component instanceof Component) {
            $call = $component->getCall();
            $component = "ex-admin/{$call['class']}/{$call['function']}";
            $params = $call['params'];
        }
        return array($component, $params);
    }

    /**
     * Modal 对话框
     * @param string|Component $url
     * @param array $params
     * @param string $method
     * @return Modal
     */
    public function modal($url = '', $params = [], $method = 'GET')
    {
        return $this->modalParse(Modal::class,$url,$params,$method);

    }
    /**
     * Modal 对话框
     * @param string|Component $url 请求url 空不请求
     * @param array $params 请求参数
     * @param string $method 请求方式
     * @return Drawer
     */
    public function drawer($url = '', $params = [], $method = 'GET')
    {
        return $this->modalParse(Drawer::class,$url,$params,$method);
    }
    private function modalParse($component,$url = '', $params = [], $method = 'GET'){
        list($url, $params) = $this->parseComponentCall($url, $params);
        $modal = $component::create($this);
        $this->eventCustom('click', 'Modal', ['url' => $url, 'data' => $params, 'method' => $method, 'modal' => $modal->getModel()]);
        return $modal;
    }
    /**
     * 确认消息框
     * @param string $message 确认内容
     * @param string $url 请求url 空不请求
     * @param array $params 请求参数
     * @return Confirm
     */
    public function confirm(string $message, string $url = '', array $params = [], $method = 'POST')
    {
        return Confirm::create($this)
            ->method($method)
            ->title(admin_trans('antd.Confirm.title'))
            ->content($message)
            ->url($url)
            ->params($params);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function jsonSerialize()
    {
        if (!$this->attr('key')) {
            $this->attr('key', $this->random());
        }
        if ($this->componentVisible) {
            return [
                'name' => $this->name,
                'where' => $this->where,
                'map' => $this->map,
                'bindExpose' => $this->bindExpose,
                'bind' => $this->bind,
                'bindFunction' => $this->bindFunction,
                'attribute' => $this->attribute,
                'modelBind' => $this->modelBind,
                'bindAttribute' => $this->bindAttribute,
                'content' => $this->content,
                'event' => $this->event,
                'directive' => $this->directive,
            ];
        }
        return null;
    }


}
