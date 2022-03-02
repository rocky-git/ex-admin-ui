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
    public function deleteSelect(array $ids) : Message;

    /**
     * 删除全部
     * @return Message
     */
    public function deleteAll() : Message;
}
