<?php

namespace ExAdmin\ui\component\form\field\input;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 文本域
 * Class TextArea
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @link    https://developer.mozilla.org/zh-CN/docs/Web/HTML/Element/input#%E5%B1%9E%E6%80%A7 MDN
 * @method $this autoSize(mixed $size = false) 自适应内容高度，可设置为 true | false 或对象：{ minRows: 2, maxRows: 6 }		boolean|object
 * @method $this showCount(bool $is_show = false) 是否展示字数															boolean
 * @package ExAdmin\ui\component\form\field
 */
class TextArea extends Input
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ATextarea';

    /**
     * 设置行数
     * @param int $minRows 最小行数
     * @param int $maxRows 最大行数
     */
    public function rows(int $minRows = 3, int $maxRows = 6)
    {
        $this->autoSize(['minRows' => $minRows, 'maxRows' => $maxRows]);
        return $this;
    }

}
