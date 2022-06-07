<?php

namespace ExAdmin\ui\component\layout;

use ExAdmin\ui\component\Component;

/**
 * 分割线
 * Class Divider
 * @link   https://next.antdv.com/components/divider-cn 分割线组件
 * @method $this dashed(bool $dashed = false) 是否虚线															        boolean
 * @method $this orientation(string $orientation = 'center') 分割线标题的位置												string
 * @method $this type(string $type = 'horizontal') 水平还是垂直类型														string
 * @method $this plain(bool $plain = false) 文字是否显示为普通正文样式														boolean
 * @method static $this create($content = '') 创建
 */
class Divider extends Component
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ADivider';

	public function __construct($content='')
    {
        parent::__construct();
        if (!empty($content) || is_numeric($content)) {
            $this->content($content);
        }
    }
}