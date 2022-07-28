<?php

namespace ExAdmin\ui\component\form;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\field\Cascader;
use ExAdmin\ui\component\form\field\CascaderSingle;
use ExAdmin\ui\component\form\field\dateTimePicker\RangeField;
use ExAdmin\ui\component\form\field\dateTimePicker\RangePicker;
use ExAdmin\ui\component\form\field\input\Hidden;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\input\InputGroup;
use ExAdmin\ui\component\form\field\select\Select;
use ExAdmin\ui\component\form\field\select\SelectTable;
use ExAdmin\ui\component\form\field\upload\Image;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\component\form\traits\Step;
use ExAdmin\ui\component\form\traits\WatchForm;
use ExAdmin\ui\component\grid\tabs\Tabs;
use ExAdmin\ui\component\layout\Col;
use ExAdmin\ui\component\layout\Divider;
use ExAdmin\ui\component\layout\Row;
use ExAdmin\ui\contract\FormAbstract;
use ExAdmin\ui\contract\FormEventInterface;
use ExAdmin\ui\contract\ValidatorAbstract;
use ExAdmin\ui\Route;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Request;


/**
 * 表单
 * Class Form
 * @link   https://next.antdv.com/components/form-cn 表单
 * @link   https://github.com/stipsan/scroll-into-view-if-needed/#options options
 * @method $this model(mixed $model) 表单数据对象                                                                            object
 * @method $this url(string $url) 提交地址
 * @method $this method(string $value) ajax请求method get / post /put / delete
 * @method $this params(array $data) ajax请求附加参数
 * @method $this rules(mixed $rules) 表单验证规则                                                                            object
 * @method $this hideRequiredMark(bool $hide = true) 隐藏所有表单项的必选标记                                                boolean
 * @method $this labelAlign(string $align = 'right') label 标签的文本对齐方式                                                'left' | 'right'
 * @method $this layout(string $layout = 'horizontal') 表单布局                                                            'horizontal'|'vertical'|'inline'
 * @method $this labelCol(mixed $column) label 标签布局                                                object
 * @method $this wrapperCol(mixed $column) 需要为输入控件设置布局样式时，使用该属性，用法同 labelCol                            object
 * @method $this colon(bool $colon = true) 配置 Form.Item 的 colon 的默认值 (只有在属性 layout 为 horizontal 时有效)            boolean
 * @method $this validateOnRuleChange(bool $validate = true) 是否在 rules 属性改变后立即触发一次验证                            boolean
 * @method $this scrollToFirstError(mixed $error = true) 提交失败自动滚动到第一个错误字段                                    boolean | options
 * @method $this name(string $name) 表单名称，会作为表单字段 id 前缀使用                                                        string
 * @method $this validateTrigger(mixed $validate = 'change') 统一设置字段校验规则                                            string | string[]
 * @method $this noStyle(bool $style = true) 为 true 时不带样式，作为纯字段控件使用                                            boolean
 * @method static $this create($data = [], \Closure $closure = null, $bindField = null) 创建
 * @package ExAdmin\ui\component\form
 */
class Form extends Component
{
    use FormComponent, FormEvent, Step, WatchForm;

    //是否编辑表单
    protected $isEdit = false;

    protected $formItem = [];
    /**
     * @var ValidatorAbstract
     */
    protected $validator;
    /**
     * @var FormAction
     */
    protected $actions;

    protected $imageComponent;

    protected $callbackComponents = [];
    protected $callbackComponent;
    //数据源
    protected $data = [];

    public $manyField = [];

    public $tabs = [];
    //验证绑定提示字段
    protected $validateBindField = '';
    /**
     * @var FormAbstract
     */
    protected $driver;
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ExForm';

    protected $vModel = 'model';

    protected $exec;

