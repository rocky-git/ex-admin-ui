<?php

namespace ExAdmin\ui\component\form\field\dateTimePicker\date;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\component\form\field\dateTimePicker\DatePicker;

/**
 * 季度选择框
 * Class QuarterPicker
 * @link   https://next.antdv.com/components/date-picker-cn 日期选择框组件
 * @link   https://day.js.org/docs/zh-CN/display/format 时间格式
 * @link   https://github.com/vueComponent/ant-design-vue/blob/next/components/date-picker/locale/example.json 国际化配置
 * @link   https://next.antdv.com/components/time-picker-cn/#API TimePicker Options
 * @package ExAdmin\ui\component\form\field
 */
class QuarterPicker extends DatePicker
{
    public function __construct($field = null, $value = null)
    {
        parent::__construct($field, $value);
        $this->picker('quarter');
       
    }


}
