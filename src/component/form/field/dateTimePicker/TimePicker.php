<?php

namespace ExAdmin\ui\component\form\field\dateTimePicker;

use ExAdmin\ui\component\Component;

/**
 * 时间选择框
 * Class TimePicker
 * @link   https://next.antdv.com/components/time-picker-cn 时间选择框组件
 * @link   https://day.js.org/docs/zh-CN/display/format 时间格式
 * @method $this allowClear(bool $clear = true) 是否展示清除按钮															boolean
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this bordered(bool $bordered = true) 是否有边框																boolean
 * @method $this clearText(string $text = 'clear') 清除按钮的提示文案														string
 * @method $this disabled(bool $disabled = false) 禁用全部操作															boolean
 * @method $this format(string $format = 'HH:mm:ss') 展示的时间格式														string
 * @method $this hideDisabledOptions(bool $disabled = false) 隐藏禁止选择的选项											boolean
 * @method $this hourStep(int $step = 1) 小时选项间隔																	number
 * @method $this inputReadOnly(bool $readOnly = false) 设置输入框为只读（避免在移动设备上打开虚拟键盘）						boolean
 * @method $this minuteStep(int $step = 1) 分钟选项间隔																	number
 * @method $this open(bool $open = false) 面板是否打开																	boolean
 * @method $this placeholder(mixed $placeholder = '请选择时间') 没有值的时候显示的内容										string | [string, string]
 * @method $this popupClassName(string $name) 弹出层类名																	string
 * @method $this secondStep(int $step = 1) 秒选项间隔																	number
 * @method $this showNow(bool $show) 面板是否显示“此刻”按钮																boolean
 * @method $this use12Hours(bool $used = false) 使用 12 小时制，为 true 时 format 默认为 h:mm:ss a							boolean
 * @method $this value(mixed $value) 当前时间
 * @method $this valueFormat(string $format) 可选，绑定值的格式，对 value、defaultValue 起作用。不指定则绑定值为 dayjs 对象	string
 * @package ExAdmin\ui\component\form\field
 */
class TimePicker extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATimePicker';

	
}