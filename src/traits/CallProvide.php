<?php

namespace ExAdmin\ui\traits;


trait CallProvide
{
    protected $call = [];
    protected $backtraces = [];
    public function parseCallMethod($reset = false)
    {
        if (count($this->call) == 0 || $reset = true) {
            try {
                $this->backtraces = debug_backtrace(1, 5);
                $this->backtraces = array_slice($this->backtraces, 4);
                $backtrace = $this->backtraces[0];
                $class = new \ReflectionClass($backtrace['class']);
                $this->call = [
                    'class' => str_replace('\\', '-', $backtrace['class']),
                    'function' => $backtrace['function'],
                    'params' => [],
                ];
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
    public function getCall(){
        return $this->call;
    }
    public function getBacktraces(){
        return $this->backtraces;
    }
}
