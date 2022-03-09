<?php

namespace ExAdmin\ui\test;

use ExAdmin\ui\contract\GridInterface;
use ExAdmin\ui\response\Message;
use Illuminate\Support\Facades\Log;


class Grid implements GridInterface
{
    protected $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function deleteSelect(array $ids): Message
    {
        return message_success('成功');
    }

    public function deleteAll(): Message
    {
        return message_success('成功');
    }

    public function dragSort($id, int $sort): Message
    {
        return message_success('成功');
    }

    public function inputSort($id, int $sort): Message
    {
        return message_success('成功');
    }


    public function data(int $page, int $size): array
    {
        return $this->data;
    }

    public function total(): int
    {
        return 50;
    }

    public function quickSearch(string $keyword)
    {
        // TODO: Implement quickSearch() method.
    }

    public function delete($id): Message
    {
        return message_success('成功');
    }

    public function getPk(): string
    {
        return 'a';
    }

    public function tableSort($field, $sort)
    {
        // TODO: Implement tableSort() method.
    }

    public function export(array $selectIds,array $columns,bool $all):Message
    {
        return message_success('成功');
    }

    public function filter(array $rules)
    {

    }


}
