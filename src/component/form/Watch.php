<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-17
 * Time: 22:18
 */

namespace ExAdmin\ui\component\form;
use ArrayAccess;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Request;

class Watch implements ArrayAccess
{
    protected $data = [];
    protected $hideField = [];
    protected $showField = [];
    protected $init = false;
    public function __construct($data,$init = false)
    {
        $this->init = $init;
        $this->data = $data;
    }

    /**
     * 显示
     * @param string|array $field 字段
     */
    public function hide($field)
    {
        if (is_array($field)) {
            foreach ($field as $value) {
                $this->hideField[] = $this->getIfField($value);
            }
        } else {
            $this->hideField[] = $this->getIfField($field);
        }
    }

    /**
     * 隐藏
     * @param string|array $field 字段
     */
    public function show($field)
    {
        if (is_array($field)) {
            foreach ($field as $value) {
                $this->showField[] = $this->getIfField($value);
            }
        } else {
            $this->showField[] = $this->getIfField($field);
        }
    }

    protected function getIfField($field)
    {
        $field = str_replace('.', '_', $field);
        $field = Request::input('formField') .'_'. $field . 'Show';
        return $field;
    }
    public function setData($data){
        return $this->data = $data;
    }
    /**
     * 获取字段值
     * @param string $field 字段
     * @return array|mixed
     */
    public function get($field = '')
    {

        if (empty($field)) {

            return $this->data;
        } else {
            return Arr::get($this->data,$field);
        }
    }

    public function getShowField()
    {
        return $this->showField;
    }

    public function getHideField()
    {
        return $this->hideField;
    }

    /**
     * 设置值
     * @param string $field 字段
     * @param mixed $value 值
     */
    public function set($field, $value)
    {
        if(!$this->init || ($this->init && empty($this->get($field) && !is_array($this->get($field))))){
            Arr::set($this->data,$field,$value);
        }
    }



    // ArrayAccess
    public function offsetSet($name, $value): void
    {
        $this->set($name, $value);
    }

    public function offsetExists($name): bool
    {
        return $this->__isset($name);
    }

    public function offsetUnset($name): void
    {
        $this->__unset($name);
    }

    public function offsetGet($name): mixed
    {
        return $this->get($name);
    }

    /**
     * 销毁数据对象的值
     * @access public
     * @param string $name 名称
     * @return void
     */
    public function __unset(string $name): void
    {
        unset($this->data[$name]);
    }

    /**
     * 检测数据对象的值
     * @access public
     * @param string $name 名称
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return !is_null($this->get($name));
    }
}
