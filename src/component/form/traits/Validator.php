<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-26
 * Time: 00:27
 */

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\support\Str;

/**
 * Trait Validator
 * @package ExAdmin\ui\component\form\traits
 * @method $this ruleEmail() 邮箱验证规则
 * @method $this ruleUrl() URL验证规则
 * @method $this ruleInteger() 必须是整数
 * @method $this ruleFloat() 必须是浮点数
 * @method $this ruleNumber() 数字验证
 * @method $this ruleMobile() 手机号验证
 * @method $this ruleIdcard() 身份证验证
 *
 */
trait Validator
{
    protected $regex = [
        'email' => '^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$',
        'url' => '^((https|http)?://)',
        'integer' => '^-?\d+$',
        'float' => '^(-?\d+)(\.\d+)$',
        'number' => '^-?[\.\d]*\d+$',
        'mobile' => '^1[3-9]\d{9}$',
        'idCard' => '(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)',
    ];

    /**
     * 是否必填
     * @return $this
     */
    public function required()
    {
        $this->setRule([
            'required' => true,
            'trigger' => ['change', 'blur'],
            'message' => $this->formItem->attr('label') . ui_trans('required', 'validator'),
        ]);
        return $this;
    }

    public function __call($name, $arguments)
    {
        if (strrpos($name, 'rule') === 0) {
            $name = substr($name, 4);
            $name = Str::camel($name);
            if (isset($this->regex[$name])) {
                return $this->rulePattern($this->regex[$name], $name);
            }
        }
        return parent::__call($name, $arguments);
    }

    /**
     * 正则验证
     * @param string $pattern 正则
     * @param null $trans 翻译文本
     * @param array $trigger 触发方式
     * @return $this
     */
    public function rulePattern($pattern, $trans = null, $trigger = ['change', 'blur'])
    {
        if (is_null($trans)) {
            $trans = $type;
        }
        $rule = [
            'pattern' => $pattern,
            'trigger' => $trigger,
            'message' => $this->formItem->attr('label') . ui_trans($trans, 'validator'),
        ];
        $rules = $this->formItem->attr('rules');
        if ($rules) {
            array_push($rules, $rule);
        } else {
            $rules[] = $rule;
        }
        $this->formItem->attr('rules', $rules);
        return $this;
    }
}