<?php

namespace ExAdmin\ui\component\form\step;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Request;

class StepResult
{
    protected $form;
    protected $data;
    protected $result;
    protected $id = null;
    protected $isSuccess = false;
    public function __construct(Form $form,$data,$isSuccess,$id)
    {
        $this->form = $form;
        $this->data = $data;
        $this->id = $id;
        $this->isSuccess = $isSuccess;
    }
    /**
     * 返回成功
     * @param string $title 标题
     * @param string  $content 内容
     * @return \ExAdmin\ui\component\feedback\Result
     */
    public function success($title=null, $content='')
    {
        return $this->result($title ?? admin_trans('form.operation_complete'), $content, 'success');
    }
    /**
     * 重新提交按钮
     * @param string $text
     * @return Button
     */
    public function resetButton($text = null)
    {
        return Button::create($text ?? admin_trans('form.resubmit'))
            ->eventFunction('click', 'stepReset', [], Request::input('FORM_REF'));
    }
    /**
     * 返回错误
     * @param string $title
     * @param string $content
     * @return \ExAdmin\ui\component\feedback\Result
     */
    public function error($title, $content){
        return $this->result($title, $content, 'error');
    }

    /**
     * 返回警告
     * @param string $title
     * @param string $content
     * @return \ExAdmin\ui\component\feedback\Result
     */
    public function warning($title, $content){
        return $this->result($title, $content, 'warning');
    }

    /**
     * 返回信息
     * @param string $title
     * @param string $content
     * @return \ExAdmin\ui\component\feedback\Result
     */
    public function info($title, $content){
        return $this->result($title, $content, 'info');
    }
    /**
     * @param string $title
     * @param string $content
     * @param string $status
     * @return \ExAdmin\ui\component\feedback\Result
     */
    public function result($title, $content, $status)
    {
        return \ExAdmin\ui\component\feedback\Result::create()->status($status)
            ->content($title, 'title')
            ->content($content, 'subTitle')
            ->content($this->resetButton(),'extra');
    }
    /**
     * 获取提交数据
     * @param string $field 字段
     * @return mixed
     */
    public function input($field=null)
    {
        return $this->form->input($field);
    }
    /**
     * 获取保存成功id
     * @return null
     */
    public function getId(){
        return $this->id;
    }
}
