<?php

namespace ExAdmin\ui\component\form\field\radio;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Field;

/**
 * 单选框 - 按钮组
 * Class RadioGroup
 * @link    https://next.antdv.com/components/radio-cn 单选框组件
 * @method $this buttonStyle(string $style = 'outline') RadioButton 的风格样式，目前有描边和填色两种风格					outline | solid
 * @method $this disabled(bool $disabled = false) 禁选所有子单选器														boolean
 * @method $this name(string $name) RadioGroup 下所有 input[type="radio"] 的 name 属性									string
 * @method $this size(string $size = 'default') 大小，只对按钮样式生效														large | default | small
 * @package ExAdmin\ui\component\form\field
 */
class RadioGroup extends Field
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ARadioGroup';

    /**
     * 单选框类型
     * @var bool
     */
    protected $buttonType = false;

    protected $options = [];
    /**
     * 设置选项
     * @param array $data 数据源 [key => value] 的形式
     * @param array $disabledArr 禁选的id
     * @param bool $buttonType false 默认 true 按钮
     * @return $this
     */
    public function options(array $data, $disabledArr = [], bool $buttonType = false)
    {
        $this->buttonType = $buttonType;

        foreach($data as $id => $value) {
            $disabled = false;
            if (in_array($id, $disabledArr)) {
                $disabled = true;
            }
            $this->options[] = [
                'value' => $id,
                'label' => $value,
                'disabled' => $disabled,
                'slotDefault' => $value,
            ];
        }
        $radioOption = $this->getButton()
            ->map($this->options)
            ->mapAttr('value')
            ->mapAttr('disabled')
            ->mapAttr('slotDefault');
        $this->content($radioOption);
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    /**
     * 获取按钮类型 radio 默认单选 RadioButton 单选按钮
     * @return Radio|RadioButton
     */
    protected function getButton()
    {
        if ($this->buttonType) {
            $button = RadioButton::create();
        } else {
            $button = Radio::create();
        }
        return $button;
    }
}
