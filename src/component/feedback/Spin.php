<?php

namespace ExAdmin\ui\component\feedback;

/**
 * 加载中
 * Class Spin
 * @link    https://next.antdv.com/components/spin-cn 加载中组件
 * @method $this delay(int $delay) 延迟显示加载效果的时间（防止闪烁）                                  						number (毫秒)
 * @method $this indicator(mixed $indicator) 加载指示符                                        							vNode | slot
 * @method $this size(string $size = 'default') 组件大小，可选值为 small default large                            		string
 * @method $this spinning(bool $spinning = true) 是否为加载中状态                                        					boolean
 * @method $this tip(string $tip) 当作为包裹元素时，可以自定义描述文案                                        				string
 * @method $this wrapperClassName(string $wrapperClassName) 包装器的类属性                                       			string
 * @package ExAdmin\ui\component\form\field
 */
class Spin
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASpin';

	public static function create()
	{
		return new self();
	}
}