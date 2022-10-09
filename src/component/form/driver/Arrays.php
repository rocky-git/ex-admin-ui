<?php

namespace ExAdmin\ui\component\form\driver;

use ExAdmin\ui\component\form\Form;

use ExAdmin\ui\component\form\step\StepResult;
use ExAdmin\ui\contract\FormAbstract;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Arr;


class Arrays extends FormAbstract
{

    protected $saving;

    protected $saved;


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
    public function save(array $data, $id = null)
    {
        //验证数据
        $result = $this->form->validator()->check($data, !is_null($id));
        if ($result instanceof Response) {
            return $result;
        }
        $this->form->input($data);
        $result = $this->dispatchEvent('saving',[$this->form]);
        if ($result instanceof Message) {
            return $result;
        }
        $savedResult = $this->dispatchEvent('saved',[$this->form]);
        if ($savedResult instanceof Message) {
            return $savedResult;
        }
        if($this->form->isStepfinish()){
            $result = call_user_func($this->form->getSteps()->getFinish(),new StepResult($this->form,$data, $result, $id));
            return Response::success($result,'',202);
        }
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
        return Arr::get($this->repository, $field);
    }



}
