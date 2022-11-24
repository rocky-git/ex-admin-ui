<?php

namespace ExAdmin\ui\response;
/**
 * @method static $this success($data =[], $message = '', $code = 200)
 */
class Response extends Message
{

    public static function __callStatic($name, $arguments)
    {
        $self = new self();
        return $self->send(...$arguments);
    }

    public function send($data = [], $message = '', $code = 200)
    {
        $this->response['code'] = $code;
        $this->response['message'] = $message;
        $this->data = $data;
        return $this;
    }

}
