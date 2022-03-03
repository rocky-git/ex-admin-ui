<?php

namespace ExAdmin\ui\traits;

trait CallProvide
{
    protected $call = [];

    public function parseCallMethod($reset = false)
    {
        if (empty($this->call) || $reset = true) {
            $backtraces = debug_backtrace(1, 4);

            $backtraces = array_slice($backtraces, 3);
            $backtrace = $backtraces[0];

            $class = new \ReflectionClass($backtrace['class']);
            $this->call = [
                'class' => urlencode(base64_encode($backtrace['class'])),
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
}
