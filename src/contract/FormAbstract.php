<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\Watch;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Request;

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
    public function initialize(Form $form, $repository)
    {

        $this->form = $form;

        $this->repository = $repository;
    }

    /**
     * 远程options
     * @param string $search 搜索值
     * @param array $data 表单数据
     */
    public function remoteOptions($search,$data)
    {
        $result = $this->form->getCallbackComponent()->handle($search,$data);
        return Response::success($result);
    }

    /**
     * select change options
     * @param string $value 改变值
     * @param string $optionsField bind绑定字段
     * @param array $data 表单数据
     * @return Response
     */
    public function changeLoadOptions($value, $optionsField,$data): Response
    {
        $result = $this->form->getCallbackComponent()->handle($value,$data);
        return Response::success([
            $optionsField => $result
        ]);
    }

    /**
     * selectTable组件
     * @param array $data 表单数据
     * @return Response
     */
    public function selectTable($data): Response
    {
        $result = $this->form->getCallbackComponent()->handle(Request::input('ex_eadmin_select_id', []),$data);
        return Response::success($result);
    }

    /**
     * 上传文件 file|image组件上传接口
     * @return Response
     */
    public function upload(): Response
    {
        $class = admin_config('admin.form.uploader');
        $simpleUploader = new $class;
        $simpleUploader->setForm($this->form);
        return $simpleUploader->upload();
    }

    /**
     * watch监听
     * @param array $data 表单数据
     * @param string $ex_field 监听字段
     * @param string $newValue 新值
     * @param string  $oldValue 旧值
     * @param int $index 数组中的index
     * @return mixed
     */
    public function watch(array $data, $ex_field, $newValue = '', $oldValue = '',$index = null)
    {
        $watch = new Watch($data);
        $closure = $this->form->getWatch()[$ex_field];
        call_user_func_array($closure, [$newValue, $watch, $oldValue,$index]);
        unset($watch[$ex_field]);
        return Response::success([
            'data' => $watch->get(),
        ]);
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
    public function saving(\Closure $closure)
    {
        $this->event[__FUNCTION__] = $closure;
    }

    /**
     * 保存后
     * @param \Closure $closure
     * @return mixed
     */
    public function saved(\Closure $closure)
    {
        $this->event[__FUNCTION__] = $closure;
    }

    /**
     * 触发事件
     * @param $name 事件名称
     * @param $eventArgs 事件参数
     */
    public function dispatchEvent($name, $eventArgs)
    {
        if (isset($this->event[$name])) {
            return call_user_func_array($this->event[$name], $eventArgs);
        }
    }
}
