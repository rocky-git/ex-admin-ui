<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\response\Message;

interface FormInterface
{
    /**
     * 设置数据源
     * @param mixed $data
     * @param Form $form
     */
    public function __construct($data, Form $form);

    /**
     * 数据保存
     * @param array $data
     * @param mixed $id
     * @return Message
     */
    public function save(array $data, $id = null): Message;

    
    /**
     * 返回唯一标识字段，一般数据库主键自增字段
     * @return string
     */
    public function getPk(): string;

    /**
     * 获取数据
     * @param string $field 字段
     * @return mixed
     */
    public function get(string $field = null);

    /**
     * 编辑数据
     * @param mixed $id
     * @return mixed
     */
    public function edit($id);
    /**
     * 保存前
     * @param \Closure $closure
     * @return mixed
     */
    public function saving(\Closure  $closure);
    /**
     * 保存后
     * @param \Closure $closure
     * @return mixed
     */
    public function saved(\Closure  $closure);
}
