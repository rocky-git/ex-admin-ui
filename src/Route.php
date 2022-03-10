<?php

namespace ExAdmin\ui;

use ExAdmin\ui\auth\Node;
use ExAdmin\ui\contract\CommonInterface;
use ExAdmin\ui\contract\FormInterface;
use ExAdmin\ui\contract\GridInterface;
use ExAdmin\ui\contract\LoginInterface;
use ExAdmin\ui\contract\SystemAbstract;
use ExAdmin\ui\exception\HttpException;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Request;
use ExAdmin\ui\support\Str;

/**
 * @method static dispatch($class, $function, $vars = [])
 */
class Route
{
    protected $contract = [
        'system' => SystemAbstract::class,
        'login' => LoginInterface::class,
        'grid' => GridInterface::class,
        'form' => FormInterface::class,
    ];

    public static function __callStatic($name, $arguments)
    {
        $node = new Node;
        dd($node->all());
        return Container::getInstance()->make(self::class)->invokeArgs(...$arguments);
    }

    public function invokeArgs($class, $function)
    {
        $vars = Request::input();
        if ($_SERVER['REQUEST_METHOD'] != 'OPTIONS') {

            $class = str_replace('-', '\\', $class);
            if (array_key_exists($class, $this->contract)) {

                $classInterface = ui_config('config.request_interface.' . $class);
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
    protected function isAbstract($reflect){
        $instance = $reflect->newInstance();
        foreach ($this->contract as $contract){
            if($instance instanceof $contract){
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
    public static function bindParams(\ReflectionFunctionAbstract $reflect, array $vars = []): array
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


    public function invokeMethod($class, $function, $vars = [])
    {
        $reflect = new \ReflectionClass($class);
        if (is_object($class)) {
            $object = $class;
        } else {
            $object = $reflect->newInstanceArgs();
        }
        $method = $reflect->getMethod($function);
        $args = $this->bindParams($method, $vars);
        return $method->invokeArgs($object, $args);
    }

}
