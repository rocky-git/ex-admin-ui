<?php

namespace ExAdmin\ui\component\form\driver;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\step\StepResult;
use ExAdmin\ui\contract\FormAbstract;
use ExAdmin\ui\response\Message;
use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Arr;

class File extends FormAbstract
{
    protected $saving;

    protected $saved;
    
    public function initialize(Form $form, $repository)
    {
        parent::initialize($form, $repository); // TODO: Change the autogenerated stub
        $this->data = include $repository;

    }

    

    /**
     * 数据保存
     * @param array $data
     * @param mixed $id
     * @return Message|Response
     */
    public function save(array $data, $id = null)
    {
        //验证数据
        $result = $this->form->validator()->check($data, !is_null($id));
        if ($result instanceof Response) {
            return $result;
        }
        $data = array_merge($this->data,$data);
        $content = var_export($data, true);
        $content = <<<PHP
<?php
return $content;
PHP;
        $result = $this->dispatchEvent('saving',[$this->form]);
        if ($result instanceof Message) {
            return $result;
        }
        $result = file_put_contents($this->repository,$content);

        $savedResult = $this->dispatchEvent('saved',[$this->form]);
        if ($savedResult instanceof Message) {
            return $savedResult;
        }
        if($this->form->isStepfinish()){
            $result = call_user_func($this->form->getSteps()->getFinish(),new StepResult($this->form,$id));
            return Response::success($result,'',202);
        }
        if($result){
            $result = message_success(admin_trans('form.save_success'));
        }else{
            $result = message_success(admin_trans('form.save_fail'));
        }
        return $result;
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
     * 编辑数据
     * @param mixed $id
     * @return mixed
     */
    public function edit($id)
    {
        // TODO: Implement edit() method.
    }



}
