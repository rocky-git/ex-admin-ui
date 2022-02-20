<?php


namespace ExAdmin\ui\enum\component\grid\avatar;


class Enum
{
	/**
	 * 头像的形状 - 圆形
	 */
	const SHAPE_CIRCLE = 'circle';

	/**
	 * 头像的形状 - 正方形
	 */
	const SHAPE_SQUARE = 'square';

	/**
	 * 头像大小 - large
	 */
	const SIZE_LARGE = 'large';

	/**
	 * 头像大小 - small
	 */
	const SIZE_SMALL = 'small';

	/**
	 * 头像大小 - default
	 */
	const SIZE_DEFAULT = 'default';

	/**
	 * 图片是否允许拖动 - 允许
	 */
	const DRAGGABLE_TRUE = 'true';

	/**
	 * 图片是否允许拖动 - 不允许
	 */
	const DRAGGABLE_FALSE = 'false';

	/**
	 * 多余头像气泡弹出位置 - 上方
	 */
	const MAX_POPOVER_PLACEMENT_TOP = 'top';

	/**
	 * 多余头像气泡弹出位置 - 下方
	 */
	const MAX_POPOVER_PLACEMENT_BOTTOM = 'bottom';
}