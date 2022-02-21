<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;

/**
 * 自动完成
 * Class AutoComplete
 * @link   https://next.antdv.com/components/auto-complete-cn 自动完成组件
 * @method $this allowClear(bool $focus = false) 支持清除, 单选模式有效													boolean
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this backfill(bool $fill = false) 使用键盘选择选项的时候把选中项回填到输入框中									boolean
 * @method $this defaultActiveFirstOption(bool $active = true) 是否默认高亮第一个选项。									boolean
 * @method $this disabled(bool $loading = false) 是否禁用																boolean
 * @method $this dropdownMatchSelectWidth(mixed $match = true) 下拉菜单和选择器同宽。默认将设置 min-width，当值小于选
 * 																	择框宽度时会被忽略。false 时会关闭虚拟滚动              boolean | number
 * @method $this filterOption(mixed $filter = true) 是否根据输入项进行筛选。当其为一个函数时，会接收 inputValue option
* 													两个参数，当 option 符合筛选条件时，应返回 true，反之则返回 false。       boolean or function(inputValue, option)
 * @method $this placeholder(string $placeholder) 输入框提示																string | slot
 * @method $this value(mixed $value) 指定当前选中的条目																	string|string[]|{ key: string, label: string|vNodes }|Array<{ key: string, label: string|vNodes }>
 * @method $this defaultOpen(bool $open) 是否默认展开下拉菜单																boolean
 * @method $this open(bool $open) 是否展开下拉菜单																		boolean
 * @package ExAdmin\ui\component\form\field
 */
class AutoComplete extends Component
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

	
}