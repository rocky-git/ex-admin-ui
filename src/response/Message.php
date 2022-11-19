<?php

namespace ExAdmin\ui\response;


use ExAdmin\ui\support\Container;


abstract class Message implements \JsonSerializable
{
    protected $response = [
        'code' => 200,
        'bind' => [],
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

    /**
     * @param array $bind
     * @return $this
     */
    public function binds(array $bind)
    {
        $this->response['bind'] = $bind;
        return $this;
    }

    /**
     * 绑定
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    public function bind($field, $value)
    {
        $this->response['bind'][$field] = $value;
        return $this;
    }

    public function jsonSerialize()
    {
        $this->response['data'] = $this->data;
        return $this->response;
    }
}
