<?php

namespace component\navigation;

/**
 * 步骤表单
 * Class Step
 * @link    https://next.antdv.com/components/steps-cn 步骤表单组件
 * @method $this description(mixed $description) 步骤的详情描述，可选                                  					string | slot
 * @method $this icon(mixed $icon) 步骤图标的类型，可选                                  									string | slot
 * @method $this status(string $status = 'wait') 指定状态。当不配置该属性时，会使用 Steps 的 current 来自动指定状态。
 * 												可选：wait process finish error                                          string
 * @method $this title(mixed $title) 标题                                  												string | slot
 * @method $this subTitle(mixed $subTitle) 子标题                                  										string | slot
 * @method $this disabled(bool $disabled = false) 禁用点击                                  								boolean
 * @package component\form\field
 */
class Step
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AStep';

	public static function create()
	{
		return new self();
	}
}