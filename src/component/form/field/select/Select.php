<?php

namespace ExAdmin\ui\component\form\field\select;

use ExAdmin\ui\component\Component;

/**
 * 选择器
 * Class Select
 * @link   https://next.antdv.com/components/select-cn 选择器组件
 * @method $this allowClear(bool $clear = false) 支持清除																boolean
 * @method $this autoClearSearchValue(bool $search = true) 是否在选中项后清空搜索框，只在 mode 为 multiple 或 tags 时有效。	boolean
 * @method $this autofocus(bool $focus = false) 默认获取焦点																boolean
 * @method $this bordered(bool $bordered = true) 是否有边框																boolean
 * @method $this defaultActiveFirstOption(bool $active = true) 是否默认高亮第一个选项。									boolean
 * @method $this disabled(bool $disabled = false) 是否禁用																boolean
 * @method $this dropdownClassName(string $name) 下拉菜单的 className 属性												string
 * @method $this dropdownMatchSelectWidth(mixed $match = true) 下拉菜单和选择器同宽。默认将设置 min-width，
 * 																当值小于选择框宽度时会被忽略。false 时会关闭虚拟滚动          boolean | number
 * @method $this dropdownStyle(mixed $style) 下拉菜单的 style 属性														object
 * @method $this dropdownMenuStyle(mixed $style) dropdown 菜单自定义样式													object
 * @method $this filterOption(mixed $filter = true) 是否根据输入项进行筛选。当其为一个函数时，会接收 inputValue option
 * 											两个参数，当 option 符合筛选条件时，应返回 true，反之则返回 false。               boolean or function(inputValue, option)
 * @method $this firstActiveValue(mixed $active) 默认高亮的选项															string|string[]
 * @method $this labelInValue(bool $labelValue = false) 是否把每个选项的 label 包装到 value 中，会把 Select 的 value 类型从
 * 													     string 变为 {key: string, label: vNodes} 的格式                 boolean
 * @method $this maxTagCount(int $num) 最多显示多少个 tag																	number
 * @method $this maxTagTextLength(int $length) 最大显示的 tag 文本长度													number
 * @method $this mode(string $mode) 设置 Select 的模式为多选或标签															'multiple' | 'tags' | 'combobox'
 * @method $this notFoundContent(mixed $content = 'Not Found') 当下拉列表为空时显示的内容									string|slot
 * @method $this optionFilterProp(string $value) 搜索时过滤对应的 option 属性，不支持 children								string
 * @method $this optionLabelProp(string $label) 回填到选择框的 Option 的属性值，默认是 Option 的子元素。比如在子元素
 * 														需要高亮效果时，此值可以设为 value。                                string  children | label(设置 options 时)
 * @method $this placeholder(string $placeholder) 选择框默认文字															string|slot
 * @method $this showSearch(bool $search = false) 使单选模式可搜索														boolean
 * @method $this showArrow(bool $show = true) 是否显示下拉小箭头															boolean
 * @method $this size(string $size = 'default') 选择框大小，可选 large small default										string
 * @method $this tokenSeparators(array $separators) 在 tags 和 multiple 模式下自动分词的分隔符								string[]
 * @method $this value(mixed $value) 指定当前选中的条目																	string|string[]|number|number[]
 * @method $this defaultOpen(bool $open) 是否默认展开下拉菜单																boolean
 * @method $this open(bool $open) 是否展开下拉菜单																		boolean
 * @package ExAdmin\ui\component\form\field
 */
class Select extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ASelect';

	
}