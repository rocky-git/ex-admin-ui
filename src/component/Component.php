<?php

namespace ExAdmin\ui\component;

use Eadmin\Admin;
use Eadmin\component\basic\Button;
use Eadmin\component\basic\Dialog;
use Eadmin\component\basic\Drawer;
use Eadmin\component\layout\Column;
use Eadmin\component\layout\Content;
use Eadmin\detail\Detail;
use Eadmin\form\Form;
use Eadmin\grid\Grid;
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
    use Where, ForMap, Event;

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
    //自定义指令
    protected $directive = [];
    //双向绑定
    protected $modelBind = [];
    //初始化
    protected static $init = [];

    // 插槽
    protected $slot = [];

    public function __construct()
    {
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
     * 跳转路径
     * @param string $url
     * @param array $params
     * @return $this
     */
    public function redirect($url, array $params = [])
    {
        $url = $url . '?' . http_build_query($params);
        $style = $this->attr('style') ?? [];
        $style = array_merge($style, ['cursor' => 'pointer']);
        $this->attr('style', $style);
        return $this->directive('redirect', $url);
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
     * @return $this
     */
    public function vModel($name = 'value', $field = null,$value='', $model = true)
    {
        if (empty($field)) {
            $field = $this->random();
        }
        $this->bind($field, $value);
        $this->bindAttr($name, $field, $model);
        return $this;
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
                'bind' => $this->bind,
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
