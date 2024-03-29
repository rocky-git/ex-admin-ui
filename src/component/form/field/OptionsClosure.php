<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-13
 * Time: 21:48
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\field\select\Select;

trait OptionsClosure
{
    protected $options = [];

    protected $optionsBindField = null;

    protected $optionsClosure = null;


    protected function bindOptionsField()
    {
        if (is_null($this->optionsBindField)) {
            $this->optionsBindField = $this->random();
        }
        $this->exceptField($this->optionsBindField);

    }

    public function setOptionsBindField($field)
    {
        $this->optionsBindField = $field;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    protected function mountOptions()
    {
        if ($this->optionsClosure) {

            call_user_func($this->optionsClosure);
            $this->optionsClosure = null;
        }
    }

    public function jsonSerialize()
    {
        $this->mountOptions();
        if($this instanceof Select && $this->attr('mode') == 'multiple' && $this->form->attr('layout') == 'inline'){
            $this->style(['minWidth'=>'200px']);
        }
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}