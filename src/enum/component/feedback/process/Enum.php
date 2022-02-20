<?php


namespace ExAdmin\ui\enum\component\feedback\process;


class Enum
{
	/**
	 * 进度条的样式 - round
	 */
	const STROKE_LINE_CAP_ROUND = 'round';

	/**
	 * 进度条的样式 - square
	 */
	const STROKE_LINE_CAP_SQUARE = 'square';

	/**
	 * 状态 - success
	 */
	const STATUS_SUCCESS = 'success';

	/**
	 * 状态 - exception
	 */
	const STATUS_EXCEPTION = 'exception';

	/**
	 * 状态 - normal
	 */
	const STATUS_NORMAL = 'normal';

	/**
	 * 状态 - active(仅限 line)
	 */
	const STATUS_ACTIVE = 'active';

	/**
	 * 类型 - line
	 */
	const TYPE_LINE = 'line';

	/**
	 * 类型 - circle
	 */
	const TYPE_CIRCLE = 'circle';

	/**
	 * 类型 - dashboard
	 */
	const TYPE_DASHBOARD = 'dashboard';

	/**
	 * 仪表盘进度条缺口位置 - top
	 */
	const GAP_POSITION_TOP = 'top';

	/**
	 * 仪表盘进度条缺口位置 - bottom
	 */
	const GAP_POSITION_BOTTOM = 'bottom';

	/**
	 * 仪表盘进度条缺口位置 - left
	 */
	const GAP_POSITION_LEFT = 'left';

	/**
	 * 仪表盘进度条缺口位置 - right
	 */
	const GAP_POSITION_RIGHT = 'right';
}