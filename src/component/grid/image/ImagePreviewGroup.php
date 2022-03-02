<?php

namespace ExAdmin\ui\component\grid\image;

use ExAdmin\ui\component\Component;

/**
 * 图片
 * Class ImagePreviewGroup
 * @link    https://next.antdv.com/components/image-cn 图片组件
 * @package ExAdmin\ui\component\form\field
 */
class ImagePreviewGroup extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'AImagePreviewGroup';
    
    public function __construct($content)
    {
        parent::__construct();
        $this->content($content);
    }
}
