<?php

namespace ExAdmin\ui;


use ExAdmin\ui\contract\LoginAbstract;
use ExAdmin\ui\contract\SystemAbstract;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Request;
use ExAdmin\ui\support\Str;


/**
 * @method static dispatch($class, $function)
 */
class Route
{
    public static $objectParamAfter = null;

    protected $contract = [
        'system' => SystemAbstract::class,
        'login' => LoginAbstract::class,
    ];

    public static function __callStatic($name, $arguments)
    {

        return Container::getInstance()->make(self::class)->invokeArgs(...$arguments);
    }

    public function invokeArgs($class, $function)
    {
        $vars = Request::input();

        if (Request::getMethod() != 'OPTIONS') {

            $class = str_replace('-', '\\', $class);
            if (array_key_exists($class, $this->contract)) {

                $classInterface = admin_config('admin.request_interface.' . $class);
                if (empty($classInterface)) {
                    throw new \Exception('请正确配置: request_interface.' . $class);
                }
                $reflect = new \ReflectionClass($classInterface);

                if (in_array($this->contract[$class], $reflect->getInterfaceNames()) || $this->isAbstract($reflect)) {
                    return $this->invokeMethod($classInterface, $function, $vars);
                } else {
                    throw new \Exception('必须实现接口: ' . $this->contract[$class]);
                }
            } elseif (class_exists($class)) {
                return $this->invokeMethod($class, $function, $vars);
            }
        }
    }

    protected function isAbstract($reflect)
    {
        $instance = $reflect->newInstance();
        foreach ($this->contract as $contract) {
            if ($instance instanceof $contract) {
                return true;
            }
        }
        return false;

    }

    /**
     * 绑定参数
     * @access protected
     * @param ReflectionFunctionAbstract $reflect 反射类
     * @param array $vars 参数
     * @return array
     */
    public function bindParams(\ReflectionFunctionAbstract $reflect, array $vars = []): array
    {
        if ($reflect->getNumberOfParameters() == 0) {
            return [];
        }
        // 判断数组类型 数字数组时按顺序绑定参数
        reset($vars);
        $type = key($vars) === 0 ? 1 : 0;
        $params = $reflect->getParameters();
        $args = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $lowerName = Str::snake($name);
            $reflectionType = $param->getType();

            if ($reflectionType && $reflectionType->isBuiltin() === false) {
                $args[] = $this->getObjectParam($reflectionType->getName(), $vars);
            } elseif (1 == $type && !empty($vars)) {
                $args[] = array_shift($vars);
            } elseif (0 == $type && array_key_exists($name, $vars)) {
                $args[] = $vars[$name];
            } elseif (0 == $type && array_key_exists($lowerName, $vars)) {
                $args[] = $vars[$lowerName];
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                throw new \InvalidArgumentException('method param miss:' . $name);
            }
        }
        return $args;
    }

    /**
     * 设置对象参数闭包
     * @param \Closure $closure
     * @return void
     */
    public static function setObjectParamAfter(\Closure $closure)
    {
        self::$objectParamAfter = $closure;
    }

    /**
     * 获取对象类型的参数值
     * @access protected
     * @param string $className 类名
     * @param array $vars 参数
     * @return mixed
     */
    protected function getObjectParam(string $className, array &$vars)
    {
        $array = $vars;
        $value = array_shift($array);
        $result = null;
        if (self::$objectParamAfter) {
            $result = call_user_func(self::$objectParamAfter, $className);
        }
        if (!$result) {
            if ($value instanceof $className) {
                $result = $value;
                array_shift($vars);
            } else {
                $result = $this->make($className);
            }
        }
        return $result;
    }

    /**
     * 创建类的实例 已经存在则直接获取
     * @access public
     * @param string $abstract 类名或者标识
     * @param array $vars 变量
     * @return mixed
     */
    public function make(string $abstract, array $vars = [])
    {
        $object = $this->invokeClass($abstract, $vars);

        return $object;
    }

    /**
     * 调用反射执行类的实例化 支持依赖注入
     * @access public
     * @param string $class 类名
     * @param array $vars 参数
     * @return mixed
     */
    public function invokeClass(string $class, array $vars = [])
    {
        try {
            $reflect = new \ReflectionClass($class);
        } catch (ReflectionException $e) {
            throw new ClassNotFoundException('class not exists: ' . $class, $class, $e);
        }

        $constructor = $reflect->getConstructor();

        $args = $constructor ? $this->bindParams($constructor, $vars) : [];

        $object = $reflect->newInstanceArgs($args);

        return $object;
    }
    public function invokeMethod($class, $function, $vars = [])
    {
        $class = is_object($class) ? $class : $this->invokeClass($class);
        $reflect = new \ReflectionMethod($class, $function);
        $args = $this->bindParams($reflect, $vars);
        return $reflect->invokeArgs($class , $args);
    }
}
