<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\support\Arr;

/**
 * 级联选择
 * Class Cascade
 * @link   https://next.antdv.com/components/cascader-cn 级联组件
 * @method $this allowClear(bool $clear = true) 是否支持清除                                                            boolean
 * @method $this autofocus(bool $focus = true) 自动获取焦点                                                                boolean
 * @method $this bordered(bool $bordered = true) 是否有边框                                                              boolean
 * @method $this clearIcon(mixed $clearIcon) 自定义的选择框清空图标                                                           slot
 * @method $this changeOnSelect(bool $change = true) 当此项为 true 时，点选每级菜单选项值都会发生变化，具体见上面的演示        boolean
 * @method $this defaultValue(mixed $value = [])    默认的选中项                                                            string[] | number[]
 * @method $this disabled(bool $disabled = true) 禁用                                                                    boolean
 * @method $this expandTrigger(string $trigger = 'click') 次级菜单的展开方式，可选 'click' 和 'hover'                        string
 * @method $this fieldNames(mixed $content = "{ label: 'label', value: 'value', children: 'children' }") 自定义 options 中 label name children 的字段                                  object
 * @method $this notFoundContent(mixed $content = 'Not Found') 当下拉列表为空时显示的内容                                    boolean | string | number
 * @method $this placeholder(string $placeholder = '请选择') 输入框占位文本                                                string
 * @method $this showSearch(mixed $show = true) 在选择框中显示搜索框                                                        boolean | object
 * @method $this size(mixed $size = 'default') 输入框大小，可选 large default small                                        string
 * @method $this suffixIcon(mixed $suffix) 自定义的选择框后缀图标                                                            string | VNode | slot
 * @method $this value(mixed $value) 指定选中项                                                                            string[] | number[]
 * @method $this expandIcon(mixed $value = true) 自定义次级菜单展开图标                                                    slot
 * @method $this maxTagCount(mixed $num) 最多显示多少个 tag，响应式模式会对性能产生损耗                                        number | responsive
 * @method $this maxTagPlaceholder(mixed $maxTagPlaceholder) 隐藏 tag 时显示的内容
 * @method $this dropdownClassName(string $name) 自定义浮层类名                                                            string
 * @method $this open(bool $show) 控制浮层显隐                                                                            boolean
 * @method $this placement(string $placement = 'bottomLeft') 浮层预设位置：bottomLeft bottomRight topLeft topRight        string
 * @method $this removeIcon(mixed $removeIcon) 自定义的多选框清除图标                                                      slot
 * @method $this searchValue(mixed $value) 设置搜索的值，需要与 showSearch 配合使用                                        string
 * @method $this tagRender(mixed $tagRender) 自定义 tag 内容，多选时生效                                                    slot
 * @package ExAdmin\ui\component\form\field
 */
trait CascadeTrait
{
    use OptionsClosure;
    
    public function __construct($field = null, $value = [])
    {
        parent::__construct(null, $value);
        $this->allowClear();
        $this->attr('fields', $field);
        $this->expandTrigger('hover');
      
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
     * 设置选项
     * @param mixed $data 数据源
     * @param string $label 名称
     * @param string $id 主键
     * @param string $pid 上级id
     * @param string $children 下级成员
     */
    public function options($data, string $label = 'name', string $id = 'id', string $pid = 'pid', string $children = 'children')
    {
        $this->optionsClosure = function () use ($data,$label,$id,$pid,$children) {
            $disabled = false;
            foreach ($data as &$row){
                $row['disabled'] = false;
                if (in_array($row[$id], $this->disabledValue)) {
                    $row['disabled'] = true;
                }
            }
            $treeData = Arr::tree($data, $id, $pid, $children);
            $this->fieldNames([
                'children' => $children,
                'label' => $label,
                'value' => $id,
            ]);
            $this->attr('options', $treeData);
        };
        return $this;
    }
}
