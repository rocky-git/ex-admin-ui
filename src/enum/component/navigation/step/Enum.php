<?php

namespace enum\component\navigation\step;

class Enum
{
	/**
	 * 步骤条类型 - 默认
	 */
	const TYPE_DEFAULT = 'default';

	/**
	 * 步骤条类型 - 导航
	 */
	const TYPE_NAVIGATION = 'navigation';

	/**
	 * 步骤条方向 - 水平
	 */
	const DIRECTION_HORIZONTAL = 'horizontal';

	/**
	 * 步骤条方向 - 竖直
	 */
	const DIRECTION_VERTICAL = 'vertical';

	/**
	 * 大小 - 普通
	 */
	const SIZE_DEFAULT = 'default';

	/**
	 * 大小 - 迷你
	 */
	const SIZE_SMALL = 'small';

	/**
	 * 当前步骤状态 - 等待
	 */
	const STATUS_WAIT = 'wait';

	/**
	 * 当前步骤状态 - 进行中
	 */
	const STATUS_PROCESS = 'process';

	/**
	 * 当前步骤状态 - 完成
	 */
	const STATUS_FINISH = 'finish';

	/**
	 * 当前步骤状态 - 错误
	 */
	const STATUS_ERROR = 'error';
}