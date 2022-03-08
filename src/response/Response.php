<?php

namespace ExAdmin\ui\response;
/**
 * @method static success(array $data =[])
 */
class Response implements \JsonSerializable
{
    protected $message = '';
    protected $code = 200;
    protected $data = [];

    public static function __callStatic($name, $arguments)
    {
        $self = new self();
        return $self->json(...$arguments);
    }

    public function json(array $data = [], $message = '', $code = 200)
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
