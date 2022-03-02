<?php

namespace ExAdmin\ui;

use ExAdmin\ui\contract\GridInterface;
use ExAdmin\ui\exception\HttpException;
use ExAdmin\ui\support\Str;

/**
 * @method static dispatch($class, $function, $vars = [])
 */
class Route
{
    protected $contract = [
        'grid' => GridInterface::class,
    ];
    public static function __callStatic($name, $arguments)
    {
        $self = new self;
        return $self->invokeArgs(...$arguments);
    }
    public function invokeArgs($class, $function, $vars = [])
    {

        if (array_key_exists($class, $this->contract) && $_SERVER['REQUEST_METHOD'] !='OPTIONS') {
            $classInterface = ui_config('config.request_interface.' . $class);
            if (empty($classInterface)) {
                throw new \Exception('请正确配置: request_interface.' . $class);
            }
            $reflect = new \ReflectionClass($classInterface);
            if (in_array($this->contract[$class], $reflect->getInterfaceNames())) {
                $object = $reflect->newInstanceArgs();
                $method = $reflect->getMethod($function);
                $args = $this->bindParams($method, $vars);
                return $method->invokeArgs($object, $args);
            } else {
                throw new \Exception('必须实现接口: ' . $this->contract[$class]);
            }
        }
    }

    /**
     * 绑定参数
     * @access protected
     * @param ReflectionFunctionAbstract $reflect 反射类
     * @param array $vars 参数
     * @return array
     */
    protected function bindParams(\ReflectionFunctionAbstract $reflect, array $vars = []): array
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

}