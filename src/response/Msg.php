<?php

namespace ExAdmin\ui\response;


use ExAdmin\ui\support\Container;

/**
 * Message 响应提示
 * @method $this success(string $message) 成功
 * @method $this error(string $message) 失败
 * @method $this info(string $message) 信息
 * @method $this warning(string $message) 警告
 * @method $this loading(string $message) 加载中
 */
class Msg extends Message
{
    use MessageTrait;
    protected $response = [
        'code' => 80020,
    ];
    protected $data = [
        'type' => 'success',
        'duration' => 3,
        'content' => '',
        'url' => ''
    ];

    public function __call($name, $arguments)
    {
        $this->data['type'] = $name;
        $this->data['content'] = $arguments[0];
        return $this;
    }
}
