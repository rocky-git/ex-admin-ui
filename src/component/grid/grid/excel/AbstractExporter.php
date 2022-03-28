<?php
namespace ExAdmin\ui\component\grid\grid\excel;

abstract class AbstractExporter
{
    protected $only = [];

    protected $except = [];

    protected $columns = [];
    
    protected $data = [];

   
    protected $filename;
    
    /**
     * 设置文件名称
     * @param $filename
     */
    public function filename($filename){
        $this->filename = $filename;
    }
    /**
     * 设置表头列
     * @param array $columns
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }
   
    /**
     * 排除列
     * @param array $columns
     */
    public function except(array $columns)
    {
        $this->except = $columns;
    }

    /**
     * 设置数据源
     * @param array $data
     */
    public function data(array $data){
        $this->data = $data;
    }
    abstract public function export();
}
