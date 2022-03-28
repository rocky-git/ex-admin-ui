<?php

namespace ExAdmin\ui\component\form;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\field\dateTimePicker\RangeField;
use ExAdmin\ui\component\form\field\dateTimePicker\RangePicker;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\input\InputGroup;
use ExAdmin\ui\component\form\field\select\Select;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\component\grid\tabs\Tabs;
use ExAdmin\ui\component\layout\Col;
use ExAdmin\ui\component\layout\Divider;
use ExAdmin\ui\component\layout\Row;
use ExAdmin\ui\contract\FormEventInterface;
use ExAdmin\ui\contract\FormInterface;
use ExAdmin\ui\contract\ValidatorForm;
use ExAdmin\ui\Route;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Container;
use ExAdmin\ui\support\Request;
use ExAdmin\ui\traits\CallProvide;


/**
 * 表单
 * Class Form
 * @link   https://next.antdv.com/components/form-cn 表单
 * @link   https://github.com/stipsan/scroll-into-view-if-needed/#options options
 * @method $this model(mixed $model) 表单数据对象                                                                            object
 * @method $this url(string $url) 提交地址
 * @method $this method(string $value) ajax请求method get / post /put / delete
 * @method $this rules(mixed $rules) 表单验证规则                                                                            object
 * @method $this hideRequiredMark(bool $hide = false) 隐藏所有表单项的必选标记                                                boolean
 * @method $this labelAlign(string $align = 'right') label 标签的文本对齐方式                                                'left' | 'right'
 * @method $this layout(string $layout = 'horizontal') 表单布局                                                            'horizontal'|'vertical'|'inline'
 * @method $this labelCol(mixed $column) label 标签布局，同 <Col> 组件，设置 span offset 值，如 {
 * span: 3, offset: 12
 * }
 *                                      或 sm: {span: 3, offset: 12}                                                    object
 * @method $this wrapperCol(mixed $column) 需要为输入控件设置布局样式时，使用该属性，用法同 labelCol                            object
 * @method $this colon(bool $colon = true) 配置 Form.Item 的 colon 的默认值 (只有在属性 layout 为 horizontal 时有效)            boolean
 * @method $this validateOnRuleChange(bool $validate = true) 是否在 rules 属性改变后立即触发一次验证                            boolean
 * @method $this scrollToFirstError(mixed $error = false) 提交失败自动滚动到第一个错误字段                                    boolean | options
 * @method $this name(string $name) 表单名称，会作为表单字段 id 前缀使用                                                        string
 * @method $this validateTrigger(mixed $validate = 'change') 统一设置字段校验规则                                            string | string[]
 * @method $this noStyle(bool $style = false) 为 true 时不带样式，作为纯字段控件使用                                            boolean
 * @method static $this create($data, $bindField = null) 创建
 * @mixin FormEventInterface
 * @package ExAdmin\ui\component\form
 */
class Form extends Component
{
    use FormComponent, FormEvent;

    //是否编辑表单
    protected $isEdit = false;

    protected $formItem = [];
    /**
     * @var ValidatorForm
     */
    protected $validator;
    /**
     * @var FormAction
     */
    protected $actions;
    //数据源
    protected $data = [];

    public $manyField = [];
    
    public $tabs = [];
    //验证绑定提示字段
    protected $validateBindField = '';
    /**
     * @var FormInterface
     */
    protected $drive;
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ExForm';

    public $vModel = 'model';

