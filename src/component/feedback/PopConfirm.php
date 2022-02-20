<?php

namespace ExAdmin\ui\component\feedback;

/**
 * 气泡提醒框
 * Class PopConfirm
 * @link    https://next.antdv.com/components/popconfirm-cn 气泡提醒框组件
 * @method $this cancelText(mixed $cancelText) 取消按钮文字                                       						string|slot
 * @method $this cancelButton(mixed $cancelButton) 完全自定义取消按钮                                       				slot
 * @method $this okText(mixed $okText) 确认按钮文字                                        								string|slot
 * @method $this okButton(mixed $okButton) 完全自定义确认按钮                                        						slot
 * @method $this okType(string $okType = 'primary') 确认按钮类型                                        					string
 * @method $this title(mixed $title) 确认框的描述                                        								string|slot
 * @method $this visible(bool $visible) 是否显示                                        									boolean
 * @method $this disabled(bool $disabled) 点击 Popconfirm 子元素是否弹出气泡确认框                                        	boolean
 * @method $this arrowPointAtCenter(bool $arrowPointAtCenter = false) 箭头是否指向目标元素中心                             boolean
 * @method $this autoAdjustOverflow(bool $autoAdjustOverflow = true) 气泡被遮挡时自动调整位置                              boolean
 * @method $this color(string $color) 背景颜色                                        									string
 * @method $this defaultVisible(bool $defaultVisible = false) 默认是否显隐                                        		boolean
 * @method $this mouseEnterDelay(int $mouseEnterDelay = 0.1) 鼠标移入后延时多少才显示 Tooltip，单位：秒                     number
 * @method $this mouseLeaveDelay(int $mouseLeaveDelay = 0.1) 鼠标移出后延时多少才隐藏 Tooltip，单位：秒                     number
 * @method $this overlayClassName(string $overlayClassName) 卡片类名                                        				string
 * @method $this overlayStyle(mixed $overlayStyle) 卡片样式                                        						object
 * @method $this placement(string $placement = 'top') 气泡框位置，可选 top left right bottom topLeft topRight
 * 														bottomLeft bottomRight leftTop leftBottom rightTop rightBottom  string
 * @method $this trigger(string $trigger = 'hover') 触发行为，可选 hover/focus/click/contextmenu                          string
 * @method $this destroyTooltipOnHide(bool $destroyTooltipOnHide = false) 隐藏后是否销毁 tooltip                          boolean
 * @method $this align(mixed $align) 该值将合并到 placement 的配置中，设置参考 dom-align                                    Object
 * @package ExAdmin\ui\component\form\field
 */
class PopConfirm
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'APopconfirm';

	public static function create()
	{
		return new self();
	}
}