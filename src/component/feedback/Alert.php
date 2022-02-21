<?php

namespace ExAdmin\ui\component\feedback;

use ExAdmin\ui\component\Component;

/**
 * 警告提示
 * Class Alert
 * @link    https://next.antdv.com/components/alert-cn 警告提示组件
 * @method $this banner(bool $banner = false) 是否用作顶部公告                                       						boolean
 * @method $this closable(bool $closable) 默认不显示关闭按钮                                        						boolean
 * @method $this closeText(mixed $closeText) 自定义关闭按钮                                 								string|slot
 * @method $this description(mixed $description) 警告提示的辅助性文字介绍                                        			string|slot
 * @method $this icon(mixed $icon) 自定义图标，showIcon 为 true 时有效                                        			vnode|slot
 * @method $this message(mixed $message) 警告提示内容                                       								string|slot
 * @method $this showIcon(bool $showIcon) 是否显示辅助图标                                        						boolean
 * @method $this type(string $type) 指定警告提示的样式，有四种选择 success、info、warning、error                             string
 * @package ExAdmin\ui\component\form\field
 */
class Alert extends Component
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'closeText',
        'description',
        'icon',
        'message',
    ];
    
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'closeText',
        'description',
        'message',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'AAlert';

	
}