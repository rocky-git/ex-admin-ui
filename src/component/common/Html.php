<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-20
 * Time: 20:41
 */

namespace ExAdmin\ui\component\common;


use ExAdmin\ui\component\Component;

/**
 * @method static $this create($content = '') 创建
 * @method static Html div() div标签
 */
class Html extends Component
{
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'html';

    public function __construct($content = '')
    {
        parent::__construct();
        $this->tag('span');
        if (!empty($content) || is_numeric($content)) {
            $this->content($content);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if ($name == 'div') {
            $self = new static();
            $self->tag($name);
            return $self;
        }
        return parent::__callStatic($name, $arguments);
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

    public static function code($content, $lang = 'php')
    {
        return self::div()->directive('prism', $content, ['lang' => $lang])->attr('class','language-'.$lang);
    }
}
