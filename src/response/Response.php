<?php

namespace ExAdmin\ui\response;
/**
 * @method static success($data =[], $message = '', $code = 200)
 */
class Response implements \JsonSerializable
{
    protected $message = '';
    protected $code = 200;
    protected $data = [];

    public static function __callStatic($name, $arguments)
    {
        $self = new self();
        return $self->send(...$arguments);
    }

    public function send($data = [], $message = '', $code = 200)
    {
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
        return $this;
    }

    public function jsonSerialize()
    {
        return ['code' => $this->code, 'data' => $this->data, 'message' => $this->message];
    }
}
