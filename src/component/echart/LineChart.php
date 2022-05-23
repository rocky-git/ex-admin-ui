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
 * 折线图
 * Class LineChart
 * @package ExAdmin\ui\component\echart
 * @method static $this create(string|array $xAxis) 创建
 */
class LineChart extends Echart
{
    protected $xAxis = [];
    public function __construct($xAxis)
    {
        parent::__construct();
        $this->echart->tooltip->trigger = 'axis';
        $this->echart->grid = [
            'left' => '3%',
            'right' => '4%',
            'bottom' => '3%',
            'containLabel' => true
        ];
        $this->echart->yAxis[] = array(
            'type' => 'value'
        );
        $this->xAxis = $xAxis;
        if(is_string($xAxis)){
            $this->xAxis = [];
            switch ($xAxis) {
                case 'yesterday':
                case 'today':
                    if ($xAxis == 'yesterday') {
                        $date = date('Y-m-d 00:00', strtotime(' -1 day'));
                    } else {
                        $date = date('Y-m-d 00:00');
                    }
                    for ($i = 0; $i < 24; $i++) {
                        $this->xAxis[Carbon::parse($date)->addHours($i)->toDateTimeString()] =
                            "{$i}".admin_trans('echart.dian').admin_trans('echart.to').($i+1).admin_trans('echart.dian');
                    }
                    break;
                case 'week':
                    $start_week = Carbon::now()->startOfWeek()->addDays(-1)->toDateString();
                    for ($i = 0; $i <= 6; $i++) {
                        $week = Carbon::make($start_week)->addDays($i)->toDateString();
                        $this->xAxis[$week] = $week;
                    }
                    break;
                case 'month':
                    $now = Carbon::today();
                    $months = Carbon::parse($now->firstOfMonth()->toDateString())->daysUntil($now->endOfMonth()->toDateString())->toArray();
                    foreach ($months as $month) {
                        $data = $month->toDateString();
                        $this->xAxis[$data] = $data;
                    }
                    break;
                case 'year':
                    $now = Carbon::today();
                    for ($i = 1; $i <= 12; $i++) {
                        $date = Carbon::parse($now)->firstOfYear()->addMonths($i-1)->format('Y-m');
                        $this->xAxis[$date] =  $i . admin_trans('echart.month');
                    }
                    break;
            }
        }
        $this->echart->xAxis = [
            'type' => 'category',
            'boundaryGap' => false,
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
        if ($data instanceof \Closure) {
            $call = $data;
            $data = [];
            foreach (array_keys($this->xAxis) as $item) {
                $data[] = call_user_func($call, $item);
            }
        }
        $this->echart->series[] = array(
            'name' => $name,
            'type' => 'line',
            'symbolSize' => 6,
            'data' => $data
        );
        return $this;
    }
}