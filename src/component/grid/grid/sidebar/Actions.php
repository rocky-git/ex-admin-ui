<?php

namespace ExAdmin\ui\component\grid\grid\sidebar;

use ExAdmin\ui\component\common\Button;

class Actions
{

    protected $sidebar;

    //隐藏编辑按钮
    protected $hideEditButton = false;
    //隐藏删除按钮
    protected $hideDelButton = false;

    public function __construct(Sidebar $sidebar)
    {
        $this->sidebar = $sidebar;

    }
    
    //隐藏编辑按钮
    public function hideEdit(bool $bool = true)
    {
        $this->hideEditButton = $bool;
    }

    //隐藏删除按钮
    public function hideDel(bool $bool = true)
    {
        $this->hideDelButton = $bool;
    }
    
    public function row($data){
        $form = $this->sidebar->getForm();
        $grid = $this->sidebar->getGrid();
        $pk = $this->sidebar->driver()->getPk();
        if($form && !$this->hideEditButton){
            $data['ex_admin_edit'] = Button::create()
                ->shape('circle')
                ->size('small')
                ->icon('<edit-outlined />')
                ->modal($form,[$pk=>$data[$pk],'GridRefreshOff'=>true])
                ->attr('pk',$pk)
                ->title(admin_trans('form.edit'));
        }
        if(!$this->hideDelButton){
            $data['ex_admin_delete'] =
                Button::create()
                    ->shape('circle')
                    ->size('small')
                    ->icon('<delete-outlined />')
                    ->confirm(admin_trans('grid.confim_delete'),$grid->attr('url'),['ex_admin_action' => 'delete','ex_admin_sidebar'=>true, 'ids' => [$data[$pk]]])->method('delete');

        }
        return $data;
    }
}