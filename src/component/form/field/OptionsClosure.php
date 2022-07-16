<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-13
 * Time: 21:48
 */

namespace ExAdmin\ui\component\form\field;




trait OptionsClosure
{
    protected $options = [];

    protected $optionsBindField = null;
    
    protected $optionsClosure = null;
    
   
    protected function bindOptionsField(){
        if(is_null($this->optionsBindField )){
            $this->optionsBindField = $this->random();
        }
        $this->formItem->form()->except($this->optionsBindField);
       
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    protected function mountOptions(){
        if ($this->optionsClosure) {
            
            call_user_func($this->optionsClosure);
            $this->optionsClosure = null;
        }
    }
    
    public function jsonSerialize()
    {
        $this->mountOptions();
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}