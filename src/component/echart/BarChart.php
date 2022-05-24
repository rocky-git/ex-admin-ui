<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-05-23
 * Time: 22:43
 */

namespace ExAdmin\ui\component\echart;

use Carbon\Carbon;

/**
 * 柱状图
 * Class BarChart
 * @package ExAdmin\ui\component\echart
 * @method static $this create(string|array $xAxis) 创建
 */
class BarChart extends LineChart
{
    protected $xAxis = [];
    public function __construct($xAxis)
    {
        parent::__construct($xAxis);
        $this->echart->xAxis = [
            'type' => 'category',
            'data' => array_values($this->xAxis)
        ];
    }

    /**
     * 添加数据
     * @param $name
     * @param array|\Closure $data
     * @return $this
     */
    public function data($name, $data)
    {
        $data = $this->series($data);
        $this->echart->series[] = array(
            'name' => $name,
            'type' => 'bar',
            'data' => $data
        );
        return $this;
    }
}