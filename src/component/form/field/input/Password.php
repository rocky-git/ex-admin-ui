<?php

namespace component\form\field\input;

/**
 * 密码框
 * Class Password
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @method $this visibilityToggle(boolean $is_show = true) 是否显示切换按钮												boolean
 * @package component\form\field
 */
class Password
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AInputPassword';

	public static function create()
	{
		return new self();
	}
}