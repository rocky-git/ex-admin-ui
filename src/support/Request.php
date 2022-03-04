<?php

namespace ExAdmin\ui\support;
/**
 * @method static input($name, $default = null)
 * @method static has($name)
 */
class Request
{
    protected function getInputData(): array
    {
        $var = $_REQUEST;
        array_shift($var);
        $content = file_get_contents('php://input');
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $data = [];
        if ('application/x-www-form-urlencoded' == $contentType) {
            parse_str($content, $data);
        } elseif (false !== strpos($contentType, 'json')) {
            $data = (array)json_decode($content, true);
        }
        return array_merge($var, $data);
    }

    public static function __callStatic($name, $arguments)
    {
        $self = Container::getInstance()->make(self::class);
        if ($name == 'input') {
            return $self->param(...$arguments);
        } elseif ($name == 'has') {
            return is_null($self->param(...$arguments)) ? false : true;
        }
    }

    protected function param($name, $default = null)
    {
        return Arr::get($this->getInputData(), $name, $default);
    }
}
