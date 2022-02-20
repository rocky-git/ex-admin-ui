<?php

namespace ExAdmin\ui\component\grid\statistic;

/**
 * 气泡卡片
 * Class Statistic
 * @link    https://next.antdv.com/components/statistic-cn 气泡卡片组件
 * @method $this decimalSeparator(string $decimalSeparator) 设置小数点                                        			string
 * @method $this formatter(mixed $formatter) 自定义数值展示                                        						v-slot | ({value}) => VNode
 * @method $this groupSeparator(string $groupSeparator = ',') 设置千分位标识符                                        	string
 * @method $this precision(int $precision) 数值精度                                        								number
 * @method $this prefix(mixed $prefix) 设置数值的前缀                                        								string | v-slot
 * @method $this suffix(mixed $suffix) 设置数值的后缀                                        								string | v-slot
 * @method $this title(mixed $title) 数值的标题                                        									string | v-slot
 * @method $this value(mixed $value) 数值内容                                        									string | number
 * @method $this valueStyle(mixed $valueStyle) 设置数值的样式                                        						style
 * @package ExAdmin\ui\component\form\field
 */
class Statistic
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AStatistic';

	public static function create()
	{
		return new self();
	}
}