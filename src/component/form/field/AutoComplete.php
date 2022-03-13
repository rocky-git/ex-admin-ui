<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 自动完成
 * Class AutoComplete
 * @link   https://next.antdv.com/components/auto-complete-cn 自动完成组件
 * @method $this allowClear(bool $focus = false) 支持清除, 单选模式有效                                                    boolean
 * @method $this autofocus(bool $focus = false) 自动获取焦点                                                                boolean
 * @method $this backfill(bool $fill = false) 使用键盘选择选项的时候把选中项回填到输入框中                                    boolean
 * @method $this defaultActiveFirstOption(bool $active = true) 是否默认高亮第一个选项。                                    boolean
 * @method $this disabled(bool $loading = false) 是否禁用                                                                boolean
 * @method $this dropdownMatchSelectWidth(mixed $match = true) 下拉菜单和选择器同宽。默认将设置 min-width，当值小于选
 *                                                                    择框宽度时会被忽略。false 时会关闭虚拟滚动              boolean | number
 * @method $this filterOption(mixed $filter = true) 是否根据输入项进行筛选。当其为一个函数时，会接收 inputValue option
 *                                                    两个参数，当 option 符合筛选条件时，应返回 true，反之则返回 false。       boolean or function(inputValue, option)
 * @method $this placeholder(string $placeholder) 输入框提示                                                                string | slot
 * @method $this value(mixed $value) 指定当前选中的条目                                                                    string|string[]|{
 * key: string, label: string|vNodes
 * }|Array<{
 * key: string, label: string|vNodes
 * }>
 * @method $this defaultOpen(bool $open) 是否默认展开下拉菜单                                                                boolean
 * @method $this open(bool $open) 是否展开下拉菜单                                                                        boolean
 * @package ExAdmin\ui\component\form\field
 */
class AutoComplete extends Field
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'placeholder',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'AAutoComplete';

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
     * 选项
     * @param array $data
     * @return $this
     */
    public function options(array $data)
    {
        $this->optionsClosure = function () use ($data) {
            $options = [];
            foreach ($data as $key => $value) {
                $options[] = [
                    'value' => $key,
                    'label' => $value,
                    'disabled' => in_array($key, $this->disabledValue) ? true : false,
                ];
            }
            $this->attr('options', $options);
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
            foreach ($data as $key => &$option) {
                $option['label'] = $option[$label];
                $option['value'] = $option[$id];
                $option['disabled'] = in_array($option[$id], $this->disabledValue) ? true : false;
                $option['options'] = $option[$name] ?? [];
                foreach ($option['options'] as &$item) {
                    $item['label'] = $item[$label];
                    $item['value'] = $item[$id];
                    $item['disabled'] = in_array($item[$id], $this->disabledValue) ? true : false;
                }
            }
            $this->attr('options', $data);
        };
        return $this;
    }

    public function jsonSerialize()
    {
        $this->optionsClosure->bindTo($this);
        call_user_func($this->optionsClosure);
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
