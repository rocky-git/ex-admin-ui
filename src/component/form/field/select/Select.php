<?php

namespace ExAdmin\ui\component\form\field\select;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 选择器
 * Class Select
 * @link   https://next.antdv.com/components/select-cn 选择器组件
 * @method $this allowClear(bool $clear = false) 支持清除                                                                boolean
 * @method $this autoClearSearchValue(bool $search = true) 是否在选中项后清空搜索框，只在 mode 为 multiple 或 tags 时有效。    boolean
 * @method $this autofocus(bool $focus = false) 默认获取焦点                                                                boolean
 * @method $this bordered(bool $bordered = true) 是否有边框                                                                boolean
 * @method $this defaultActiveFirstOption(bool $active = true) 是否默认高亮第一个选项。                                    boolean
 * @method $this disabled(bool $disabled = false) 是否禁用                                                                boolean
 * @method $this dropdownClassName(string $name) 下拉菜单的 className 属性                                                string
 * @method $this dropdownMatchSelectWidth(mixed $match = true) 下拉菜单和选择器同宽。默认将设置 min-width，
 *                                                                当值小于选择框宽度时会被忽略。false 时会关闭虚拟滚动          boolean | number
 * @method $this dropdownStyle(mixed $style) 下拉菜单的 style 属性                                                        object
 * @method $this dropdownMenuStyle(mixed $style) dropdown 菜单自定义样式                                                    object
 * @method $this filterOption(mixed $filter = true) 是否根据输入项进行筛选。当其为一个函数时，会接收 inputValue option
 *                                            两个参数，当 option 符合筛选条件时，应返回 true，反之则返回 false。               boolean or function(inputValue, option)
 * @method $this firstActiveValue(mixed $active) 默认高亮的选项                                                            string|string[]
 * @method $this labelInValue(bool $labelValue = false) 是否把每个选项的 label 包装到 value 中，会把 Select 的 value 类型从
 *                                                         string 变为 {key: string, label: vNodes} 的格式                 boolean
 * @method $this maxTagCount(int $num) 最多显示多少个 tag                                                                    number
 * @method $this maxTagTextLength(int $length) 最大显示的 tag 文本长度                                                    number
 * @method $this mode(string $mode) 设置 Select 的模式为多选或标签                                                            'multiple' | 'tags' | 'combobox'
 * @method $this notFoundContent(mixed $content = 'Not Found') 当下拉列表为空时显示的内容                                    string|slot
 * @method $this optionFilterProp(string $value) 搜索时过滤对应的 option 属性，不支持 children                                string
 * @method $this optionLabelProp(string $label) 回填到选择框的 Option 的属性值，默认是 Option 的子元素。比如在子元素
 *                                                        需要高亮效果时，此值可以设为 value。                                string  children | label(设置 options 时)
 * @method $this placeholder(string $placeholder) 选择框默认文字                                                            string|slot
 * @method $this showSearch(bool $search = false) 使单选模式可搜索                                                        boolean
 * @method $this showArrow(bool $show = true) 是否显示下拉小箭头                                                            boolean
 * @method $this size(string $size = 'default') 选择框大小，可选 large small default                                        string
 * @method $this tokenSeparators(array $separators) 在 tags 和 multiple 模式下自动分词的分隔符                                string[]
 * @method $this value(mixed $value) 指定当前选中的条目                                                                    string|string[]|number|number[]
 * @method $this defaultOpen(bool $open) 是否默认展开下拉菜单                                                                boolean
 * @method $this open(bool $open) 是否展开下拉菜单                                                                        boolean
 * @package ExAdmin\ui\component\form\field
 */
class Select extends Field
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'notFoundContent',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ASelect';

    /**
     * 禁用的选项
     * @var array
     */
    protected $disabledValue = [];

    protected $optionsClosure = null;

    public function __construct($field = null, $value = '')
    {
        parent::__construct($field, $value);
        $this->allowClear();
        $this->filterOption();
    }

    /**
     * 多选
     * @return $this
     */
    public function multiple()
    {
        $this->value = [];
        $value = $this->getbindAttrValue('value');
        if (!is_array($value)) {
            $field = $this->bindAttr('value');
            $this->bind($field, $this->value);
        }
        $this->modelValue();
        return $this->mode('multiple');
    }

    /**
     * 禁用选项
     * @param array $data
     * @return $this
     */
    public function disabledValue(array $data)
    {
        $this->disabledValue = $data;
        return $this;
    }

    /**
     * 设置选项数据
     * @param array $data 选项数据 $data = [1 => '第一个选项', 2 => '第二个选项'];
     * @return Select
     */
    public function options(array $data)
    {
        $this->optionsClosure = function () use ($data) {
            $options = [];
            foreach ($data as $id => $title) {
                $disabled = false;
                if (in_array($id, $this->disabledValue)) {
                    $disabled = true;
                }
                $options[] = [
                    'value' => $id,
                    'title' => $title,
                    'disabled' => $disabled,
                    'slotDefault' => $title,
                ];
            }

            $selectOption = SelectOption::create()
                ->map($options)
                ->mapAttr('value')
                ->mapAttr('title')
                ->mapAttr('disabled')
                ->mapAttr('slotDefault');
            $this->content($selectOption);
        };
        return $this;
    }

    /**
     * 分组下拉框
     * @param array $data 数组源
     * @param string $name 关联的字段
     * @param string $label 名称的字段
     * @param string $id 主键的字段
     * @return $this
     */
    public function groupOptions(array $data, $name = 'options', $label = 'label', $id = 'id')
    {
        /* 格式
         $data = [
            [
                'label' => '第一个分组',
                'id' => 2,
                'options' => [
                    [
                        'label' => '第一个标签',
                        'id' => 1
                    ]
                ]
            ],
            [
                'label' => '第二个分组',
                'id' => 2,
                'options' => [
                    [
                        'label' => '第二个标签',
                        'id' => 2
                    ]
                ]
            ]
         ];
        */
        $this->optionsClosure = function () use ($data, $name, $label, $id) {
            foreach ($data as $key => $option) {
                $disabled = false;
                if (in_array($option[$id], $this->disabledValue)) {
                    $disabled = true;
                }
                $selectGroup = SelectGroup::create()
                    ->attr('label', $option[$label])
                    ->attr('slotDefault', $option[$label])
                    ->attr('disabled', $disabled);
                foreach ($option[$name] as $item) {
                    $disabled = false;
                    if (in_array($item[$id], $this->disabledValue)) {
                        $disabled = true;
                    }
                    $selectGroup->content(
                        SelectOption::create()
                            ->attr('title', $item[$label])
                            ->attr('slotDefault', $item[$label])
                            ->attr('disabled', $disabled)
                            ->attr('value', $item[$id])
                    );
                }
                $this->content($selectGroup);
            }
        };
        return $this;
    }

    /**
     * 下拉框选项（标签模式-可创建选项）
     * @param array $data
     * @param string[] $tokenSeparators
     * @return $this
     */
    public function tagOptions(array $data, array $tokenSeparators = [',', '，'])
    {
        $this->options($data);
        $this->tokenSeparators($tokenSeparators);
        $this->mode('tags');
        return $this;
    }

    public function jsonSerialize()
    {
        $this->optionsClosure->bindTo($this);
        call_user_func($this->optionsClosure);
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
