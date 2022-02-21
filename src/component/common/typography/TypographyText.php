<?php

namespace ExAdmin\ui\component\common\typography;

use ExAdmin\ui\component\Component;

/**
 * 排版 - 文本
 * Class TypographyText
 * @link   https://next.antdv.com/components/typography-cn 排版组件
 * @link   https://next.antdv.com/components/typography-cn#copyable copyable
 * @link   https://next.antdv.com/components/typography-cn#editable editable
 * @method $this code(bool $code = false) 添加代码样式													                boolean
 * @method $this copyable(bool $block = false) 是否可拷贝，为对象时可进行各种自定义											boolean | copyable
 * @method $this delete(bool $delete = false) 添加删除线样式													            boolean
 * @method $this disabled(bool $disabled = false) 禁用文本													            boolean
 * @method $this editable(mixed $editable = false) 是否可编辑，为对象时可对编辑进行控制										boolean | editable
 * @method $this ellipsis(bool $ellipsis = false) 自动溢出省略，为对象时可设置省略行数、是否可展开、添加后缀等					boolean
 * @method $this keyboard(bool $keyboard = false) 添加键盘样式					                                        boolean
 * @method $this mark(bool $mark = false) 添加标记样式													                boolean
 * @method $this strong(bool $strong = false) 是否加粗													                boolean
 * @method $this type(string $type) 文本类型													                            secondary | success | warning | danger
 * @method $this underline(bool $underline = false) 添加下划线样式													    boolean
 * @method $this content(string $value) 当使用 ellipsis 或 editable 时，使用 content 代替 children							string
 */
class TypographyText extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATypographyText';

	
}