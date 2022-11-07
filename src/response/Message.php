<?php

namespace ExAdmin\ui\response;


use ExAdmin\ui\support\Container;


abstract class Message implements \JsonSerializable
{
    protected $response = [
        'code' => 200,
    ];

    protected $data = [];

    public function __construct($config = [])
    {
        $this->data = $config;

    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize());
    }

    public function jsonSerialize()
    {
        $this->response['data'] = $this->data;
        return $this->response;
    }
}
