<?php

namespace ExAdmin\ui\component\common\typography;

/**
 * 排版 - 标题
 * Class TypographyTitle
 * @link   https://next.antdv.com/components/typography-cn 排版组件
 * @link   https://next.antdv.com/components/typography-cn#copyable copyable
 * @link   https://next.antdv.com/components/typography-cn#editable editable
 * @link   https://next.antdv.com/components/typography-cn#ellipsis ellipsis
 * @method $this code(bool $code = false) 添加代码样式													                boolean
 * @method $this copyable(bool $block = false) 是否可拷贝，为对象时可进行各种自定义											boolean | copyable
 * @method $this delete(bool $delete = false) 添加删除线样式													            boolean
 * @method $this disabled(bool $disabled = false) 禁用文本													            boolean
 * @method $this editable(mixed $editable = false) 是否可编辑，为对象时可对编辑进行控制										boolean | editable
 * @method $this ellipsis(mixed $ellipsis = false) 自动溢出省略，为对象时可设置省略行数、是否可展开、添加后缀等					boolean | ellipsis
 * @method $this level(int $num = 1) 重要程度，相当于 h1、h2、h3、h4、h5													number : 1, 2, 3, 4, 5
 * @method $this mark(bool $mark = false) 添加标记样式													                boolean
 * @method $this type(string $type) 文本类型													                            secondary | success | warning | danger
 * @method $this underline(bool $underline = false) 添加下划线样式													    boolean
 * @method $this content(string $value) 当使用 ellipsis 或 editable 时，使用 content 代替 children							string
 */
class TypographyTitle
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATypographyTitle';

	public static function create()
	{
		return new self();
	}
}