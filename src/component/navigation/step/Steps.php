<?php

namespace ExAdmin\ui\component\navigation\step;

use ExAdmin\ui\component\Component;

/**
 * 步骤表单
 * Class Steps
 * @link    https://next.antdv.com/components/steps-cn 步骤表单组件
 * @method $this type(string $type = 'default') 步骤条类型，有 default 和 navigation 两种                                  		string
 * @method $this current(int $current = 0) 指定当前步骤，从 0 开始记数。在子 Step 元素中，可以通过 status 属性覆盖状态          	  	number
 * @method $this direction(string $direction = 'horizontal') 指定步骤条方向。目前支持水平（horizontal）和竖直（vertical）两种方向     string
 * @method $this labelPlacement(string $labelPlacement = 'horizontal') 指定标签放置位置，默认水平放图标右侧，可选vertical放图标下方   string
 * @method $this progressDot(mixed $progressDot = false) 点状步骤条，可以设置为一个 作用域插槽,labelPlacement 将强制为vertical       Boolean or v-slot:progressDot="{index, status, title, description, prefixCls, iconDot}"
 * @method $this percent(int $percent) 当前 process 步骤显示的进度条进度（只对基本类型的 Steps 生效）                         		number
 * @method $this responsive(bool $responsive = true) 当屏幕宽度小于 532px 时自动变为垂直模式                                        boolean
 * @method $this size(string $size = 'default') 指定大小，目前支持普通（default）和迷你（small）                                    string
 * @method $this status(string $status = 'process') 指定当前步骤的状态，可选 wait process finish error                             string
 * @method $this initial(int $initial = 0) 起始序号，从 0 开始记数                                                        		number
 * @package ExAdmin\ui\component\form\field
 */
class Steps extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'progressDot',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ASteps';

	
}