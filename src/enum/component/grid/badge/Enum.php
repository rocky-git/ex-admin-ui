<?php


namespace enum\component\grid\badge;


class Enum
{
	/**
	 * badge状态点 - success
	 */
	const STATUS_SUCCESS = 'success';

	/**
	 * badge状态点 - processing
	 */
	const STATUS_PROCESSING = 'processing';

	/**
	 * badge状态点 - default
	 */
	const STATUS_DEFAULT = 'default';

	/**
	 * badge状态点 - error
	 */
	const STATUS_ERROR = 'error';

	/**
	 * badge状态点 - warning
	 */
	const STATUS_WARING = 'warning';

	/**
	 * 缎带的位置 - 随文字方向（RTL) - start
	 */
	const PLACEMENT_START = 'start';

	/**
	 * 缎带的位置 - 随文字方向（LTR) - end
	 */
	const PLACEMENT_END = 'end';
}