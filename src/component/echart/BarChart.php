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
 */
class BarChart extends LineChart
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 设置x轴数据
     * @param string|array $xAxis
     * @return $this
     */
    function xAxis($xAxis = 'today')
    {
        parent::xAxis($xAxis); // TODO: Change the autogenerated stub
        $this->echart->xAxis = [
            'type' => 'category',
            'data' => array_column($this->xAxisData,'label')
        ];
        return $this;
    }

    /**
     * 添加数据
     * @param $name
     * @param array|\Closure $data
     * @return $this
     */
    public function data($name, $data)
    {
        $this->data[$name] = $data;
        $this->echart->series[] = array(
            'name' => $name,
            'type' => 'bar',
            'data' => $data
        );
        return $this;
    }
}
