<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;

abstract class FormAbstract
{
    /**
     * @var Form
     */
    protected $form;

    protected $repository;

    protected $data = [];
    
    protected $event = [];
    /**
     * 初始化
     * @param Form $form
     * @param $repository
     */
    public function initialize(Form $form,$repository){

        $this->form = $form;

        $this->repository = $repository;
    }

    /**
     * selectTable组件
     * @return Response
     */
    public function selectTable(): Response
    {
        $result = $this->form->getSelectTableComponent()->handle();
        return Response::success($result);
    }

    /**
     * 上传文件 file|image组件上传接口
     * @return Response
     */
    public function upload(): Response{
        $class = admin_config('admin.form.uploader');
        $simpleUploader = new $class;
        $simpleUploader->setForm($this->form);
        return $simpleUploader->upload();
    }

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
    public function saving(\Closure $closure){
        $this->event[__FUNCTION__] = $closure;
    }

    /**
     * 保存后
     * @param \Closure $closure
     * @return mixed
     */
    public function saved(\Closure $closure){
        $this->event[__FUNCTION__] = $closure;
    }
    /**
     * 触发事件
     * @param $name 事件名称
     * @param $eventArgs 事件参数
     */
    public function dispatchEvent($name,$eventArgs)
    {
        if (isset($this->event[$name])) {
            call_user_func_array($this->event[$name],$eventArgs);
        }
    }
}
