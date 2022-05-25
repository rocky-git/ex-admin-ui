<?php

namespace ExAdmin\ui\traits;

trait CallProvide
{
    protected $call = [];

    public function parseCallMethod($reset = false)
    {
        if (count($this->call) == 0 || $reset = true) {
            $backtraces = debug_backtrace(1, 6);
            foreach ($backtraces as $key => $backtrace) {
                if ($backtrace['function'] == '__callStatic' && isset($backtraces[$key+1])) {
                    $backtrace = $backtraces[$key+1];
                    break;
                }
            }
            $backtraceClass = $backtrace['class'] ?? '';
            $this->call = [
                'class' => str_replace('\\', '-', $backtraceClass),
                'function' => $backtrace['function'],
                'params' => [],
            ];
            if($backtraceClass && strpos($this->call['function'],'{closure}') === false){
                $class = new \ReflectionClass($backtraceClass);
                $params = $class->getMethod($this->call['function'])->getParameters();
                foreach ($params as $key => $param) {
                    $name = $param->getName();
                    $this->call['params'][$name] = isset($backtrace['args'][$key]) ? $backtrace['args'][$key] : $param->getDefaultValue();
                }
            }
        }
        return $this->call;
    }

    public function getCall()
    {
        return $this->call;
    }

}
