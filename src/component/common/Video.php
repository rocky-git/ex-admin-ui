<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2021-02-15
 * Time: 13:34
 */

namespace ExAdmin\ui\component\common;



use ExAdmin\ui\component\Component;

/**
 * Class Video
 * @link https://v2.h5player.bytedance.com/en/config
 * @package ExAdmin\ui\component\common
 */
class Video extends Component
{
    protected $options = [];
    protected $name = 'ExVideo';
   
    /**
     * 视频链接
     * @param string $url  视频链接
     * @return $this
     */
    public function url($url)
    {
        $this->options['url'] = $url;
        return $this;
    }

    /**
     * 设置视频尺寸
     * @param int|string $width 宽度
     * @param int|string $height 高度
     * @return $this
     */
    public function size($width, $height)
    {

        $this->options['width']  = $width;
        $this->options['height'] = $height;
        return $this;
    }

    public function jsonSerialize()
    {
        $this->attr('options', $this->options);
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}