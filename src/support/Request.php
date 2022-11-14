<?php

namespace ExAdmin\ui\support;


/**
 * @method static input($name = null, $default = null)
 * @method static has($name)
 * @method static file($name)
 * @method static header($name)
 * @method static getMethod() 获取请求方式
 * @see \Symfony\Component\HttpFoundation\Request
 */
class Request
{
    protected $request;
    protected static $init = null;
    public function __construct()
    {
        $this->request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        if(self::$init){
            call_user_func(self::$init,$this->request);
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest(){
        return $this->request;
    }
    /**
     * 初始化
     * @param \Closure $closure
     */
    public static function init($closure)
    {
        self::$init = $closure;
    }
    protected function getInputData(): array
    {
        $contentType = $this->request->getContentType() ?? '';
        if (false !== strpos($contentType, 'json')) {
            $content = file_get_contents('php://input');
            $data = (array)json_decode($content, true);
            $this->request->request->add($data);
        }
        return array_merge($this->request->query->all(), $this->request->request->all());
    }
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->request,$name],$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        $self = new static();
        if ($name == 'input') {
            return $self->param(...$arguments);
        } elseif ($name == 'has') {
            return is_null($self->param(...$arguments)) ? false : true;
        } elseif ($name == 'file') {
            return $self->request->files->get(...$arguments);
        } elseif ($name == 'header') {
            return $self->request->headers->get(...$arguments);
        }else{
            return call_user_func_array([$self->request,$name],$arguments);
        }
    }

    protected function param($name = null, $default = null)
    {
        return Arr::get($this->getInputData(), $name, $default);
    }
}
