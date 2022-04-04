<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;

interface FormInterface
{
    /**
     * 设置数据源
     * @param mixed $data
     * @param Form $form
     */
    public function __construct($data, Form $form);

    
    /**
     * 上传文件 file|image组件上传接口
     * @return Response
     */
    public function upload():Response;

    /**
     * 数据保存
     * @param array $data
     * @param mixed $id
     * @return Message|Response
     */
    public function save(array $data, $id = null);


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
