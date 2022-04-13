<?php

namespace ExAdmin\ui\component\form\step;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\navigation\step\Steps;

class StepForm extends Steps
{
    protected $form;

    protected $finish;

    public function __construct($field = null, $value = 0, Form $form)
    {
        $this->form = $form;
        parent::__construct($field, $value);
    }

    /**
     * 步骤表单
     * @param \Closure $closure
     * @param string $title 标题
     * @param string $description 描述
     * @param string $icon 图标
     * @return $this
     */
    public function add(\Closure $closure, $title, $description = '', $icon = '')
    {
        $this->step($title, $description, $icon);
        $formItems = $this->form->collectFields($closure);
        $html = Html::create()->attr('setpItem', true)->style(['margin:40px 80px 0px 80px'])->tag('div');
        $active = $this->getModel();
        $current = count($this->content['default']) - 1;
        foreach ($formItems as $item) {
            $html->content($item)->whereShow($this->getModel(), $current);
        }
        $this->form->push($html);
        return $this;
    }
    public function getStepCount(){
        return count($this->content['default']);
    }
    public function getFinish(){
        return $this->finish;
    }
    /**
     * 完成结果步骤
     * @param \Closure $closure
     * @param string $title 标题
     * @param string $description 描述
     * @param string $icon 图标
     */
    public function finish(\Closure $closure, $title = null, $description = '', $icon = '')
    {
        $actions = $this->form->getActions();
        $count = $this->getStepCount();
        for ($i = 0; $i <= $count; $i++) {
            if($i > 0 && $i < $count){
                $actions->addLeftAction(
                    Button::create(admin_trans('form.pre_step'))
                        ->where($this->getModel(), $i)
                        ->event('click', [$this->getModel() => $i - 1])
                );
            }
            if($i < $count-1){
                $actions->addLeftAction(
                    Button::create(admin_trans('form.next_step'))
                        ->where($this->getModel(), $i)
                        ->eventFunction('click', 'submit', [], $this->form)
                );
            }
        }
        $actions->submitButton()->where($this->getModel(), $count - 1);
        $actions->hideResetButton();
        $this->step($title ?? admin_trans('form.complete'), $description, $icon);
        $this->finish = $closure;
    }
}
