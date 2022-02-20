<?php

namespace ExAdmin\ui\component\feedback;

use ExAdmin\ui\component\Component;

/**
 * 对话框
 * Class Modal
 * @link    https://next.antdv.com/components/modal-cn 对话框组件
 * @method $this bodyStyle(mixed $bodyStyle = true) 	Modal body 样式                                    				object
 * @method $this cancelText(mixed $cancelText = '取消') 对话框外层容器的类名                                      			string| slot
 * @method $this centered(bool $centered = false) 垂直居中展示 Modal                                 					boolean
 * @method $this closable(mixed $closable = true) 是否显示右上角的关闭按钮                                      			boolean
 * @method $this closeIcon(mixed $closeIcon = false) 自定义关闭图标                                						VNode | slot
 * @method $this confirmLoading(bool $confirmLoading) 确定按钮 loading                                       			boolean
 * @method $this destroyOnClose(bool $destroyOnClose = false) 关闭时销毁 Modal 里的子元素                                  boolean
 * @method $this footer(mixed $footer = '确定取消按钮') 底部内容，当不需要默认底部按钮时，可以设为 :footer="null"         		string|slot
 * @method $this forceRender(bool $forceRender = false) 强制渲染 Modal                             						boolean
 * @method $this keyboard(bool $keyboard = true) 是否支持键盘 esc 关闭                             						boolean
 * @method $this mask(bool $mask = true) 是否展示遮罩                             										boolean
 * @method $this maskClosable(bool $maskClosable = true) 点击蒙层是否允许关闭                             				boolean
 * @method $this maskStyle(mixed $maskStyle) 遮罩样式                             										object
 * @method $this okText(mixed $okText = "确定") 确认按钮文字                            									string|slot
 * @method $this okType(string $okType = 'primary') 确认按钮类型                       									string
 * @method $this title(mixed $title) 标题                             													string | slot
 * @method $this visible(bool $visible) 对话框是否可见                             										boolean
 * @method $this width(mixed $width = 520) 宽度                             											string | number
 * @method $this wrapClassName(string $wrapClassName) 对话框外层容器的类名                            					string
 * @method $this zIndex(int $zIndex = 1000) 设置 Modal 的 z-index                            					 		Number
 * @method $this dialogStyle(mixed $dialogStyle) 可用于设置浮层的样式，调整浮层位置等                            			object
 * @method $this dialogClass(string $dialogClass) 可用于设置浮层的类名                            					 	string
 * @package ExAdmin\ui\component\form\field
 */
class Modal extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AModal';

	public static function create()
	{
		return new self();
	}
}