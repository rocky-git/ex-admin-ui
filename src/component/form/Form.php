<?php

namespace ExAdmin\ui\component\form;

use Closure;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\component\layout\Col;
use ExAdmin\ui\component\layout\Divider;
use ExAdmin\ui\component\layout\Row;
use ExAdmin\ui\enum\component\layout\divider\Enum;

/**
 * 表单
 * Class Form
 * @link   https://next.antdv.com/components/form-cn 表单
 * @link   https://github.com/stipsan/scroll-into-view-if-needed/#options options
 * @method $this model(mixed $model) 表单数据对象                                                                            object
 * @method $this rules(mixed $rules) 表单验证规则                                                                            object
 * @method $this hideRequiredMark(bool $hide = false) 隐藏所有表单项的必选标记                                                boolean
 * @method $this labelAlign(string $align = 'right') label 标签的文本对齐方式                                                'left' | 'right'
 * @method $this layout(string $layout = 'horizontal') 表单布局                                                            'horizontal'|'vertical'|'inline'
 * @method $this labelCol(mixed $column) label 标签布局，同 <Col> 组件，设置 span offset 值，如 {span: 3, offset: 12}
 *                                      或 sm: {span: 3, offset: 12}                                                    object
 * @method $this wrapperCol(mixed $column) 需要为输入控件设置布局样式时，使用该属性，用法同 labelCol                            object
 * @method $this colon(bool $colon = true) 配置 Form.Item 的 colon 的默认值 (只有在属性 layout 为 horizontal 时有效)            boolean
 * @method $this validateOnRuleChange(bool $validate = true) 是否在 rules 属性改变后立即触发一次验证                            boolean
 * @method $this scrollToFirstError(mixed $error = false) 提交失败自动滚动到第一个错误字段                                    boolean | options
 * @method $this name(string $name) 表单名称，会作为表单字段 id 前缀使用                                                        string
 * @method $this validateTrigger(mixed $validate = 'change') 统一设置字段校验规则                                            string | string[]
 * @method $this noStyle(bool $style = false) 为 true 时不带样式，作为纯字段控件使用                                            boolean
 * @package ExAdmin\ui\component\form
 */
class Form extends Component
{
    use FormComponent;

    protected $formItem = [];

    /**
     * 组件名称
     * @var string
     */
    protected $name = 'AForm';

    public function __construct()
    {
        $this->vModel('model', null, []);
        $this->labelWidth(100);
        $this->scrollToFirstError();
        parent::__construct();
    }

    /**
     * Label 宽度
     * @param int $number
     * @return $this
     */
    public function labelWidth(int $number): Form
    {
        return $this->labelCol(['style' => ['width' => $number . 'px']]);
    }

    /**
     * @param string $name
     * @param mixed $arguments 参数
     * @return mixed
     */
    protected function formItem(string $name, $arguments)
    {
        $component = new $this->formComponent[$name];
        $component::create();
        $field = $arguments[0];
        if (count($arguments) > 1) {
            $label = array_pop($arguments);
        }
        $label = $label ?? '';
        $item = $this->item($field, $label)->content($component);
        $component->setFormItem($item);
        return $component;
    }

    /**
     *
     * @param Closure $closure
     * @return array
     */
    public function collectFields(Closure $closure): array
    {
        $offset = count($this->formItem);
        call_user_func($closure, $this);
        $formItems = array_slice($this->formItem, $offset);
        $this->formItem = array_slice($this->formItem, 0, $offset);
        return $formItems;
    }

    /**
     * 添加一行布局
     * @param Closure $closure
     * @param string $title 标题
     * @return Row
     */
    public function row(Closure $closure, string $title = ''): Row
    {
        $row = Row::create();
        if (!empty($title)) {
            $this->push(Divider::create()->orientation(Enum::ORIENTATION_LEFT)->content($title));
        }
        $formItems = $this->collectFields($closure);
        foreach ($formItems as $item) {
            $attr = 'span';
            if ($item instanceof Col) {
                $row->content($item);
            } elseif ($item instanceof FormItem && $item->attr($attr)) {
                $row->column($item, $item->attr($attr));
            } else {
                $row->content(Col::create()->content($item));
            }
        }
        $this->push($row);
        return $row;
    }

    /**
     * 添加一列（必须配合row使用）
     * @param Closure|Component $content
     * @return Col
     */
    public function column($content): Col
    {
        $col = Col::create();
        if ($content instanceof Closure) {
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
     * @param string $name
     * @param string|Component $label label 标签的文本
     * @return FormItem
     */
    public function item(string $name = '', $label = ''): FormItem
    {
        $item = FormItem::create()
                        ->label($label)
                        ->name($name);
        $this->push($item);
        return $item;
    }

    /**
     * 添加一个组件到表单
     * @param Component $item
     */
    public function push(Component $item)
    {
        $this->formItem[] = $item;
    }

    /**
     * 获取表单组件
     * @return array
     */
    public function getItem(): array
    {
        return $this->formItem;
    }

    public function __call($name, $arguments)
    {
        if (isset($this->formComponent[$name])) {
            return $this->formItem($name, $arguments);
        } else {
            return parent::__call($name, $arguments);
        }
    }

    public function jsonSerialize()
    {
        foreach ($this->formItem as $item) {
            $this->content($item);
        }
        return parent::jsonSerialize();
    }
}
