<?php

namespace component\form\field;

/**
 * 级联选择
 * Class Cascader
 * @link   https://next.antdv.com/components/cascader-cn 级联组件
 * @method $this allowClear(bool $clear = false) 是否支持清除															boolean
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this changeOnSelect(bool $change = false) 当此项为 true 时，点选每级菜单选项值都会发生变化，具体见上面的演示		boolean
 * @method $this defaultValue(mixed $value = []) 	默认的选中项															string[] | number[]
 * @method $this disabled(bool $disabled = false) 禁用											 						boolean
 * @method $this expandTrigger(string $trigger = 'click') 次级菜单的展开方式，可选 'click' 和 'hover'						string
 * @method $this fieldNames(mixed $content = "{ label: 'label', value: 'value', children: 'children' }")
 * 											自定义 options 中 label name children 的字段                                  object
 * @method $this notFoundContent(mixed $content = 'Not Found') 当下拉列表为空时显示的内容									boolean | string | number
 * @method $this options(mixed $value) 可选项数据源
 * @method $this placeholder(string $placeholder = '请选择') 输入框占位文本												string
 * @method $this showSearch(mixed $show = false) 在选择框中显示搜索框														boolean | object
 * @method $this size(mixed $size = 'default') 输入框大小，可选 large default small										string
 * @method $this suffixIcon(mixed $suffix) 自定义的选择框后缀图标															string | VNode | slot
 * @method $this value(mixed $value) 指定选中项																			string[] | number[]
 * @method $this expandIcon(mixed $value = false) 自定义次级菜单展开图标													slot
 * @method $this maxTagCount(mixed $num) 最多显示多少个 tag，响应式模式会对性能产生损耗										number | responsive
 * @method $this dropdownClassName(string $name) 自定义浮层类名															string
 * @method $this open(bool $show) 控制浮层显隐																			boolean
 * @method $this placement(string $placement = 'bottomLeft') 浮层预设位置：bottomLeft bottomRight topLeft topRight		string
 * @method $this multiple(mixed $multiple) 支持多选节点																	boolean
 * @method $this searchValue(mixed $value) 设置搜索的值，需要与 showSearch 配合使用										string
 * @package component\form\field
 */
class Cascader
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACascader';

	public static function create()
	{
		return new self();
	}
}