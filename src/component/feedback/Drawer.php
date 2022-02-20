<?php

namespace ExAdmin\ui\component\feedback;

use ExAdmin\ui\component\Component;

/**
 * 警告提示
 * Class Drawer
 * @link    https://next.antdv.com/components/drawer-cn 警告提示组件
 * @method $this autofocus(bool $autofocus = true) 抽屉展开后是否将焦点切换至其 Dom 节点                                    boolean
 * @method $this class(string $class) 对话框外层容器的类名                                      							string
 * @method $this closable(bool $closable = true) 是否显示右上角的关闭按钮                                 					boolean
 * @method $this closeIcon(mixed $closeIcon) 自定义关闭图标                                      							VNode | slot
 * @method $this destroyOnClose(mixed $destroyOnClose = false) 关闭时销毁 Drawer 里的子元素                                boolean
 * @method $this drawerStyle(mixed $drawerStyle) 用于设置 Drawer 弹出层的样式                                       		object
 * @method $this extra(mixed $extra) 抽屉右上角的操作区域                                        							VNode | slot
 * @method $this footer(mixed $footer) 抽屉的页脚                             											VNode | slot
 * @method $this forceRender(bool $forceRender = false) 预渲染 Drawer 内元素                             				boolean
 * @method $this height(mixed $height = 378) 	高度, 在 placement 为 top 或 bottom 时使用                             	string | number
 * @method $this keyboard(bool $keyboard = true) 是否支持键盘 esc 关闭                             								boolean
 * @method $this mask(bool $mask = true) 是否展示遮罩                             										boolean
 * @method $this maskClosable(bool $maskClosable = true) 点击蒙层是否允许关闭                             				boolean
 * @method $this placement(string $placement = 'right') 抽屉的方向                             							'top' | 'right' | 'bottom' | 'left'
 * @method $this push(mixed $push = "{ distance: 180 }") 用于设置多层 Drawer 的推动行为                            		boolean | {distance: string | number}
 * @method $this size(string $size = 'default') 预设抽屉宽度（或高度），default 378px 和 large 736px                       default | large
 * @method $this title(string $title) 标题                             													string | slot
 * @method $this visible(bool $visible) 	Drawer 是否可见                             									boolean
 * @method $this width(mixed $width = 378) 宽度                             											string | number
 * @method $this zIndex(string $zIndex = 1000) 设置 Drawer 的 z-index                            					 	Number
 * @package ExAdmin\ui\component\form\field
 */
class Drawer extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ADrawer';

	public static function create()
	{
		return new self();
	}
}