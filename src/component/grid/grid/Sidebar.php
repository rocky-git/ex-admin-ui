<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Icon;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\contract\GridAbstract;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Request;

/**
 * @method static $this create($data, string $label = 'name', string $id = 'id') 创建
 * @method $this hideTools(bool $bool = true) 隐藏工具栏
 * @method $this hideAdd(bool $bool = true) 隐藏添加
 * @method $this hideEdit(bool $bool = true) 隐藏编辑
 * @method $this hideDel(bool $bool = true) 隐藏删除
 * @method $this hideFilter(bool $bool = true) 隐藏筛选
 * @method $this hideAll(bool $bool = true) 隐藏侧边栏全部
 * @method $this default($value) 默认选中值
 * @method $this span(int $value) 侧边栏包含列的数量
 */
class Sidebar extends Component
{
    protected $name = 'ExSidebar';

    protected $driver;

    protected $tree = false;

    public function __construct($data, string $label = 'name', string $id = 'id', Grid $grid)
    {
        $manager = admin_config('admin.grid.manager');
        $this->driver = (new $manager($data, $grid))->getDriver();
        
        $this->grid = $grid;
        $this->attr('url',$this->grid->attr('url'));
        $this->attr('params',$this->grid->attr('callParams')+['ex_admin_sidebar'=>true,'ex_admin_action'=>'data','page'=>1,'size'=>20,'hidePage'=>true]);
        $this->attr('fieldNames', [
            'children' => 'children',
            'title' => $label,
            'key' => $id,
        ]);
        $this->span(5);
    }
    /**
     * @return GridAbstract
     */
    public function driver()
    {
        return $this->driver;
    }
    /**
     * @param \Closure $closure
     * @return $this
     */
    public function model(\Closure $closure)
    {
        call_user_func($closure,$this->driver->model());
        return $this;
    }
    /**
     * 树形
     * @param string $id 主键
     * @param string $pid 上级id
     * @param string $children 下级成员
     * @return $this
     */
    public function tree(string $id = 'id', string $pid = 'pid', string $children = 'children')
    {
        $this->attr('isTree',true);
        $fieldNames = $this->attr('fieldNames');
        $this->attr('fieldNames', [
            'children' => $children,
            'title' => $fieldNames['title'],
            'key' => $id,
            'pid' => $pid,
        ]);
        return $this;
    }

    /**
     * @param Form $form
     * @return $this
     */
    public function setForm(Form $form)
    {
        $tools['add'] = Button::create()
            ->shape('circle')
            ->size('small')
            ->icon('<plus-outlined />')
            ->modal($form,['GridRefreshOff'=>true])->title(admin_trans('form.add'));
        $tools['edit'] =
            Button::create()
                ->shape('circle')
                ->size('small')
                ->icon('<edit-outlined />')
                ->modal($form,[$form->driver()->getPk()=>0,'GridRefreshOff'=>true])
                ->attr('pk',$form->driver()->getPk())
                ->title(admin_trans('form.edit'));
        $tools['del'] =
            Button::create()
                ->shape('circle')
                ->size('small')
                ->icon('<delete-outlined />')
                ->confirm(admin_trans('grid.confim_delete'),$this->grid->attr('url'),['ex_admin_action' => 'delete','ex_admin_sidebar'=>true, 'ids' => [0]])->method('delete');
        $this->attr('tools', $tools);
        return $this;
    }

    /**
     * 请求字段名
     * @param $name
     * @return $this
     */
    public function field($name)
    {
        $this->grid->getFilter()->eq()->text($name)->getFormItem()->style(['display' => 'none']);
        $this->attr('field', $name);
        return $this;
    }

    public function jsonSerialize()
    {
        $this->attr('sourceList', $this->driver->data(1,20,true));
        if ($this->tree) {
            $fieldNames = $this->attr('fieldNames');
        }
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
