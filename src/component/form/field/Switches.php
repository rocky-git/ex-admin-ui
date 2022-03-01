<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 开关
 * Class Switches
 * @link   https://next.antdv.com/components/switch-cn 开关组件
 * @method $this autofocus(bool $focus = false) 组件自动获取焦点                                                            boolean
 * @method $this checked(bool $checked = false) 指定当前是否选中                                                            checkedValue | unCheckedValue
 * @method $this disabled(bool $disabled = false) 是否禁用                                                                boolean
 * @method $this loading(bool $loading = false) 加载中的开关                                                                boolean
 * @method $this size(bool $size = 'default') 开关大小，可选值：default small                                                string
 * @method $this checkedChildren(mixed $content) 选中时的内容                                                            string|slot
 * @method $this unCheckedChildren(mixed $content) 非选中时的内容                                                            string|slot
 * @method $this checkedValue(mixed $value = true) 选中时的值                                                            boolean | string | number
 * @method $this unCheckedValue(mixed $value = false) 非选中时的值                                                        boolean | string | number
 * @package ExAdmin\ui\component\form\field
 */
class Switches extends Field
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'checkedChildren',
        'unCheckedChildren',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ASwitch';

    protected $vModel = 'checked';

    public function __construct($field = null, $value = false)
    {
        $this->vModel($this->vModel, null, $value);
        $this->options();
        parent::__construct($field, $value);
    }

    /**
     * 设置选项
     * @param string[] $data 数据源 $data = [[1 => '显示'], [0 => '隐藏']];
     * @return $this
     */
    public function options($data = [[1 => ''], [0 => '']])
    {
        list($on, $off) = $data;
        $this->checkedChildren(current($on));
        $this->checkedValue(key($on));
        $this->unCheckedChildren(current($off));
        $this->unCheckedValue(key($off));
        return $this;
    }
}
