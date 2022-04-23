<?php

namespace ExAdmin\ui\component\form\field\mentions;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 提及
 * Class Mentions
 * @link    https://next.antdv.com/components/mentions-cn 提及组件
 * @method $this autofocus(bool $focus = true) 自动获得焦点                                                                boolean
 * @method $this defaultValue(string $value) 默认值                                                                        boolean
 * @method $this placement(string $placement = 'bottom') 弹出层展示位置                                                    top | bottom
 * @method $this prefix(mixed $prefix = '@') 设置触发关键字                                                                string | string[]
 * @method $this split(string $split = ' ') 设置选中项前后分隔符                                                            string
 * @method $this value(string $value) 设置值                                                                                string
 * @package ExAdmin\ui\component\form\field
 */
class Mentions extends Field
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'closeText',
        'description',
        'message',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'AMentions';

    /**
     * 设置选项
     * @param array $data 数据源 $data = ['张三丰', '张三', 1111]；
     * @param string $placement top | bottom
     *
     */
    public function options(array $data, string $placement = 'bottom')
    {
        $options = [];
        foreach ($data as $value) {
            $options[] = [
                'value' => strval($value),
            ];
        }
        $mentionOption = MentionsOption::create()
                                       ->map($options)
                                       ->mapAttr('value');
        $this->placement($placement);
        $this->content($mentionOption);
        return $this;
    }
}
