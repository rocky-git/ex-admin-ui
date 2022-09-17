<?php

namespace ExAdmin\ui\component\form\field\select;

use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\component\form\field\CallbackDefinition;
use ExAdmin\ui\component\form\FormItem;
use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\support\Request;

class SelectTable extends Field
{
    use CallbackDefinition;
    
    protected $name = 'ExSelectTable';
    
    /**
     * 渲染实例
     * @param mixed $grid
     * @param array $params
     * @return $this
     */
    public function grid($grid, $params = []){
        list($url, $params) = $this->parseComponentCall($grid,$params);
        $this->attr('gridUrl',$url);
        $this->attr('params',$params);
        return $this;
    }

    /**
     * 多选
     * @return $this
     */
    public function multiple()
    {
        $this->attr('multiple',true);
        $this->attr('mode','multiple');
        $this->modelValueArray();
        return $this;
    }
    public function display(\Closure $closure){
        $this->attr('custom',true);
        return $this->selectRequest($closure,function ($data){
            return $data;
        });
    }
    public function options(\Closure $closure)
    {
        return $this->selectRequest($closure,function ($data){
            $options = [];
            foreach ($data as $key => $value) {
                $options[] = [
                    'value' => $key,
                    'label' => $value
                ];
            }
            return $options;
        });
    }
    protected function selectRequest(\Closure $closure,\Closure $custom){
        $callbackField = $this->setCallback($closure,$custom);
        $this->attr('submitUrl',$this->formItem->form()->attr('url'));
        $this->attr('submitParams',$this->formItem->form()->call['params']+['ex_admin_form_action'=>'selectTable','ex_admin_callback_field'=>$callbackField]);
        return $this;
    }
    
   

}