    /**
     * @param array $data 初始数据
     * @param null $bindField 绑定字段
     */
    public function __construct($data, $bindField = null)
    {
        parent::__construct();
        $drive = admin_config('admin.form.manager');
        $this->drive = (new $drive($data, $this))->getDriver();
        $this->vModel($this->vModel, $bindField, $data);
        //验证绑定提示
        $this->validateBindField = $this->getModel().'Validate';
        $this->vModel('validateField',$this->validateBindField, [],true);
        $this->labelWidth(100);
        $this->actions = new FormAction($this);
        //保存成功关闭弹窗
        $this->eventCustom('success', 'CloseModal');
        //保存成功刷新grid列表
        $this->eventCustom('success', 'GridRefresh');
        $pk = $this->drive->getPk();
        if (Request::input($pk)) {
            $id = Request::input($pk);
            $this->drive->edit($id);
            $this->data = $this->drive->get();
            $this->attr('editId', $id);
            $this->method('PUT');
            $this->isEdit = true;
        }
        $this->url("ex-admin/{$this->call['class']}/{$this->call['function']}");
        $validator = admin_config('admin.form.validator');
        $this->validator = new $validator($this);
    }

    /**
     * @return ValidatorForm
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
        if (isset($this->formComponent[$name])) {
            return $this->formItem($name, $arguments);
        } else {
            return parent::__call($name, $arguments); // TODO: Change the autogenerated stub
        }
    }


    protected function formItem($name, $arguments)
    {
        $class = $this->formComponent[$name];
        list($field, $label) = Arr::formItem($class, $arguments);
        $component = $class::create(...$field);
        $this->setPlaceholder($component, $label);
        $name = explode('.', $component->getVmodel());
        $item = $this->item($name, $label)->content($component);
        $component->setFormItem($item);
        $component->modelValue();
        return $component;
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
     */
    public function inputDefault($field, $value = null)
    {
        $data = $this->input($field);
        if ((empty($data) && $data !== '0' && $data !== 0)) {
            $value = $this->convertNumber($value);
            Arr::set($this->data, $field, $value);
        }
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
        if (is_null($field)) {
            return $this->data;
        }
        if (is_array($field)) {
            $this->data = array_merge($this->data, $field);
            return;
        }
        if (is_null($value)) {
            return Arr::get($this->data, $field) ?? $this->drive->get($field);
        }
        $value = $this->convertNumber($value);
        Arr::set($this->data, $field, $value);
    }

    protected function convertNumber($value)
    {
        if (is_array($value) && count($value) == count($value, 1)) {
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
        } elseif ($component instanceof Select) {
            $placeholder = 'please_enter';
        }
        if (!empty($placeholder)) {
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
        if(is_null($model)){
            $model = $this->getModel();
        }
        if (count($this->manyField) == 0) {
            $bindField = $model . '.' . $field;
        }
        return $bindField;
    }

    /**
     * 一对多添加
     * @param string $field
     * @param string|Component $title
     * @param \Closure $closure
     */
    public function hasMany(string $field, $title, \Closure $closure)
    {
        $bindField = $this->getBindField($field);
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
        $formMany = FormMany::create($bindField)
            ->content($formItems)
            ->attr('field', $field)
            ->attr('title', $title)
            ->attr('itemData', $itemData);
        $this->push($formMany);
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
     * @return $this
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
                $row->column($item, $item->attr('span'));
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
        } elseif ($content instanceof Component && in_array(get_class($content), $this->formComponent)) {
            $content = array_pop($this->formItem);
        }
        $col->content($content);
        $this->push($col);
        return $col;
    }

    /**
     * 添加item
     * @param sring $name
     * @param string|Component $label label 标签的文本
     * @return FormItem
     */
    public function item($name = '', $label = '')
    {
        $item = FormItem::create($this)
            ->label($label)
            ->name($name)
            ->attr('validateFormField',$this->validateBindField);
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
            ->invokeMethod($this->drive, $method, Request::input());
    }

    public function jsonSerialize()
    {
        if (Request::has('ex_admin_action')) {
            return $this->dispatch(Request::input('ex_admin_action'));
        }
        $this->content($this->formItem);
        $this->content($this->actions, 'footer');
        $callParams = ['ex_admin_class' => $this->call['class'], 'ex_admin_function' => $this->call['function']];
        $callParams = array_merge($callParams, $this->call['params']);
        $this->attr('callParams', $callParams);
        $this->attr('tabsValidateField', $this->validator->getTabField());
        $this->bind($this->getModel(), $this->data);
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
