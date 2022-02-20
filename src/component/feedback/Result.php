<?php

namespace ExAdmin\ui\component\feedback;

use ExAdmin\ui\component\Component;

/**
 * 结果
 * Class Result
 * @link    https://next.antdv.com/components/result-cn 结果组件
 * @method $this title(mixed $title = 0) title 文字                                       								string | VNode | #subTitle
 * @method $this subTitle(mixed $subTitle = true) subTitle 文字                                        					string | VNode | #subTitle
 * @method $this status(string $status = 'info') 结果的状态,决定图标和颜色                            						'success' | 'error' | 'info' | 'warning' | '404' | '403' | '500'
 * @method $this icon(mixed $icon) 自定义 icon                                        									#icon
 * @method $this extra(mixed $extra = 'round') 操作区                                        							#extra
 * @package ExAdmin\ui\component\form\field
 */
class Result extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AResult';

	
}