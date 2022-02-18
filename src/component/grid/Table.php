<?php

namespace component\grid;

/**
 * 表格
 * Class Table
 * @link    https://next.antdv.com/components/table-cn 气泡卡片组件
 * @method $this bordered(bool $bordered = false) 是否展示外边框和列边框                                        								boolean
 * @method $this columns(array $columns) 表格列的配置描述，具体项见下表                                        									array
 * @method $this components(mixed $components) 覆盖默认的 table 元素                                        									object
 * @method $this childrenColumnName(string $childrenColumnName = 'children') 指定树形结构的列名                           					string
 * @method $this dataSource(mixed $dataSource) 数据数组                                        												object[]
 * @method $this defaultExpandAllRows(bool $defaultExpandAllRows = false) 初始时，是否展开所有行                          						boolean
 * @method $this defaultExpandedRowKeys(mixed $defaultExpandedRowKeys) 默认展开的行                                      					string[]
 * @method $this expandedRowKeys(mixed $expandedRowKeys) 展开的行，控制属性                                        							string[]
 * @method $this expandFixed(mixed $expandFixed = false) 控制展开图标是否固定，可选 true left right                        					boolean | string
 * @method $this expandRowByClick(mixed $expandRowByClick = false) 通过点击行来展开子行                                   					boolean
 * @method $this expandIconColumnIndex(int $expandIconColumnIndex) 自定义展开按钮的列顺序，-1 时不展示                      					number
 * @method $this loading(mixed $loading = false) 页面是否加载中                                       										boolean|object
 * @method $this locale(mixed $locale) 默认文案设置，目前包括排序、过滤、空数据文案                                        						object
 * @method $this pagination(mixed $pagination) 分页器，参考配置项或 pagination文档，设为 false 时不展示和进行分页             					object
 * @method $this rowKey(mixed $rowKey = 'key') 	表格行 key 的取值，可以是字符串或一个函数                                   					string|Function(record):string
 * @method $this rowSelection(mixed $rowSelection = null) 列表项是否可选择，配置项                                       						object
 * @method $this scroll(mixed $scroll) 表格是否可滚动，也可以指定滚动区域的宽、高，配置项                                     					object
 * @method $this showHeader(bool $showHeader = true) 是否显示表头                                        									boolean
 * @method $this showSorterTooltip(mixed $showSorterTooltip) 表头是否显示下一次排序的 tooltip 提示。当参数类型为对象时，将被设置为 Tooltip 的属性  	boolean | Tooltip props
 * @method $this size(string $size = 'default') 表格大小                                        												default | middle | small
 * @method $this sortDirections(array $sortDirections = ['ascend', 'descend']) 支持的排序方式，取值为 ascend descend       					Array
 * @method $this sticky(mixed $sticky) 设置粘性头部和滚动条                                        											boolean | {offsetHeader?: number, offsetScroll?: number, getContainer?: () => HTMLElement}	-
 * @method $this tableLayout(mixed $tableLayout) 表格元素的 table-layout 属性，设为 fixed 表示内容不会影响列的布局           					- | 'auto' | 'fixed'
 * @method $this indentSize(int $indentSize = 15) 展示树形数据时，每层缩进的宽度，以 px 为单位                              	 					number
 * @method $this headerCell(mixed $headerCell) 个性化头部单元格                                        										v-slot:headerCell="{title, column}"
 * @method $this bodyCell(mixed $bodyCell) 个性化单元格                                        												v-slot:bodyCell="{text, record, index, column}"
 * @method $this customFilterDropdown(mixed $customFilterDropdown) 	自定义筛选菜单，需要配合 column.customFilterDropdown 使用 					v-slot:customFilterDropdown="FilterDropdownProps"                                        									string|slot|VNode
 * @method $this customFilterIcon(mixed $customFilterIcon) 自定义筛选图标                                        								v-slot:customFilterIcon="{filtered, column}"	-
 * @method $this emptyText(mixed $emptyText) 自定义空数据时的显示内容                                        									v-slot:emptyText
 * @method $this summary(mixed $summary) 总结栏                                       														v-slot:summary
 * @package component\form\field
 */
class Table
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATable';

	public static function create()
	{
		return new self();
	}
}