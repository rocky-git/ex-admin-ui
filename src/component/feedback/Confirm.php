<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-03
 * Time: 22:10
 */

namespace ExAdmin\ui\component\feedback;


use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;

/**
 * Class Confirm
 * @method $this title(string $value) 标题
 * @method $this width(int $value) 宽度
 * @method $this icon(string $value) 图标
 * @method $this url(string $value) ajax请求url
 * @method $this method(string $value) ajax请求method get / post /put / delete
 * @method $this params(array $value) 提交ajax参数
 * @method $this gridRefresh(bool $value = true) 成功刷新grid表格 
 * @package ExAdmin\ui\component\feedback
 */
class Confirm extends Component
{
    protected $component;
    public function __construct($component)
    {
        $this->component = Html::create($component);
        parent::__construct();
    }

    /**
     * 内容
     * @param mixed $content
     * @param string $name
     * @return Component|Confirm|mixed
     */
    public function content($content, $name = 'default')
    {
       return $this->attr('content',$content);
    }
    public function jsonSerialize()
    {
        $this->component->directive('confirm',$this->attribute,[
            'url'=>$this->attr('url'),
            'data'=>$this->attr('params'),
            'method'=>$this->attr('method')
        ]);
        return $this->component;
    }
}
