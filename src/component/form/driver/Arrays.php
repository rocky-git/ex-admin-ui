<?php

namespace ExAdmin\ui\component\form\driver;

use ExAdmin\ui\component\form\Form;

use ExAdmin\ui\contract\FormAbstract;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Arrays extends FormAbstract
{
    protected $data = [];
   

    /**
     * 上传文件 file|image组件上传接口
     * @return Response
     */
    public function upload():Response
    {
        // TODO: Implement upload() method.
    }


    /**
     * 编辑数据
     * @param mixed $id
     * @return mixed|void
     */
    public function edit($id)
    {

    }

    /**
     * 数据保存
     * @param array $data
     * @param mixed $id
     * @return Message
     */
    public function save(array $data, $id = null): Message
    {
        return message_success(admin_trans('form.save_success'));
    }



    /**
     * 返回唯一标识字段，一般数据库主键自增字段
     * @return string
     */
    public function getPk(): string
    {
        return 'id';
    }

    /**
     * 获取数据
     * @param string $field 字段
     * @return mixed
     */
    public function get(string $field = null)
    {
        return Arr::get($this->data, $field);
    }

    /**
     * 保存前
     * @param \Closure $closure
     * @return mixed
     */
    public function saving(\Closure $closure)
    {
        // TODO: Implement saving() method.
    }

    /**
     * 保存后
     * @param \Closure $closure
     * @return mixed
     */
    public function saved(\Closure $closure)
    {
        // TODO: Implement saved() method.
    }
    /**
     * selectTable组件
     * @return Response
     */
    public function selectTable(): Response
    {
        return Response::success();
    }
}
