<?php

namespace ExAdmin\ui\contract;

abstract class ValidatorForm
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
     * 新增验证规则
     * @param string $field 验证字段
     * @param array $rule 规则
     */
    public function createRule(string $field,array $rule)
    {
        $this->createRule[$field] = $rule;
    }
    /**
     * 更新验证规则
     * @param string $field 验证字段
     * @param array $rule 规则
     */
    public function updateRule(string $field,array $rule)
    {
        $this->updateRule[$field] = $rule;
    }

    /**
     * 验证
     * @param array $data 表单数据
     * @param bool $edit true更新，false新增
     * @return mixed
     */
    abstract function check(array $data,bool $edit);
}
