<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\support\Arr;

/**
 * 树选择
 * Class TreeSelect
 * @link   https://next.antdv.com/components/tree-select-cn 树选择组件
 * @method $this allowClear(bool $clear = true) 显示清除按钮                                                                boolean
 * @method $this defaultValue(mixed $value) 指定默认选中的条目                                                                string|string[]
 * @method $this disabled(bool $disabled = true) 是否禁用                                                                boolean
 * @method $this dropdownClassName(string $name) 下拉菜单的 className 属性                                                string
 * @method $this dropdownMatchSelectWidth(mixed $match = true) 下拉菜单和选择器同宽。默认将设置 min-width，当值小于选择框
 *                                                                宽度时会被忽略。true 时会关闭虚拟滚动                       boolean | number
 * @method $this dropdownStyle(mixed $style) 下拉菜单的样式                                                                object
 * @method $this labelInValue(bool $in = true) 是否把每个选项的 label 包装到 value 中，会把 value
 * 类型从 string 变为 {value: string, label: VNode, halfChecked(treeCheckStrictly 时有效): string[] } 的格式               boolean
 * @method $this maxTagCount(int $num) 最多显示多少个 tag                                                                    number
 * @method $this multiple(bool $clear = true) 支持多选（当设置 treeCheckable 时自动变为 true）                                boolean
 * @method $this placeholder(mixed $placeholder) 选择框默认文字                                                            string|slot
 * @method $this searchPlaceholder(mixed $placeholder) 搜索框默认文字                                                        string|slot
 * @method $this searchValue(string $value) 搜索框的值，可以通过 search 事件获取用户输入                                        string
 * @method $this treeIcon(bool $icon = true) 是否展示 TreeNode title 前的图标，没有默认样式，如设置为 true，
 *                                            需要自行定义图标相关样式                                                        boolean
 * @method $this showCheckedStrategy(string $showCheckedStrategy) 定义选中项回填的方式。
 * TreeSelect.SHOW_ALL: 显示所有选中节点(包括父节点).
 * TreeSelect.SHOW_PARENT: 只显示父节点(当父节点下所有子节点都选中时). 默认只显示子节点.                                            enum{TreeSelect.SHOW_ALL, TreeSelect.SHOW_PARENT, TreeSelect.SHOW_CHILD }
 * @method $this showSearch(bool $show = true) 在下拉中显示搜索框(仅在单选模式下生效）                                        boolean
 * @method $this size(string $size = 'default') 选择框大小，可选 large small                                                string
 * @method $this treeCheckable(bool $check = true) 显示 checkbox                                                        boolean
 * @method $this treeCheckStrictly(bool $strict = true) checkable 状态下节点选择完全受控（父子节点选中状态不再关联）
 *                                            ，会使得 labelInValue 强制为 true                                             boolean
 * @method $this treeData(mixed $data = []) treeNodes 数据，如果设置则不需要手动构造 TreeNode 节点（value 在整个树范围内唯一）    array<{
 * value, label, children, [disabled, disableCheckbox, selectable]
 * }>
 * @method $this replaceFields(mixed $field = "{children:'children', label:'title', key:'key', value: 'value' }")
 *                                                替换 treeNode 中 title,value,key,children 字段为 treeData 中对应的字段      object
 * @method $this fieldNames(mixed $names = "{children:'children', label:'title', key:'key', value: 'value' }")
 *                                        替换 treeNode 中 title,value,key,children 字段为 treeData 中对应的字段              object
 * @method $this treeDataSimpleMode(mixed $mode = true) 使用简单格式的 treeData，具体设置参考可设置的类型
 * (此时 treeData 应变为这样的数据结构: [{id:1, pId:0, value:'1', label:"test1",...},...], pId 是父节点的 id)                 true|Array<{ id: string, pId: string, rootPId: null }>
 * @method $this treeDefaultExpandAll(mixed $default) 默认展开所有树节点                                                    boolean
 * @method $this treeDefaultExpandedKeys(mixed $default) 默认展开的树节点                                                    string[] | number[]
 * @method $this treeExpandedKeys(bool $clear = true) 设置展开的树节点                                                    string[] | number[]
 * @method $this treeLine(mixed $line = true) 是否展示线条样式，请参考 Tree - showLine                                        boolean | object
 * @method $this treeNodeFilterProp(string $prop = 'value') 输入项过滤对应的 treeNode 属性                                    string
 * @method $this treeNodeLabelProp(string $prop = 'title') 作为显示的 prop 设置                                            string
 * @method $this value(mixed $value) 指定当前选中的条目                                                                    string|string[]
 * @method $this title(mixed $title) 自定义标题                                                                            slot
 * @package ExAdmin\ui\component\form\field
 */
class TreeSelect extends Field
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'placeholder',
        'searchPlaceholder',
        'title',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ATreeSelect';

    public function __construct($field = null, $value = '')
    {
        $this->allowClear();
        $this->treeDefaultExpandAll(true);
        parent::__construct($field, $value);
    }

    /**
     * 设置选项
     * @param mixed $data 数据源
     * @param string $label 名称
     * @param string $id 主键
     * @param string $pid 上级id
     * @param string $children 下级成员
     */
    public function options($data, string $label = 'name', string $id = 'id', string $pid = 'pid', string $children = 'children')
    {
        $treeData = Arr::tree($data, $id, $pid, $children);
        $this->fieldNames([
            'children' => $children,
            'label'    => $label,
            'key'      => $id,
            'value'    => $id
        ]);
        $this->treeData($treeData);
        return $this;
    }
}
