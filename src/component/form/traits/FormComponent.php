<?php

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\InputNumber;
use ExAdmin\ui\component\form\field\input\Password;
use ExAdmin\ui\component\form\field\input\TextArea;

/**
 * @method Input text($field, $label = '') 文本输入框
 * @method InputNumber number($field, $label = '') 数字输入框
 * @method Password password($field, $label = '') 密码输入框
 * @method TextArea textarea($field, $label = '') 文本域输入框
 */
trait FormComponent
{
    protected $formComponent = [
        'text'     => Input::class,
        'number'   => InputNumber::class,
        'password' => Password::class,
        'textarea' => TextArea::class,
    ];
}
