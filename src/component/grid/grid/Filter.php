<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\form\field\Cascader;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\FilterIde;
use ExAdmin\ui\support\Request;


/**
 * @method FilterIde eq(\Closure $closure = null) 等于
 * @method FilterIde neq(\Closure $closure = null) 不等于
 * @method FilterIde egt(\Closure $closure = null) 大于等于
 * @method FilterIde elt(\Closure $closure = null) 小于等于
 * @method FilterIde gt(\Closure $closure = null) 大于
 * @method FilterIde lt(\Closure $closure = null) 小于
 * @method FilterIde between(\Closure $closure = null) 区间
 * @method FilterIde notBetween(\Closure $closure = null) NOT区间查询
 * @method FilterIde like(\Closure $closure = null) 模糊
 * @method FilterIde json(\Closure $closure = null) json查询
 * @method FilterIde jsonLike(\Closure $closure = null) json模糊查询
 * @method FilterIde jsonArrLike(\Closure $closure = null) json数组模糊查询
 * @method FilterIde in(\Closure $closure = null) in查询
 * @method FilterIde notIn(\Closure $closure = null) not in查询
 * @method FilterIde findIn(\Closure $closure = null) findIn查询
 */
class Filter
{
    use FormComponent;

    protected $grid;

    protected $form;

    protected $item;
    //合并参数
    protected $mergeParams = false;

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
        $this->form->removeEvent('success','custom');
        $this->form
            ->removeAttr('labelCol')
            ->layout('inline')
            ->removeAttr('url');
        $this->form->actions()
            ->submitButton()
            ->icon(' <search-outlined />')
            ->content('搜索');

    }
    public function setGrid(Grid $grid){
        $this->grid = $grid;
        $this->form->url($this->grid->attr('url'));
        $this->grid->driver()->setForm($this->form);
    }
    public function __call($name, $arguments)
    {
        return $this->setRule($name, $arguments);
    }

    public function setRule($name, $arguments, $form = null)
    {
        if (in_array($name, $this->filterType)) {
            $this->rule = $name;
            if (isset($arguments[0]) && $arguments[0] instanceof \Closure) {
                call_user_func($arguments[0], $this);
            }
        } elseif (isset(self::$formComponent[$name])) {
            if (in_array($name, ['dateRange', 'dateTimeRange', 'timeRange', 'yearRange', 'monthRange', 'weekRange', 'quarterRange','numberRange'])) {
                array_unshift($arguments, $arguments[0]);
            }
            if (!is_null($form)) {
                $formComponent = call_user_func_array([$this->form, $name], $arguments);
                $formComponent->getFormItem()->style(['display' => 'none']);
            }
            if (is_null($form)) {
                $form = $this->form;
            }
            $formComponent = call_user_func_array([$form, $name], $arguments);
            list($fields) = Arr::formItem($formComponent, $arguments);
            $params = [];
            $input = Request::input('ex_admin_filter',[]);
            if($this->mergeParams){
                $input = array_merge(Request::input(),$input);
            }
            $type = 'normal';
            if ($formComponent instanceof Cascader) {
                if (Request::has($formComponent->getRelation())) {
                    $type = 'cascader';
                    $fields = [$formComponent->getRelation()];
                } else {
                    $fields = $fields[0];
                }

            }
            foreach ($fields as $field) {
                $value = Arr::get($input, $field);
                if(!is_null($value)){
                    $formComponent->default($value);
                }
                if ($type == 'cascader') {
                    foreach ($value as &$item) {
                        $row = [];
                        foreach ($item as $key => $val) {
                            list($relation, $field) = $this->getRelation($key);
                            $row[$field] = $val;
                        }
                        $item = $row;
                    }
                } else {
                    list($relation, $field) = $this->getRelation($field);
                }
                $this->rules[] = [
                    'relation' => $relation,
                    'field' => $field,
                    'type' => $type,
                    'rule' => $this->rule,
                    'value' => $value
                ];
            }

            return $formComponent;
        }
        return $this;
    }

    protected function getRelation($field)
    {
        $relation = explode('.', $field);
        $field = array_pop($relation);
        $relation = implode('.', $relation);
        return [$relation, $field];
    }
    public function mergeParams(){
        $this->mergeParams =  true;
    }
    public function getRule()
    {
        foreach ($this->rules as &$item){
            if(is_null($item['value']) && !Request::has('ex_admin_filter')){
                $item['value'] = $this->form->input($item['field']);
            }
        }
        return $this->rules;
    }

    public function isHide()
    {
        foreach ($this->form->getFormItem() as $item) {
            $style = $item->attr('style');
            if (!$style || !isset($style['display'])) {
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
        $this->form->removeAttr('url');
        return $this->form;
    }

}
