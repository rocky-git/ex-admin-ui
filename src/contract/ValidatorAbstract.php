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

    public function setTabField($field)
    {
        if (count($this->form->tabs) > 0) {
            $tabs = [];
            foreach ($this->form->tabs as $model => $key) {
                $tabs[$field][] = ['model' => $model, 'key' => $key];
            }
            $this->tabFields[] = $tabs;
        }

    }
    public function setStepField($field){
        if($this->form->getSteps()){
            $current = $this->form->getSteps()->getStepCount()-1;
            $this->stepFields[$current][] = $current.'-'.$field;
        }
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
     * @param array $rule 规则
     */
    public function createRule(string $field, array $rule)
    {
        $this->createRule[$field] = $rule;
    }

    /**
     * 更新验证规则
     * @param string $field 验证字段
     * @param array $rule 规则
     */
    public function updateRule(string $field, array $rule)
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
