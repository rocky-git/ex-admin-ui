<?php

namespace ExAdmin\ui\component\navigation\menu;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\feedback\Confirm;

/**
 * 菜单
 * Class MenuItem
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this disabled(bool $disabled = true) 是否禁用                                boolean
 * @method $this key(string $key) item 的唯一标志                                        string
 * @method $this title(mixed $title) 设置收缩时展示的悬浮标题                                string | slot
 * @method $this icon(mixed $icon) 菜单图标                                            slot
 * @package ExAdmin\ui\component\form\field
 */
class MenuItem extends Component
{
    /**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'title',
        'icon',
    ];
    protected $type=1;
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'AMenuItem';

    protected $menu = null;

    public function __construct($menu = null,$type=1)
    {
        $this->type = $type;
        if ($menu) {
            $this->menu = $menu;
        }
        parent::__construct();
    }

    public function modal($url = '', $params = [], $method = 'POST')
    {
        $modal = parent::modal($url, $params, $method); // TODO: Change the autogenerated stub
        return $this->replace($modal);
    }

    public function drawer($url = '', $params = [], $method = 'POST')
    {
        $drawer = parent::drawer($url, $params, $method); // TODO: Change the autogenerated stub
        return $this->replace($drawer);

    }
    protected function replace($component){
        if ($this->menu) {
            if($this->type == 1){
                array_pop($this->menu->content['default']);
            }else{
                array_shift($this->menu->content['default']);
            }
            $this->menu->content($component);
        }
        return $component;
    }
    /**
     * 确认消息框
     * @param string|array|Component $message 确认内容
     * @param string $url 请求url 空不请求
     * @param array $params 请求参数
     * @return Confirm
     */
    public function confirm($message, $url = '', array $params = [], $method = 'POST')
    {
        $confirm = parent::confirm($message, $url, $params, $method); // TODO: Change the autogenerated stub
        if ($this->menu) {
            array_pop($this->menu->content['default']);
            $this->menu->content($confirm);
        }
        return $confirm;
    }
    public function ajax($url, array $params = [], string $method = 'POST')
    {
        $ajax = parent::ajax($url, $params, $method); // TODO: Change the autogenerated stub
        if ($this->menu) {
            array_pop($this->menu->content['default']);
            $this->menu->content($ajax);
        }
        return $ajax;
    }
}
