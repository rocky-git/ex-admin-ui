<?php

namespace ExAdmin\ui\component\grid;

use ExAdmin\ui\component\Component;

/**
 * 日历
 * Class Calendar
 * @link    https://next.antdv.com/components/calendar-cn 日历组件
 * @method $this fullscreen(bool $fullscreen = true) 是否全屏显示                                        				boolean
 * @method $this locale(mixed $locale) 国际化配置                                        								object
 * @method $this mode(string $mode = 'month') 初始模式，month/year                                        				string
 * @method $this value(mixed $value) 展示日期
 * @method $this valueFormat(string $valueFormat) 可选，绑定值的格式，对 value、defaultValue 起作用。不指定则绑定值为 dayjs 对象                                        							string
 * @package ExAdmin\ui\component\form\field
 */
class Calendar extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACalendar';

	
}