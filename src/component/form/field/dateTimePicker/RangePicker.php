<?php

namespace ExAdmin\ui\component\form\field\dateTimePicker;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\component\form\RangeField;

/**
 * 时间选择框
 * Class RangePicker
 * @link   https://next.antdv.com/components/date-picker-cn 日期选择框组件
 * @link   https://day.js.org/docs/zh-CN/display/format 时间格式
 * @link   https://github.com/vueComponent/ant-design-vue/blob/next/components/date-picker/locale/example.json 国际化配置
 * @method $this allowClear(bool $clear = true) 是否展示清除按钮                                                            boolean
 * @method $this autofocus(bool $focus = true) 自动获取焦点                                                                boolean
 * @method $this bordered(bool $bordered = true) 是否有边框                                                                boolean
 * @method $this disabled(bool $disabled = false) 禁用全部操作                                                            boolean
 * @method $this dropdownClassName(string $name) 额外的弹出日历 className                                                    string
 * @method $this inputReadOnly(bool $readOnly = false) 设置输入框为只读（避免在移动设备上打开虚拟键盘）                        boolean
 * @method $this locale(mixed $locale) 国际化配置                                                                        object
 * @method $this mode(string $mode) 日期面板的状态                                                                        time | date | month | year | decade
 * @method $this open(bool $open) 控制弹层是否展开                                                                        boolean
 * @method $this picker(bool $picker = 'date') 设置选择器类型                                                                date | week | month | quarter | year
 * @method $this placeholder(mixed $placeholder) 输入框提示文字                                                            string | [string, string]
 * @method $this size(string $size) 输入框大小，large 高度为 40px，small 为 24px，默认是 32px                                large | middle | small
 * @method $this valueFormat(string $format) 可选，绑定值的格式，对 value、defaultValue、defaultPickerValue 起作用。不指定则绑定值为 dayjs 对象
 * @method $this allowEmpty(array $allowEmpty = [false, false]) 允许起始项部分为空                                        [boolean, boolean]
 * @method $this defaultPickerValue(mixed $value) 默认面板日期
 * @method $this format(string $format = 'YYYY-MM-DD HH:mm:ss') 展示的日期格式
 * @method $this separator(mixed $separator) 设置分隔符                                                                    string | v-slot:separator
 * @method $this showTime(mixed $format) 增加时间选择功能                                                                    Object|boolean
 * @method static $this create($startField, $endField, $value = []) 创建
 * @package ExAdmin\ui\component\form\field
 */
class RangePicker extends RangeField
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'separator',
    ];

   
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ARangePicker';

    public function __construct($startField, $endField, $value = [])
    {
        $this->valueFormat('YYYY-MM-DD');
        parent::__construct($startField, $endField,$value);
    }
}
