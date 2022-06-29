<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-29
 * Time: 10:54
 */

namespace ExAdmin\ui\component\grid\grid;


/**
 * Class ColumnWhen
 * @package ExAdmin\ui\component\grid\grid
 * @mixin Column
 */
class ColumnWhen
{
    /**
     * @var Column
     */
    protected $column;

    protected $rule = [];

    protected $else = false;

    public function __construct(Column $column)
    {
        $this->column = $column;
    }
    /**
     * 条件执行
     * @param $condition|\Closure
     * @return $this
     */
    public function if($condition){
        $this->rule[$this->key()+1]['condition'] = $condition;
        $this->rule[$this->key()]['then'] = [];
        $this->rule[$this->key()]['else'] = [];
        return $this;
    }

    /**
     * else执行
     * @param \Closure|null $closure
     * @return $this
     */
    public function else(\Closure $closure = null){
        if(!is_null($closure)){
            $this->rule[$this->key()]['else'][] = $closure;
        }
        $this->else = true;
        return $this;
    }

    /**
     * 条件成功执行
     * @param \Closure $closure
     * @return $this
     */
    public function then(\Closure $closure){
        $this->rule[$this->key()]['then'][] = $closure;
        return $this;
    }
    public function end(){
        $this->else = false;
        return $this->column;
    }
    public function exec($value,$data){

        foreach ($this->rule as $rule){

            $condition = $rule['condition'];
            if($condition instanceof \Closure){
                $condition = call_user_func_array($condition, [$value, $data,$this->column]);
            }
            if ($condition) {
                $this->parseRule($rule['then']);
                break;
            }else{
                $this->parseRule($rule['else']);
            }
        }
    }
    protected function parseRule($rule){
        foreach ($rule as $item){
            if(is_array($item)){
                list($name, $arguments) = $item;
                call_user_func_array([$this->column,$name], $arguments);
            }elseif ($item instanceof \Closure){
                call_user_func($item, $this->column);
            }
        }
    }
    protected function key(){
        return $key = count($this->rule);;
    }
    public function __call($name, $arguments)
    {
        if($this->else){
            $this->rule[$this->key()]['else'][] = [$name, $arguments];
        }else{
            $this->rule[$this->key()]['then'][] = [$name, $arguments];
        }
        return $this;
    }
}