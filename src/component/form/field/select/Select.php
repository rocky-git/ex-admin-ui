<?php

namespace ExAdmin\ui\component\form\field\select;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;
use ExAdmin\ui\component\form\field\CallbackDefinition;
use ExAdmin\ui\component\form\field\OptionsClosure;
use ExAdmin\ui\component\form\FormItem;


/**
 * 选择器
 * Class Select
 * @link   https://next.antdv.com/components/select-cn 选择器组件
 * @method $this allowClear(bool $clear = true) 支持清除                                                                boolean
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
 * @method $this clearIcon(mixed $clearIcon) 自定义的多选框清空图标                                                        VNode | slot
 * @method $this menuItemSelectedIcon(mixed $menuItemSelectedIcon) 自定义当前选中的条目图标                                 VNode | slot
 * @method $this removeIcon(mixed $removeIcon) 自定义的多选框清除图标                                                       VNode | slot
 * @method $this suffixIcon(mixed $suffixIcon) 自定义的选择框后缀图标                                                       VNode | slot
 * @package ExAdmin\ui\component\form\field
 */
class Select extends Field
{
   use CallbackDefinition,OptionsClosure;
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'notFoundContent',
        'clearIcon',
        'menuItemSelectedIcon',
        'removeIcon',
        'suffixIcon',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ExSelect';

    /**
     * 禁用的选项
     * @var array
     */
    protected $disabledValue = [];



    public function __construct($field = null, $value = null)
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
        $this->modelValueArray();
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
        $this->bindOptionsField();
        $this->optionsClosure = function () use ($data) {

            foreach ($data as $id => $title) {
                $disabled = false;
                if (in_array($id, $this->disabledValue)) {
                    $disabled = true;
                }
                $this->options[] = [
                    'value' => $id,
                    'label' => $title,
                    'disabled' => $disabled,
                    'slotDefault' => $title,
                ];
            }
            $selectOption = SelectOption::create()
                ->map($this->options,$this->optionsBindField)
                ->mapAttr('value')
                ->mapAttr('title','label')
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
    
    /**
     * 联动select options
     * @param Select $component select组件
     * @param string|\Closure $callback options闭包回调或者url
     * @return $this
     */
    public function load(Field $component, $callback){
        $callbackField = '';
        $url = $this->formItem->form()->attr('url');
        if($callback instanceof \Closure){
            $callbackField = $this->setCallback($callback,function ($data){
                $options = [];
                foreach ($data as $key => $value) {
                    $options[] = [
                        'value' => $key,
                        'label' => $value
                    ];
                }
                return $options;
            }); 
        }
       
        $field = $component->vModel('options',null,[],false);
        $this->form->except($field);
        $params  = [
            'url' => $url,
            'data' => [
                'ex_admin_form_action'=>'changeLoadOptions',
                'ex_admin_callback_field'=>$callbackField,
                'optionsField'=>$field,
            ],
            'method' => 'POST',
        ];
        if($this->attr('changeLoadOptions')){
            $changeLoadOptions = $this->attr('changeLoadOptions');
            array_push($changeLoadOptions,$params);
            $this->attr('changeLoadOptions',$changeLoadOptions);
        }else{
            $this->attr('changeLoadOptions',[$params]);
        }
        $this->eventCustom('change','ChangeLoadOptions',$params);
        return $this;
    }

    /**
     * 远程加载options
     * @param string|\Closure $callback 闭包回调或者url
     */
    public function remoteOptions($callback){
        $callbackField = '';
        $url = $this->formItem->form()->attr('url');
        if($callback instanceof \Closure){
            $callbackField = $this->setCallback($callback,function ($data){
                $options = [];
                foreach ($data as $key => $value) {
                    $options[] = [
                        'value' => $key,
                        'label' => $value
                    ];
                }
                return $options;
            });
        }else{
            $url = $callback;
        }
        $field = $this->vModel('options',null,[],true);
        $this->form->except($field);
        $params  = [
            'url' => $url,
            'data' => [
                'ex_admin_form_action'=>'remoteOptions',
                'ex_admin_callback_field'=> $callbackField,
                'optionsField'=> $field,
            ],
            'method' => 'POST',
        ];

        $this->attr('remote',$params);
        $this->filterOption(false);
        $this->showSearch();
        return $this;
    }
}
