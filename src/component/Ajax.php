<?php

namespace ExAdmin\ui\component;
/**
 * ajax请求
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


    public function arg($name,array $options)
    {
        $this->arg[$name] = $options;
        return $this;
    }

    /**
     * grid 选择项
     * @return $this
     */
    public function gridBatch()
    {
        $this->arg['gridBatch'] = true;
        return $this;
    }

    /**
     * 刷新grid
     * @return $this
     */
    public function gridRefresh()
    {
        $this->arg['gridRefresh'] = true;
        return $this;
    }
    
    public function jsonSerialize(): mixed
    {
        if(!$this->componentVisible){
            $this->component->whenShow($this->componentVisible);
        }
        $this->component->directive('ajax', $this->options, $this->arg);
        return $this->component;
    }
}
