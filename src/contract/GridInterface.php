<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\response\Message;
use Illuminate\Http\Request;

interface GridInterface
{
    /**
     * 删除选中
     * @param array $ids 删除选中id
     * @return mixed
     */
    public function deleteSelect(array $ids): Message;

    /**
     * 删除全部
     * @return Message
     */
    public function deleteAll(): Message;

    /**
     * 拖拽排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @return Message
     */
    public function dragSort(int $id, int $sort): Message;

    /**
     * 输入框排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @return Message
     */
    public function inputSort(int $id, int $sort): Message;
}
