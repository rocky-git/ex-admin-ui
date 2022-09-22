<?php


namespace ExAdmin\ui\component;




trait Where
{
    protected $where = [];
    //组件显示
    protected $componentVisible = true;

    /**
     * 条件显示
     * @param bool $condition
     * @return $this
     */
    public function whenShow($condition)
    {
        $this->componentVisible = $condition;

        return $this;
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function setWhere($where)
    {
        $this->where = $where;
        return $this;
    }
    /**
     * v-show指定AND查询条件
     * @access public
     * @param string $field 查询字段
     * @param mixed $op 查询表达式
     * @param mixed $condition 查询条件
     * @param string $logic AND OR
     */
    public function whereShow($field, $op = null, $condition = null, $logic = 'AND'){
        return $this->where($field, $op, $condition, $logic,'v-show');
    }
    /**
     * v-show指定OR查询条件
     * @access public
     * @param string $field 查询字段
     * @param mixed $op 查询表达式
     * @param mixed $condition 查询条件
     */
    public function whereOrShow($field, $op = null, $condition = null){
        return $this->whereShow($field, $op, $condition, 'OR');
    }
    /**
     * v-if指定AND查询条件
     * @access public
     * @param string|\Closure $field 查询字段
     * @param mixed $op 查询表达式
     * @param mixed $condition 查询条件
     * @param string $logic AND OR
     * @param string $type v-if v-show
     * @return $this
     */
    public function where($field, $op = null, $condition = null, $logic = 'AND', $type = 'v-if')
    {
        $logic = strtoupper($logic);
        if ($field instanceof \Closure) {
            $where = clone $this;
            $where->setWhere([
                'AND' => [],
                'OR' => []
            ]);
            call_user_func_array($field, [$where]);
            $this->where[$logic][] = [
                'where' => $where->getWhere()
            ];
        } else {

            if ($op === '=') {
                $op = '==';
            }

            if (is_null($condition)) {
                $condition = $op;
                $op = '==';
            }

            $this->where[$logic][] = [
                'field' => $field,
                'op' => $op,
                'condition' => $condition,
                'type' => $type
            ];

        }
        return $this;
    }

    /**
     * v-if指定OR查询条件
     * @access public
     * @param string|\Closure $field 查询字段
     * @param mixed $op 查询表达式
     * @param mixed $condition 查询条件
     * @param string $type v-if v-show
     * @return $this
     */
    public function whereOr(string $field, $op = null, $condition = null, $type = 'v-if')
    {
        return $this->where($field, $op, $condition, 'OR');
    }
}
