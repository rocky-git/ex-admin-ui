<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;

abstract class FormAbstract
{
    /**
     * 设置数据源
     * @param mixed $data
     * @param Form $form
     */
    abstract public function __construct($data, Form $form);

    /**
     * selectTable组件
     * @return Response
     */
    abstract public function selectTable(): Response;

    /**
     * 上传文件 file|image组件上传接口
     * @return Response
     */
    abstract public function upload(): Response;

    /**
     * 数据保存
     * @param array $data
     * @param mixed $id
     * @return Message|Response
     */
    abstract public function save(array $data, $id = null);


    /**
     * 返回唯一标识字段，一般数据库主键自增字段
     * @return string
     */
    abstract public function getPk(): string;

    /**
     * 获取数据
     * @param string $field 字段
     * @return mixed
     */
    abstract public function get(string $field = null);

    /**
     * 编辑数据
     * @param mixed $id
     * @return mixed
     */
    abstract public function edit($id);

    /**
     * 保存前
     * @param \Closure $closure
     * @return mixed
     */
    abstract public function saving(\Closure $closure);

    /**
     * 保存后
     * @param \Closure $closure
     * @return mixed
     */
    abstract public function saved(\Closure $closure);
}
