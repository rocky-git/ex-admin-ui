<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 评分
 * Class Rate
 * @link   https://next.antdv.com/components/rate-cn 评分组件
 * @method $this allowClear(bool $clear = true) 是否允许再次点击后清除														boolean
 * @method $this allowHalf(bool $half = true) 是否允许半选																boolean
 * @method $this autofocus(bool $focus = true) 自动获取焦点																boolean
 * @method $this character(mixed $character) 自定义字符																	String or slot="character"
 * @method $this count(int $num = 5) star 总数																			number
 * @method $this disabled(bool $disabled = true) 只读，无法进行交互														boolean
 * @method $this tooltips(array $tip = []) 自定义每项的提示信息															string[]
 * @method $this value(int $value) 当前数，受控值																			number
 * @package ExAdmin\ui\component\form\field
 */
class Rate extends Field
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'character',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ARate';
	public function __construct($field = null, $value = '')
    {
        $this->allowClear();
        parent::__construct($field, $value);
    }
}