    /**
     * @param array $data 初始数据
     * @param \Closure $closure
     * @param string $bindField 绑定字段
     */
    public function __construct($data = [], \Closure $closure = null, $bindField = null)
    {
        parent::__construct();
        if($data instanceof \Closure){
            $closure = $data;
            $this->source([],$bindField);
        }else{
            $this->source($data,$bindField);
        }
        $this->exec = $closure;

        $this->attr('formField', $this->getModel());
        //验证绑定提示
        $this->validateBindField = $this->getModel() . 'Validate';
        $this->vModel('validateField', $this->validateBindField, '', true);
        $this->labelWidth(100);
        $this->actions = new FormAction($this);
        //保存成功关闭弹窗
        $this->eventCustom('success', 'CloseModal');
        //保存成功刷新grid列表
        $this->eventCustom('success', 'GridRefresh');
        $this->url("ex-admin/{$this->call['class']}/{$this->call['function']}");
        $this->description(admin_trans($this->isEdit ? 'form.edit' : 'form.add'));
        $validator = admin_config('admin.form.validator');
        $this->validator = new $validator($this);
        $this->size('default');
        $this->except('ex_admin_id');
    }

    /**
     * 设置源
     * @param mixed $data
     */
    public function source($data,$bindField=null){
        $manager = admin_config('admin.form.manager');
        $this->driver = (new $manager($data, $this))->getDriver();
        $this->vModel($this->vModel, $bindField, $data);
        $pk = $this->driver->getPk();
        $this->attr('pk', $pk);
        if (Request::input($pk)) {
            $id = Request::input($pk);
            $this->driver->edit($id);
            $this->attr('editId', $id);
            $this->attr('pk', $pk);
            $this->method('PUT');
            $this->isEdit = true;
            $this->input($pk, $id);
        }
    }
    /**
     * 设置表单内组件大小
     * @param string $size large default small
     */
    public function size(string $size){
        $this->attr('size',$size);
    }
    /**
     * @return FormAbstract
     */
    public function driver()
    {
        return $this->driver;
    }

    /**
     * @return ValidatorAbstract
     */
    public function validator()
    {
        return $this->validator;
    }

    /**
     * 是否编辑
     * @return bool
     */
    public function isEdit()
    {
        return $this->isEdit;
    }

    /**
     * Label 宽度
     * @param int $number
     * @return $this
     */
    public function labelWidth($number)
    {
        return $this->labelCol(['style' => ['width' => $number . 'px']]);
    }

    public function __call($name, $arguments)
    {
        if (isset(self::$formComponent[$name])) {
            return $this->formItem($name, $arguments);
        } else {
            return parent::__call($name, $arguments); // TODO: Change the autogenerated stub
        }
    }


    protected function formItem($name, $arguments)
    {
        $class = self::$formComponent[$name];
        list($field, $label) = Arr::formItem($class, $arguments);
        $component = $class::create(...$field);
        $this->setPlaceholder($component, $label);
        $name = explode('.', $component->getModel());
        $item = $this->item($name, $label)->content($component);
        $component->setFormItem($item);
        $component->modelValue();
        if ($component instanceof Image && $component->uploadField == Request::input('upload_field')) {
            $this->imageComponent = $component;
        } elseif ((
                $component instanceof SelectTable
                || $component instanceof Select

            )
        ) {
            $this->callbackComponents[] = $component;
        }
        if($this->attr('size')){
            $component->attr('size',$this->attr('size'));
        }
        return $component;
    }

    public static function extend($name, $component)
    {
        self::$formComponent[$name] = $component;
    }

    public function getImageComponent()
    {

        return $this->imageComponent;
    }

    public function getCallbackComponent()
    {

        return $this->callbackComponent;
    }

    public function getFormItem()
    {
        return $this->formItem;
    }

    public function popItem()
    {
        $item = array_pop($this->formItem);
        return $item;
    }

    /**
     * 设置缺省值
     * @param string $field 字段
     * @param mixed $value 值
     * @param bool $convertNumber 数字格式化
     */
    public function inputDefault($field, $value = null, $convertNumber = true)
    {
        $data = $this->input($field);
        if ((empty($data) && $data !== '0' && $data !== 0)) {
            $data = $value;
        }
        if ($convertNumber) {
            $data = $this->convertNumber($data);
        }
        Arr::set($this->data, $field, $data);
    }

