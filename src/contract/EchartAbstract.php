<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\echart\Echart;

abstract class EchartAbstract
{
    protected $repository;
    /**
     * @var Echart
     */
    protected $echart;
    
    /**
     * 初始化
     * @param Echart $echart
     * @param $repository
     */
    public function initialize(Echart $echart, $repository)
    {

        $this->echart = $echart;

        $this->repository = $repository;
    }
    public function getRepository(){
        return $this->repository;
    }
    /**
     * 筛选
     * @param array $rule
     * @return mixed
     */
    abstract public function filter(array $rule);
}
