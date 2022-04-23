<?php

namespace ExAdmin\ui\component\common\typography;

use ExAdmin\ui\component\Component;

/**
 * 按钮
 * Class TypographyParagraph
 * @link   https://next.antdv.com/components/typography-cn 排版组件
 * @link   https://next.antdv.com/components/typography-cn#copyable copyable
 * @link   https://next.antdv.com/components/typography-cn#editable editable
 * @link   https://next.antdv.com/components/typography-cn#ellipsis ellipsis
 * @method $this code(bool $code = true) 添加代码样式													                boolean
 * @method $this copyable(bool $block = true) 是否可拷贝，为对象时可进行各种自定义											boolean | copyable
 * @method $this delete(bool $delete = true) 添加删除线样式													            boolean
 * @method $this disabled(bool $disabled = true) 禁用文本													            boolean
 * @method $this editable(mixed $editable = true) 是否可编辑，为对象时可对编辑进行控制										boolean | editable
 * @method $this ellipsis(mixed $ellipsis = true) 自动溢出省略，为对象时可设置省略行数、是否可展开、添加后缀等					boolean | ellipsis
 * @method $this mark(bool $mark = true) 添加标记样式													                boolean
 * @method $this strong(bool $strong = true) 是否加粗													                boolean
 * @method $this type(string $type) 文本类型													                            secondary | success | warning | danger
 * @method $this underline(bool $underline = true) 添加下划线样式													    boolean
 * @method $this content(string $value) 当使用 ellipsis 或 editable 时，使用 content 代替 children							string
 */
class TypographyParagraph extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATypographyParagraph';

	
}