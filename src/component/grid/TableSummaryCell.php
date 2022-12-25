<?php


namespace ExAdmin\ui\component\grid;


use ExAdmin\ui\component\Component;

class TableSummaryCell extends Component
{
    protected $name = 'ATableSummaryCell';

    protected $total = 0;

    protected $display = null;

    public function display(\Closure $closure){
        $this->display = $closure;
    }
    public function increment($value){
        $this->total += $value;
    }
    public function setTotal($value){
        $this->total = $value;
    }
    public function getTotal(){
        return $this->total;
    }
    public function displayContent(){
        if($this->display){
            $content = call_user_func($this->display,$this->total);
        }else{
            $content = $this->total;
        }
        $this->content($content);
    }
}