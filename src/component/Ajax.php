<?php

namespace ExAdmin\ui\component;
/**
 *
 */
class Ajax extends Component
{
    protected $component;
    protected $options = [];
    protected $arg = [];

    public function __construct($component, $options)
    {
        $this->component = $component;
        $this->options = $options;
    }

    public function confirms(array $options)
    {
        $this->arg['confirm'] = $options;
    }

    public function gridRefresh()
    {
        $this->arg['gridRefresh'] = true;
    }
    
    public function jsonSerialize()
    {
        $this->component->directive('ajax', $this->options, $this->arg);
        return $this->component;
    }
}
