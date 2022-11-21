<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\support\Request;

abstract class ValidatorAbstract
{
    /**
     * 新增验证规则
     * @var array
     */
    protected $createRule = [];
    /**
     * 更新验证规则
     * @var array
     */
    protected $updateRule = [];
    /**
     * tab位置字段
     * @var array
     */
    protected $tabFields = [];
    /**
     * collapse位置字段
     * @var array
     */
    protected $collapseFields = [];
    /**
     * step位置字段
     * @var array
     */
    protected $stepFields = [];
    /**
     * @var Form
     */
    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }
    public function setCollapseField($field)
    {
        $this->setField($field,'collapse','collapseFields');
    }
    public function setTabField($field)
    {
        $this->setField($field,'tabs','tabFields');
    }
    protected function setField($field,$type,$attr){
        if (count($this->form->$type) > 0) {
            $arr = [];
            foreach ($this->form->$type as $model => $key) {
                $arr[$field][] = ['model' => $model, 'key' => $key];
            }
            $this->$attr[] = $arr;
        }
    }
    public function setStepField($field){
        if($this->form->getSteps()){
            $current = $this->form->getSteps()->getStepCount()-1;
            $this->stepFields[$current][] = $current.'-'.$field;
        }
    }
    public function getCollapseFields()
    {
        return $this->collapseFields;
    }
    public function getTabField()
    {
        return $this->tabFields;
    }
    public function passField($field){
        if(Request::has('CURRENT_VALIDATION_STEP')){
            $current = Request::input('CURRENT_VALIDATION_STEP');
            if(!isset($this->stepFields[$current])){
                return false;
            }
            if(!in_array($current.'-'.$field,$this->stepFields[$current])){
                return false;
            }
        }
        return true;
    }
    /**
     * 新增验证规则
     * @param string $field 验证字段
     * @param array|\Closure $rule 规则
     */
    public function createRule(string $field,$rule)
    {
        $this->createRule[$field] = $rule;
    }

    /**
     * 更新验证规则
     * @param string $field 验证字段
     * @param array|\Closure $rule 规则
     */
    public function updateRule(string $field,$rule)
    {
        $this->updateRule[$field] = $rule;
    }

    /**
     * 是否已设置规则
     * @return bool
     */
    public function hasRule(){
        if(count($this->createRule) > 0){
            return true;
        }
        if(count($this->updateRule) > 0){
            return true;
        }
        return false;
    }
    /**
     * 验证
     * @param array $data 表单数据
     * @param bool $edit true更新，false新增
     * @return mixed
     */
    abstract function check(array $data, bool $edit);
}
