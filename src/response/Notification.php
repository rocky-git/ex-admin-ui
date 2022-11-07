<?php

namespace ExAdmin\ui\response;

use ExAdmin\ui\support\Container;

/**
 * Message 响应提示
 * @method $this success(string $message, string $description) 成功
 * @method $this error(string $message, string $description) 失败
 * @method $this info(string $message, string $description) 信息
 * @method $this warning(string $message, string $description) 警告
 */
class Notification extends Message
{
    use MessageTrait;
    protected $response = [
        'code' => 80010,
    ];
    protected $data = [
        'placement' => 'topRight',
        'type' => 'success',
        'message' => '',
        'description' => '',
        'url' => ''
    ];

    public function __call($name, $arguments)
    {
        $this->data['type'] = $name;
        $this->data['message'] = $arguments[0];
        $this->data['description'] = $arguments[1];
        return $this;
    }
}
