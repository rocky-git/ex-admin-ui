<?php

namespace ExAdmin\ui\test;

use ExAdmin\ui\contract\FormInterface;
use ExAdmin\ui\response\Message;


class Form implements FormInterface
{

    public function save(array $data): Message
    {
        return message_success('成功');
    }

    public function update(array $data, $id): Message
    {
        return message_success('成功');
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getPk(): string
    {
       return 'id';
    }

    public function getData(string $field = null)
    {
        return $this->data;
    }
}