    /**
     * 移除数据
     * @param array|string $keys 字段
     */
    public function removeInput($keys)
    {
        Arr::forget($this->data, $keys);
    }

    /**
     * 设置/获取数据
     * @param string|array $field 字段
     * @param null $value 值
     * @return array|mixed
     */
    public function input($field = null, $value = null)
    {
        if (is_array($value) && is_null($field)) {
            $this->data = $value;
            return;
        }
        if (is_null($field)) {
            return $this->data;
        }
        if (is_array($field)) {
            $this->data = array_merge($this->data, $field);
            return;
        }
        if (is_null($value)) {
            return Arr::get($this->data, $field) ?? $this->driver->get($field);
        }
        $value = $this->convertNumber($value);
        Arr::set($this->data, $field, $value);
    }

    protected function convertNumber($value)
    {
        if (is_array($value)) {
            foreach ($value as &$v) {
                $v = $this->convertNumber($v);
            }
        } elseif (!is_array($value) && is_numeric($value) && preg_match('/^(0|[1-9][0-9]*)$/', $value) && preg_match('/^\d{1,11}$/', $value)) {
            $value = intval($value);
        } elseif (is_numeric($value) && strpos($value, '.') !== false) {
            $value = floatval($value);
        }
        return $value;
    }

    protected function setPlaceholder(Component $component, $label)
    {
        $placeholder = '';
        if ($component instanceof Input) {
            $placeholder = 'please_enter';
        } elseif ($component instanceof Select || $component instanceof Cascader || $component instanceof CascaderSingle) {
            $placeholder = 'please_select';
        }
        if (!empty($placeholder) && is_string($label)) {
            $component->placeholder(admin_trans('form.' . $placeholder) . $label);
        }
    }

    public function collectFields(\Closure $closure)
    {
        $offset = count($this->formItem);
        call_user_func($closure, $this);
        $formItems = array_slice($this->formItem, $offset);
        $this->formItem = array_slice($this->formItem, 0, $offset);
        return $formItems;
    }

    public function getBindField($field, $model = null)
    {
        $bindField = $field;
        if (is_null($model)) {
            $model = $this->getModel();
        }
        if (count($this->manyField) == 0) {
            $bindField = $model . '.' . $field;
        }
        return $bindField;
    }

    public function setManyField($field)
    {
        $this->manyField[$field] = $field;
    }

    public function unsetManyField($field)
    {
        unset($this->manyField[$field]);
    }

    /**
     * 一对多添加
     * @param string $field
     * @param string|Component $title
     * @param \Closure $closure
     * @return FormMany
     */
    public function hasMany(string $field, $title, \Closure $closure)
    {
        $manyData = $this->input($field) ?? [];
        $data = $this->data;
        $this->data = [];
        $this->manyField[$field] = $field;
        $formItems = $this->collectFields($closure);
        $itemData = $this->data;
        foreach ($manyData as &$row) {
            $this->data = $row;
            $this->collectFields($closure);
            $row = $this->data;
        }
        unset($this->manyField[$field]);
        $this->data = $data;
        $this->input($field, $manyData);
        $formMany = FormMany::create($field)
            ->content($formItems)
            ->attr('field', $field)
            ->attr('title', $title)
            ->attr('itemData', $itemData);
        $item = $this->item()->content($formMany);
        $formMany->setFormItem($item);
        $formMany->modelValue();

        $columns = [];
        foreach ($formItems as $item) {
            if ($item instanceof FormItem) {
                $formItem = clone $item;
                $component = $formItem->content['default'][0];
                if($component instanceof Hidden){
                    continue;
                }
                $columns[] = [
                    'header' => Html::create($formItem->content['label'] ?? ''),
                    'dataIndex' => $formItem->attr('name'),
                    'component' => $formItem,
                ];
                unset($formItem->content['label']);
                $formItem->removeAttr('label');
            }
        }
        $columns[] = [
            'type' => 'action',
            'width' => 70,
            'dataIndex' => 'action',
        ];
        $formMany->attr('columns', $columns);
        return $formMany;
    }

