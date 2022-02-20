<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-20
 * Time: 20:41
 */

namespace ExAdmin\ui\component\common;


use ExAdmin\ui\component\Component;

class Html extends Component
{
    protected $name = 'html';

    public function __construct($content = '')
    {
        parent::__construct();
        $this->tag('span');
        if (!empty($content) || is_numeric($content)) {
            $this->content($content);
        }
    }
    /**
     * 自定义元素标签
     * @param string $tag 元素标签
     */
    public function tag($tag)
    {
        $this->attr('data-tag', $tag);
        return $this;
    }
}