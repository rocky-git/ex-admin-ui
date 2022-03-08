<?php

namespace ExAdmin\ui\traits;

trait CallProvide
{
    protected $call = [];

    public function parseCallMethod($reset = false)
    {
        if (count($this->call) == 0 || $reset = true) {
            $backtraces = debug_backtrace(1, 4);
            $backtraces = array_slice($backtraces, 3);
            $backtrace = $backtraces[0];
            $class = new \ReflectionClass($backtrace['class']);
            $this->call = [
                'class' => str_replace('\\', '-', $backtrace['class']),
                'function' => $backtrace['function'],
                'params' => [],
            ];
            try {
                $params = $class->getMethod($this->call['function'])->getParameters();
                foreach ($params as $key => $param) {
                    $name = $param->getName();
                    $this->call['params'][$name] = isset($backtrace['args'][$key]) ? $backtrace['args'][$key] : $param->getDefaultValue();
                }
            } catch (\Exception $exception) {

            }
        }
        return $this->call;
    }

    protected function getDispatch()
    {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $path = trim($path, '/');
        $paths = explode('/', $path);
        array_shift($paths);
        list($class, $function) = $paths;
        return [
            'class' => $class,
            'function' => $function
        ];
    }
}
