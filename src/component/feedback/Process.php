<?php

namespace ExAdmin\ui\component\feedback;

use ExAdmin\ui\component\Component;

/**
 * 进度条
 * Class Process
 * @link    https://next.antdv.com/components/progress-cn 进度条组件
 * 公共属性
 * @method $this percent(int $percent = 0) 百分比                                       									number
 * @method $this showInfo(bool $showInfo = true) 是否显示进度数值或状态图标                                        		boolean
 * @method $this status(string $status) 状态，可选：success exception normal active(仅限 line)                            string
 * @method $this strokeColor(string $strokeColor) 进度条的色彩                                        					string
 * @method $this strokeLinecap(string $strokeLinecap = 'round') 进度条的样式                                        		round | square
 * @method $this success(mixed $success) 成功进度条相关配置                                       						{ percent: number, strokeColor: string }
 * @method $this trailColor(string $trailColor) 未完成的分段的颜色                                        				string
 * @method $this type(string $type = 'line') 类型，可选 line circle dashboard                             				string
 * @method $this title(string $title) html 标签 title                            										string
 * @method $this strokeWidth(int $strokeWidth) 进度条线的宽度，单位 px													number
 * @method $this width(int $width = 132) 圆形进度条画布宽度，单位 px（type = 'line'没有）									number
 *
 * type="line"
 * @method $this steps(int $steps) 进度条总共步数																			number
 *
 * type="dashboard"
 * @method $this gapDegree(int $gapDegree = 75) 仪表盘进度条缺口角度，可取值 0 ~ 295										number
 * @method $this gapPosition(string $gapDegree = 'bottom') 仪表盘进度条缺口位置											top | bottom | left | right
 * @package ExAdmin\ui\component\form\field
 */
class Process extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AProcess';

	public static function create()
	{
		return new self();
	}
}