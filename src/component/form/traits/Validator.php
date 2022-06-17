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
 * @method $this ruleAlpha() 字母验证
 * @method $this ruleAlphaNum() 字母数字验证
 * @method $this ruleAlphaDash() 字母、数字和下划线_及破折号-验证
 * @method $this ruleChs() 汉字验证
 * @method $this ruleChsAlpha() 汉字、字母验证
 * @method $this ruleChsAlphaNum() 汉字、字母、数字验证
 * @method $this ruleChsDash() 汉字、字母、数字和下划线_及破折号-
 *
 */
trait Validator
{
    public static $regex = [
        'email' => '^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$',
        'url' => '^((https|http)?://)',
        'integer' => '^-?\d+$',
        'float' => '^(-?\d+)(\.\d+)$',
        'number' => '^-?[\.\d]*\d+$',
        'mobile' => '^1[3-9]\d{9}$',
        'idCard' => '(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)',
        'alpha' => '^[A-Za-z]+$',
        'alphaNum' => '^[A-Za-z0-9]+$',
        'alphaDash' => '^[A-Za-z0-9\-\_]+$',
        'chs' => '^[\u4e00-\u9fa5]+$',
        'chsAlpha' => '^[\u4e00-\u9fa5a-zA-Z]+$',
        'chsAlphaNum' => '^[\u4e00-\u9fa5a-zA-Z0-9]+$',
        'chsDash' => '^[\u4e00-\u9fa5a-zA-Z0-9\_\-]+$',
    ];


    public static $regexMsg = [];

    /**
     * 扩展前端验证
     * @param string $type 扩展名称
     * @param $pattern 正则
     * @param $trans 验证提示文本
     */
    public static function extend(string $type, $pattern, $trans)
    {
        static::$regex[$type] = $pattern;
        static::$regexMsg[$type] = $trans;
    }

    /**
     * 是否必填
     * @return $this
     */
    public function required()
    {
        $this->attr('required',true);
        $this->setRule([
            'required' => true,
            'trigger' => ['change', 'blur'],
            'message' =>  $this->formItem->attr('title') . admin_trans('validator.required'),
        ]);
        return $this;
    }


    /**
     * 长度验证
     * @param int $min 最小
     * @param int $max 最大
     * @return $this
     */
    public function ruleLeng(int $min, int $max = null)
    {
        if (is_null($max)) {
            $this->setRule([
                'len' => $min,
                'trigger' => ['change', 'blur'],
                'message' => $this->formItem->attr('label') . admin_trans('validator.leng') . $min,
            ]);
        } else {
            $this->setRule([
                'min' => $min,
                'max' => $max,
                'trigger' => ['change', 'blur'],
                'message' => $this->formItem->attr('label') . admin_trans('validator.leng') . $min . ' - ' . $max,
            ]);
        }
        return $this;
    }

    /**
     * 正则验证
     * @param string $pattern 正则
     * @param null $trans 翻译文本
     * @param array $trigger 触发方式
     * @return $this
     */
    public function rulePattern($pattern, $trans = null, $trigger = ['blur'])
    {
        if (is_null($trans)) {
            $trans = $type;
        }
        $regexKey = array_search($pattern,static::$regex);
        if($regexKey){
            $regexKey = 'rule_'.$regexKey;
            $regexKey = Str::camel($regexKey);
        }else{
            $regexKey = 'custom';
        }
        $rule = [
            'regexKey'=>$regexKey,
            'pattern' => $pattern,
            'trigger' => $trigger,
            'message' => $this->formItem->attr('label') . admin_trans('validator.' . $trans),
        ];
        $this->setRule($rule);
        return $this;
    }

    protected function setRule($rule)
    {
        $field = $this->getValidateField();
        $this->formItem->form()->validator()->setTabField($field);
        $rules = $this->formItem->attr('rules');
        if ($rules) {
            array_push($rules, $rule);
        } else {
            $rules[] = $rule;
        }
        $this->formItem->attr('rules', $rules);
        return $this;
    }
    protected function getValidateField(){
        $field = implode('.', $this->formItem->attr('name'));
        $form = $this->formItem->form();
        if(count($form->manyField)>0){
            $validateField = $form->manyField;
            array_push($validateField,$field);
            $field = implode('.*.',$validateField);
        }
        return $field;
    }
    /**
     * 表单验证规则
     * @param array $rule 验证规则
     * @param int $type 0全部，1新增，2更新
     * @return $this
     */
    public function rule(array $rule, $type = 0)
    {
        $form = $this->formItem->form();
        $validator = $form->validator();
        $field = $this->getValidateField();
        $this->formItem->form()->validator()->setStepField($field);
        if($validator->passField($field)){
            if ($type == 1) {
                $validator->createRule($field, $rule);
            } elseif ($type == 2) {
                $validator->updateRule($field, $rule);
            } else {
                $validator->createRule($field, $rule);
                $validator->updateRule($field, $rule);
            }
        }
        return $this;
    }

    /**
     * 表单新增验证规则
     * @param array $rule 验证规则
     * @return \ExAdmin\ui\component\form\Field
     */
    public function createRule(array $rule)
    {
        return $this->rule($rule, 1);
    }

    /**
     * 表单更新验证规则
     * @param array $rule 验证规则
     * @return \ExAdmin\ui\component\form\Field
     */
    public function updateRule(array $rule)
    {
        return $this->rule($rule, 2);
    }
}
