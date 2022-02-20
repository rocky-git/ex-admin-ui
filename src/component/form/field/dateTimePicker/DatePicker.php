<?php

namespace ExAdmin\ui\component\form\field\dateTimePicker;

/**
 * 时间选择框
 * Class DatePicker
 * @link   https://next.antdv.com/components/date-picker-cn 日期选择框组件
 * @link   https://day.js.org/docs/zh-CN/display/format 时间格式
 * @link   https://github.com/vueComponent/ant-design-vue/blob/next/components/date-picker/locale/example.json 国际化配置
 * @link   https://next.antdv.com/components/time-picker-cn/#API TimePicker Options
 * @method $this allowClear(bool $clear = true) 是否展示清除按钮															boolean
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this bordered(bool $bordered = true) 是否有边框																boolean
 * @method $this disabled(bool $disabled = false) 禁用全部操作															boolean
 * @method $this dropdownClassName(string $name) 额外的弹出日历 className													string
 * @method $this inputReadOnly(bool $readOnly = false) 设置输入框为只读（避免在移动设备上打开虚拟键盘）						boolean
 * @method $this locale(mixed $locale) 国际化配置																		object
 * @method $this mode(string $mode) 日期面板的状态																		time | date | month | year | decade
 * @method $this open(bool $open) 控制弹层是否展开																		boolean
 * @method $this picker(bool $picker = 'date') 设置选择器类型																date | week | month | quarter | year
 * @method $this placeholder(mixed $placeholder) 输入框提示文字															string | [string, string]
 * @method $this size(string $size) 输入框大小，large 高度为 40px，small 为 24px，默认是 32px								large | middle | small
 * @method $this valueFormat(string $format) 可选，绑定值的格式，对 value、defaultValue、defaultPickerValue 起作用。不指定则绑定值为 dayjs 对象
 * @method $this defaultPickerValue(string $value) 默认面板日期
 * @method $this format(string $format = 'YYYY-MM-DD') 置日期格式，为数组时支持多格式匹配，展示以第一个为准。配置参考 dayjs，支持自定义格式 string | (value: dayjs) => string | (string | (value: dayjs) => string)[]
 * @method $this showNow(bool $show) 当设定了 showTime 的时候，面板是否显示“此刻”按钮										boolean
 * @method $this showTime(mixed $show) 增加时间选择功能																	Object | boolean
 * @method $this showToday(bool $show = true) 是否展示“今天”按钮															boolean
 * @method $this value(mixed $value) 日期
 * @package ExAdmin\ui\component\form\field
 */
class DatePicker
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ADatePicker';

	public static function create()
	{
		return new self();
	}
}