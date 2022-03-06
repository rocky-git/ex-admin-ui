<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Request;

/**
 * @method FormComponent eq(\Closure $closure= null) 等于
 * @method FormComponent neq(\Closure $closure= null) 不等于
 * @method FormComponent egt(\Closure $closure= null) 大于等于
 * @method FormComponent elt(\Closure $closure= null) 小于等于
 * @method FormComponent gt(\Closure $closure= null) 大于
 * @method FormComponent lt(\Closure $closure= null) 小于
 * @method FormComponent between(\Closure $closure= null) 区间
 * @method FormComponent notBetween(\Closure $closure= null) NOT区间查询
 * @method FormComponent like(\Closure $closure= null) 模糊
 * @method FormComponent json(\Closure $closure= null) json查询
 * @method FormComponent jsonLike(\Closure $closure= null) json模糊查询
 * @method FormComponent jsonArrLike(\Closure $closure= null) json数组模糊查询
 * @method FormComponent in(\Closure $closure= null) in查询
 * @method FormComponent notIn(\Closure $closure= null) not in查询
 * @method FormComponent findIn(\Closure $closure= null) findIn查询
 */
class Filter
{
    use FormComponent;
    protected $form;

    protected $item;

    protected $filterType = [
        'eq',
        'neq',
        'egt',
        'elt',
        'gt',
        'lt',
        'between',
        'notBetween',
        'like',
        'json',
        'jsonLike',
        'jsonArrLike',
        'in',
        'notIn',
        'findIn',
    ];
    protected $rules = [];

    protected $rule;

    public function __construct()
    {
        $this->form = Form::create([]);
        $this->form
            ->removeAttr('labelCol')
            ->layout('inline')
            ->removeAttr('url');
        $this->form->actions()
            ->submitButton()
            ->icon(' <search-outlined />')
            ->content('搜索');
       
    }
    public function __call($name, $arguments)
    {
        return $this->setRule($name,$arguments);
    }
    public function setRule($name, $arguments,$form=null){
        if (in_array($name, $this->filterType)) {
            $this->rule = $name;
            if(isset($arguments[0]) && $arguments[0] instanceof \Closure){
                call_user_func($arguments[0],$this);
            }
        }elseif (isset($this->formComponent[$name])){
            if(is_null($form)){
                $form = $this->form;
            }
            $formComponent = call_user_func_array([$form,$name],$arguments);
            list($fields) = Arr::formItem($formComponent,$arguments);
            $params = [];
            foreach ($fields as $field){
                $params[$field] = Request::input($field);
            }
            $this->rules[] = [
                'type'=>$this->rule,
                'field'=>$params,
            ];
            return $formComponent;
        }
        return $this;
    }
    public function getRule(){
        return $this->rules;
    }

    /**
     * @return Form
     */
    public function form()
    {
        return $this->form;
    }

}
