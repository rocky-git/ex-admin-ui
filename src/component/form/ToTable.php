<?php


namespace ExAdmin\ui\component\form;

use ExAdmin\ui\component\form\field\input\Hidden;
use ExAdmin\ui\component\form\traits\FormComponent;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\grid\Grid;

/**
 * Class Table
 * @package ExAdmin\ui\component\form
 * @mixin Grid
 */
class ToTable
{
    use FormComponent;

    protected $grid;

    protected $form;

    protected $formMany;

    public function __construct(Form $form, FormMany $formMany)
    {
        $this->grid = $this->grid();
        $this->form = $form;
        $this->formMany = $formMany;
    }

    protected function grid()
    {
        return Grid::create()
            ->bordered()
            ->hidePage()
            ->table()
            ->size('small')
            ->disableBeforeEnd();
    }

    public function __call(string $name, array $arguments)
    {
        if (isset(self::$formComponent[$name])) {
            $formComponent = call_user_func_array([$this->form, $name], $arguments);
            $formItem = $formComponent->getFormItem();
            $name = $this->formMany->getField() . '.' . implode('.', $formItem->attr('name'));
            if (!($formComponent instanceof Hidden)) {
                $this->grid->column($name, $formItem->getContent('label'))->default('');
            }
            return $formComponent;
        } else {
            return call_user_func_array([$this->grid, $name], $arguments);
        }
    }

    public function getForm()
    {
        return $this->form;
    }

    public function getGrid()
    {
        return $this->grid;
    }
}