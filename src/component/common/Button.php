<?php

namespace ExAdmin\ui\component\common;

use ExAdmin\ui\component\Component;

/**
 * 按钮
 * Class Button
 * @link   https://next.antdv.com/components/button-cn 按钮组件
 * @link   https://developer.mozilla.org/en-US/docs/Web/HTML/Element/button#attr-type HTML标准
 * @method $this block(bool $block = false) 将按钮宽度调整为其父宽度的选项													boolean
 * @method $this danger(bool $danger = false) 设置危险按钮														        boolean
 * @method $this disabled(bool $disabled = false) 按钮失效状态														    boolean
 * @method $this ghost(bool $ghost = false) 幽灵属性，使按钮背景透明														boolean
 * @method $this href(string $href) 点击跳转的地址，指定此属性 button 的行为和 a 链接一致										string
 * @method $this htmlType(string $type = 'button') 设置 button 原生的 type 值，可选值请参考 HTML 标准						string
 * @method $this icon(mixed $icon) 设置按钮的图标类型														                v-slot
 * @method $this loading(mixed $loading = false) 设置按钮载入状态														    boolean | { delay: number }
 * @method $this shape(string $shape) 设置按钮形状														                circle | round
 * @method $this size(string $size = 'middle') 设置按钮大小														        large | middle | small
 * @method $this target(string $target = '') 相当于 a 链接的 target 属性，href 存在时生效									boolean
 * @method $this type(string $type = 'default') 设置按钮类型														        primary | ghost | dashed | link | text | default
 * @package ExAdmin\ui\component\form\field
 */
class Button extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AButton';

	
}