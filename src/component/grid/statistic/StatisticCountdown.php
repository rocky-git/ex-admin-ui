<?php

namespace ExAdmin\ui\component\grid\statistic;

use ExAdmin\ui\component\Component;

/**
 * 气泡卡片
 * Class StatisticCountdown
 * @link    https://next.antdv.com/components/statistic-cn 气泡卡片组件
 * @method $this format(string $format = 'HH:mm:ss') 格式化倒计时展示，参考 dayjs                                        	string
 * @method $this prefix(mixed $prefix) 设置数值的前缀                                        								string | v-slot
 * @method $this suffix(mixed $suffix) 设置数值的后缀                                        								string | v-slot
 * @method $this title(mixed $title) 数值的标题                                        									string | v-slot
 * @method $this value(mixed $value) 数值内容                                        									number | dayjs
 * @method $this valueStyle(mixed $valueStyle) 设置数值的样式                                        						style
 * @package ExAdmin\ui\component\form\field
 */
class StatisticCountdown extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AStatisticCountdown';

	
}