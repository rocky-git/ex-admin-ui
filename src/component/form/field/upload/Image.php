<?php

namespace ExAdmin\ui\component\form\field\upload;
/**
 * 图片上传组件
 * @method $this imageWidth(int $value) 图片框宽度
 * @method $this imageHeight(int $value) 图片框高度
 */
class Image extends File
{
    public function __construct($field = null, $value = '')
    {
        parent::__construct($field, $value);
        $this->type('image')
            ->size(80,80)
           ->input(false)
            ;
    }

    /**
     * 上传图片框尺寸
     * @param int $width 宽度
     * @param int $height 高度
     * @return $this
     */
    public function size(int $width,int $height)
    {
        $this->imageWidth($width);
        $this->imageHeight($height);
        return $this;
    }
}
