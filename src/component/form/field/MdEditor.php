<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-06-20
 * Time: 20:07
 */

namespace ExAdmin\ui\component\form\field;


use ExAdmin\ui\component\form\Field;
/**
 * Class MdEditor
 * @package Eadmin\component\form\field
 * @link https://ckang1229.gitee.io/vue-markdown-editor/zh/api.html#props
 * @method $this height(string $height) 高度 500px
 */
class MdEditor extends Field
{
    protected $name = 'v-md-editor';
    protected $vModel = 'modelValue';
    public function __construct($field = null, string $value = '')
    {
        parent::__construct($field, $value);
        $this->height('500px');
    }
}