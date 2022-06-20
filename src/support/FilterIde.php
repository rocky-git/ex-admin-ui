<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-27
 * Time: 22:01
 */

namespace ExAdmin\ui\support;
use ExAdmin\ui\component\form\field\dateTimePicker\range\DateTimeRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\MonthRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\QuarterRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\WeekRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\YearRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\RangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\TimeRangePicker;
use ExAdmin\ui\component\form\traits\FormComponent;

/**
 * Class FilterIde
 * @package ExAdmin\ui\support
 * @method RangePicker dateRange(string $filed, string $label = '') 日期范围选择框
 * @method DateTimeRangePicker dateTimeRange(string $filed, string $label = '') 日期时间范围选择框
 * @method TimeRangePicker timeRange(string $filed, string $label = '') 时间范围选择框
 * @method YearRangePicker yearRange(string $filed, string $label = '') 年份范围选择框
 * @method MonthRangePicker monthRange(string $filed, string $label = '') 月份范围选择框
 * @method WeekRangePicker weekRange(string $filed, string $label = '') 星期范围选择框
 * @method QuarterRangePicker quarterRange(string $filed, string $label = '') 季度范围选择框
 * @method NumberRange numberRange(string $filed, string $label = '') 数字范围输入框
 * @mixin FormComponent
 */

class FilterIde
{

}
