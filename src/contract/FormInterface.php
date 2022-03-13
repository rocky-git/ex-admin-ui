<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\response\Message;

interface FormInterface 
{
    /**
     * 设置数据源
     * @param mixed $data
     */
    public function __construct($data);
    /**
     * 新增保存
     * @param array $data
     * @return Message
     */
    public function save(array $data): Message;

    /**
     * 更新
     * @param array $data
     * @param $id
     * @return Message
     */
    public function update(array $data, $id): Message;
    /**
     * 返回唯一标识字段，一般数据库主键自增字段
     * @return string
     */
    public function getPk():string;

    /**
     * 获取数据
     * @param string $field 字段
     * @return mixed
     */
    public function getData(string $field = null);

    /**
     * 编辑数据
     * @param mixed $id 
     * @return mixed
     */
    public function edit($id);
}
