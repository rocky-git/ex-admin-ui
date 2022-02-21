<?php

namespace ExAdmin\ui\component\layout\layout;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\layout\Row;

/**
 * 布局容器
 * Class Layout
 * @link   https://next.antdv.com/components/layout-cn 布局容器组件
 * @method $this class(bool $class) 容器 class									                                        string
 * @method $this style(mixed $style) 指定样式                                                                            object
 * @method $this hasSider(bool $hasSider) 表示子元素里有 Sider，一般不用指定。可用于服务端渲染时避免样式闪动				        boolean
 * @package ExAdmin\ui\component\form\field
 */
class Layout extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ALayout';

    /**
     * 添加一行
     * @param mixed $content 内容
     * @param int $span 栅格占据的列数,默认24
     * @return Row
     */
    public function row($content, $span = 24)
    {
        $row = Row::create();
        if ($content instanceof \Closure) {
            call_user_func($content, $row);
        } else {
            $row->column($content, $span);
        }
        $this->content($row);
        return $row;
    }
}
