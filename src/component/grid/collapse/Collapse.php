<?php

namespace ExAdmin\ui\component\grid\collapse;

use ExAdmin\ui\component\Component;

/**
 * 折叠面板
 * Class Collapse
 * @link    https://next.antdv.com/components/collapse-cn 折叠面板组件
 * @method $this activeKey(mixed $activeKey) 当前激活 tab 面板的 key                                                        string[]|string
 * @method $this bordered(bool $bordered = true) 带边框风格的折叠面板                                                    boolean
 * @method $this collapsible(mixed $collapsible) 所有子面板是否可折叠或指定可折叠触发区域                                    header | disabled
 * @method $this accordion(bool $accordion = false) 手风琴模式                                                            boolean
 * @method $this expandIcon(mixed $expandIcon) 自定义切换图标                                                                Function(props):VNode | slot = "expandIcon" slot-scope = "props"|#expandIcon="props"
 * @method $this expandIconPosition(string $expandIconPosition = 'left') 设置图标位置： left, right                       left
 * @method $this ghost(bool $ghost = false) 使折叠面板透明且无边框                                                        boolean
 * @method $this destroyInactivePanel(bool $destroyInactivePanel = false) 销毁折叠隐藏的面板                              boolean
 * @package ExAdmin\ui\component\form\field
 */
class Collapse extends Component
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'expandIcon',
    ];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ACollapse';

    protected $key = 0;

    /**
     * 添加一个子项
     * @param mixed $header 折叠面板标题
     * @param mixed $content 折叠面板内容
     * @param bool $showArrow 是否显示箭头
     * @param string|int $key 对应 activeKey
     * @return CollapsePanel
     */
    public function item($header, $content, bool $showArrow = true, $key = '')
    {
        if (empty($key)) {
            $key = ++$this->key;
        }
        $item = new CollapsePanel();
        $item->header($header)
             ->content($content)
             ->showArrow($showArrow)
             ->key($key);
        $this->content($item);
        return $item;
    }

    /**
     * 添加子项(数组)
     * @param array $dataSource 数据源
     * @param string $headerField 折叠面板标题
     * @param string $contentField 折叠面板内容
     * @param string $keyField 折叠面板key
     * @return $this
     */
    public function options(array $dataSource, string $headerField = 'title', string $contentField = 'content', $keyField = 'key')
    {
        $options = [];
        foreach ($dataSource as $value) {
            if (!empty($value[$keyField])) {
                $key = $value[$keyField];
            } else {
                $key = ++$this->key;
            }
            $options[] = [
                'header'      => $value[$headerField],
                'slotDefault' => $value[$contentField],
                'key'         => $key,
            ];
        }
        $item = CollapsePanel::create()
                             ->map($options)
                             ->mapAttr('header')
                             ->mapAttr('key')
                             ->mapAttr('slotDefault');
        $this->content($item);
        return $this;
    }
}
