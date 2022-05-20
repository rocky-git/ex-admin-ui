<?php

namespace ExAdmin\ui\component\layout;

use ExAdmin\ui\component\Component;

/**
 * 间距
 * Class Space
 * @link   https://next.antdv.com/components/layout-cn 间距组件
 * @method $this align(string $align) 对齐方式							                                                start | end |center |baseline
 * @method $this direction(string $direction = 'horizontal') 间距方向                                                    vertical | horizontal
 * @method $this size(mixed $size = 'small') 间距大小				                                                    small | middle | large | number
 * @method static $this create($content = '') 创建
 * @package ExAdmin\ui\component\form\field
 */
class Space extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ASpace';

    public function __construct($content = '')
    {
        parent::__construct();
        if (!empty($content) || is_numeric($content)) {
            $this->content($content);
        }
    }
}