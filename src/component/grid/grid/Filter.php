<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\form\field\Cascader;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\FilterIde;
use ExAdmin\ui\support\Request;
use Illuminate\Support\Facades\Log;

/**
 * @method FilterIde eq(\Closure $closure= null) 等于
 * @method FilterIde neq(\Closure $closure= null) 不等于
 * @method FilterIde egt(\Closure $closure= null) 大于等于
 * @method FilterIde elt(\Closure $closure= null) 小于等于
 * @method FilterIde gt(\Closure $closure= null) 大于
 * @method FilterIde lt(\Closure $closure= null) 小于
 * @method FilterIde between(\Closure $closure= null) 区间
 * @method FilterIde notBetween(\Closure $closure= null) NOT区间查询
 * @method FilterIde like(\Closure $closure= null) 模糊
 * @method FilterIde json(\Closure $closure= null) json查询
 * @method FilterIde jsonLike(\Closure $closure= null) json模糊查询
 * @method FilterIde jsonArrLike(\Closure $closure= null) json数组模糊查询
 * @method FilterIde in(\Closure $closure= null) in查询
 * @method FilterIde notIn(\Closure $closure= null) not in查询
 * @method FilterIde findIn(\Closure $closure= null) findIn查询
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
            if(in_array($name,['dateRange','dateTimeRange','timeRange','yearRange','monthRange','weekRange','quarterRange'])){
                array_unshift($arguments,$arguments[0]);
            }
            if(!is_null($form)){
                $formComponent = call_user_func_array([$this->form,$name],$arguments);
                $formComponent->getFormItem()->style(['display'=>'none']);
            }
            if(is_null($form)){
                $form = $this->form;
            }
            $formComponent = call_user_func_array([$form,$name],$arguments);
            list($fields) = Arr::formItem($formComponent,$arguments);
            $params = [];
            $input = Request::input();
            $rule = $this->rule;
            if($formComponent instanceof Cascader){
                if(Request::has($formComponent->getRelation())){
                    $this->rule = 'cascader';
                    $fields  = [$formComponent->getRelation()];
                }else{
                    $fields = $fields[0];
                }
               
            }
            foreach ($fields as $field){
                if($this->rule == 'cascader'){
                    $params[$rule] = Arr::get($input,$field);
                }else{
                    $params[$field] = Arr::get($input,$field);
                }
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
    public function isHide(){
        foreach ($this->form->getFormItem() as $item){
            $style = $item->attr('style');
            if(!$style || !isset($style['display'])){
                return false;
            }
        }
        return true;
    }
    /**
     * @return Form
     */
    public function form()
    {
        return $this->form;
    }

}
