<?php

namespace ExAdmin\ui\component\form\field;

use ExAdmin\ui\component\form\Field;

/**
 * 富文本
 * @method $this height(int $value) 高度
 * @method $this width(int $value) 宽度
 * @method $this options(array $value) tinymce配置选项
 * @method $this tags(array $value) 设置标记元素
 * @method $this toolbar(string $value) 工具栏 undo redo | styleselect | bold italic |alignleft | aligncenter | alignright | bullist | numlist | outdent | indent | removeformat | subscript | superscript | fontsize_formats | cut | copy | paste | forecolor
 */
class Editor extends Field
{
    protected $name = 'ExTinymceEditor';
    /**
     * textarea模式
     * @param int $height 高度
     * @return $this
     */
    public function textarea($height = 150)
    {
        $this->height($height);
        $this->options([
            'menubar' => false,
            'toolbar' => false,
            'statusbar' => false,
        ]);
        return $this;
    }
}