    /**
     * 选项卡布局
     * @return Tabs
     */
    public function tabs()
    {
        $tab = Tabs::create();
        $tab->setForm($this);
        $this->push($tab);
        return $tab;
    }

    /**
     * 添加一行布局
     * @param \Closure $closure
     * @param string $title 标题
     * @return Row
     */
    public function row(\Closure $closure, $title = '')
    {
        $row = Row::create();
        if (!empty($title)) {
            $this->push(Divider::create()->orientation('left')->content($title));
        }
        $formItems = $this->collectFields($closure);
        foreach ($formItems as $item) {
            if ($item instanceof Col) {
                $row->content($item);
            } elseif ($item instanceof FormItem && $item->attr('span')) {
                $column = $row->column($item, $item->attr('span'));
                $column->where = $item->where;
            } else {
                $row->content(Col::create()->content($item));
            }
        }
        $this->push($row);
        return $row;
    }

    /**
     * 添加一列（必须配合row使用）
     * @param \Closure|Component $content
     * @return Col
     */
    public function column($content)
    {
        $col = Col::create();
        if ($content instanceof \Closure) {
            $content = $this->collectFields($content);
        } elseif ($content instanceof Component && in_array(get_class($content), self::$formComponent)) {
            $content = array_pop($this->formItem);
        }
        $col->content($content);
        $this->push($col);
        return $col;
    }

    /**
     * 添加item
     * @param array $name
     * @param string|Component $label label 标签的文本
     * @return FormItem
     */
    public function item(array $name = [], $label = '')
    {
        $item = FormItem::create($this)
            ->label($label)
            ->name($name)
            ->attr('validateFormField', $this->validateBindField);
        if (count($this->manyField) == 0) {
            $ifField = str_replace('.', '_', $this->getBindField(implode('_', $name) . 'Show'));
            $item->bind($ifField, 1)->where($ifField, 1);
        }
        $this->push($item);
        return $item;
    }

    /**
     * 排除字段数据
     * @param array|string $field
     */
    public function except($field)
    {
        if (is_string($field)) {
            $field = [$field];
        }
        $exceptField = $this->attr('exceptField');

        if (is_array($exceptField)) {
            $field = array_merge($exceptField, $field);
        }

        //排除字段
        $this->attr('exceptField', $field);
    }

    /**
     * 表单操作定义
     * @param \Closure $closure
     * @return FormAction
     */
    public function actions(\Closure $closure = null)
    {
        if ($closure) {
            call_user_func_array($closure, [$this->actions]);
        }
        return $this->actions;
    }

    /**
     * @return FormAction
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * 添加一个组件到表单
     * @param Component $item
     */
    public function push($item)
    {
        $this->formItem[] = $item;
    }

    protected function dispatch($method)
    {
        return Container::getInstance()
            ->make(Route::class)
            ->invokeMethod($this->driver, $method, Request::input());
    }

    public function jsonSerialize()
    {
        if ($this->exec) {
            call_user_func($this->exec, $this);
        }
        foreach ($this->callbackComponents as $callbackComponent){
            if($callbackComponent->isCallback()){
                $this->callbackComponent = $callbackComponent;
            }
        }
        if (Request::has('ex_admin_form_action')) {
            return $this->dispatch(Request::input('ex_admin_form_action'));
        }
        $this->content($this->formItem);
        $this->content($this->actions, 'footer');
        $callParams = ['ex_admin_class' => $this->call['class'], 'ex_admin_function' => $this->call['function']];
        $callParams = array_merge($callParams, $this->call['params']);
        $this->attr('callParams', $callParams);
        $this->attr('form_ref', $this->bindAttr('ref'));
        $this->attr('tabsValidateField', $this->validator->getTabField());
        $this->bind($this->getModel(), $this->data);
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
