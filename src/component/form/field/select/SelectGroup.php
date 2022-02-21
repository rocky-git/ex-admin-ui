<?php

namespace ExAdmin\ui\component\form\field\select;

use ExAdmin\ui\component\Component;

/**
 * 选择器 - 选项分组
 * Class SelectGroup
 * @link   https://next.antdv.com/components/select-cn 选择器组件
 * @method $this key(string $key)																						string
 * @method $this label(mixed $label) 组名																				string||function(h)|slot
 * @package ExAdmin\ui\component\form\field
 */
class SelectGroup extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'label',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ASelectOptGroup';

	
}