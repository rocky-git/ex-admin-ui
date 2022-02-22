<?php

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\component\form\field\dateTimePicker\DatePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\DateTimePicker;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\InputNumber;
use ExAdmin\ui\component\form\field\input\Password;
use ExAdmin\ui\component\form\field\input\TextArea;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\form\field\select\Select;
use ExAdmin\ui\component\form\field\Slider;
use ExAdmin\ui\component\form\field\Transfer;
use ExAdmin\ui\component\form\field\TreeSelect;

/**
 * @method Input text(string $field, string $label = '') 文本输入框
 * @method InputNumber number(string $field, string $label = '') 数字输入框
 * @method Password password(string $field, string $label = '') 密码输入框
 * @method TextArea textarea(string $field, string $label = '') 文本域输入框
 * @method Rate rate(string $field, string $label = '') 评分
 * @method Slider slider(string $field, string $label = '') 滑动输入条
 * @method Transfer transfer(string $field, string $label = '') 穿梭框
 * @method Select select(string $field, string $label = '') 下拉选择框
 * @method TreeSelect tree(string $field, string $label = '') 树形选择框
 * @method DatePicker date(string $field, string $label = '') 日期选择框
 * @method DateTimePicker datetime(string $field, string $label = '') 日期时间选择框
 */
trait FormComponent
{
    protected $formComponent = [
        'text' => Input::class,
        'number' => InputNumber::class,
        'password' => Password::class,
        'textarea' => TextArea::class,
        'rate' => Rate::class,
        'slider' => Slider::class,
        'transfer' => Transfer::class,
        'tree' => TreeSelect::class,
        'select' => Select::class,
        'date' => DatePicker::class,
        'datetime' => DateTimePicker::class,
    ];
}
