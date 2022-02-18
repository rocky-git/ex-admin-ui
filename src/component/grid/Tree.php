<?php

namespace component\grid;

/**
 * 文字提醒
 * Class Tree
 * @link    https://next.antdv.com/components/tooltip-cn 气泡卡片组件
 * @method $this blockNode(bool $blockNode = false) 是否节点占据一行                                        							boolean
 * @method $this treeData(mixed $treeData) treeNodes 数据，如果设置则不需要手动构造 TreeNode 节点（key 在整个树范围内唯一）    			TreeNode[]
 * @method $this fieldNames(mixed $fieldNames) 替换 treeNode 中 title,key,children 字段为 treeData 中对应的字段           				object
 * @method $this autoExpandParent(bool $autoExpandParent = true) 是否自动展开父节点                                        			boolean
 * @method $this checkable(bool $checkable = false) 节点前添加 Checkbox 复选框                                       					boolean
 * @method $this checkedKeys(mixed $checkedKeys = []) （受控）选中复选框的树节点（注意：父子节点有关联，如果传入父节点 key，
 * 则子节点自动选中；相应当子节点 key 都传入，父节点也自动选中。当设置checkable和checkStrictly，它是一个
 * 有checked和halfChecked属性的对象，并且父子节点的选中与否不再关联                    													string[] | number[] | {checked: string[] | number[], halfChecked: string[] | number[]}
 * @method $this checkStrictly(bool $checkStrictly = false) checkable 状态下节点选择完全受控（父子节点选中状态不再关联）       			boolean
 * @method $this defaultExpandAll(bool $defaultExpandAll = false) 默认展开所有树节点, 如果是异步数据，需要在数据返回后再实例化
 * 									，建议用 v-if="data.length"；当有 expandedKeys 时，defaultExpandAll 将失效             			boolean
 * @method $this disabled(bool $disabled = false) 	将树禁用                                        									boolean
 * @method $this draggable(bool $draggable = false) 设置节点可拖拽																	boolean
 * @method $this expandedKeys(array $expandedKeys = []) =（受控）展开指定的树节点                          							string[] | number[]
 * @method $this loadedKeys(array $loadedKeys = []) （受控）已经加载的节点，需要配合 loadData 使用                           			string[] | number[]
 * @method $this multiple(bool $multiple = false) 支持点选多个节点（节点本身）                          								boolean
 * @method $this selectable(bool $selectable = true) 是否可选中                                    									boolean
 * @method $this selectedKeys(array $selectedKeys) （受控）设置选中的树节点                                    						string[] | number[]
 * @method $this showIcon(bool $showIcon = false) 是否展示 TreeNode title 前的图标，没有默认样式，如设置为 true，需要自行定义图标相关样式	boolean
 * @method $this switcherIcon(mixed $switcherIcon) 自定义树节点的展开/折叠图标                                   						slot
 * @method $this showLine(mixed $showLine = false) 是否展示连接线                                   									boolean | {showLeafIcon: boolean}(3.0+)
 * @method $this title(mixed $title) 自定义标题                                    													slot
 * @package component\form\field
 */
class Tree
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ATree';

	public static function create()
	{
		return new self();
	}
}