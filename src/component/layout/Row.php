<?php

namespace ExAdmin\ui\component\layout;

use ExAdmin\ui\component\Component;

/**
 * 行
 * Class Row
 * @link   https://next.antdv.com/components/grid-cn 行组件
 * @method $this align(bool $align = 'top') flex 布局下的垂直对齐方式：top middle bottom									string
 * @method $this gutter(mixed $gutter = 0) 栅格间隔，可以写成像素值或支持响应式的对象写法来设置水平间隔 { xs: 8, sm: 16, md: 24}。
 *                              或者使用数组形式同时设置 [水平间距, 垂直间距]（1.5.0 后支持）。									number/object/array
 * @method $this justify(string $justify = 'start') flex 布局下的水平排列方式：
 *                                                      start end center space-around space-between	                    string
 * @method $this wrap(bool $warp = false) 是否自动换行														            boolean
 * @package ExAdmin\ui\component\form\field
 */
class Row extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ARow';
    
    /**
     * 添加列
     * @param mixed $content 内容
     * @param int $span 栅格占据的列数,占满一行24,默认24
     * @return Column
     */
    public function column($content,int $span = 24){
        $column = Col::create();
        $column->span($span);
        if($content instanceof \Closure){
            call_user_func($content,$column);
        }else{
            $column->content($content);
        }
        $this->content($column);
        return $column;
    }
	
}
