<?php

namespace ExAdmin\ui\component\grid\grid\sidebar;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\common\Icon;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\contract\GridAbstract;
use ExAdmin\ui\support\Arr;
use ExAdmin\ui\support\Request;

/**
 * @method static $this create(Grid $grid,$data, string $label = 'name', string $id = 'id') 创建
 * @method $this hideTools(bool $bool = true) 隐藏工具栏
 * @method $this hideAdd(bool $bool = true) 隐藏添加
 * @method $this hideEdit(bool $bool = true) 隐藏编辑
 * @method $this hideDel(bool $bool = true) 隐藏删除
 * @method $this hideFilter(bool $bool = true) 隐藏筛选
 * @method $this hideAll(bool $bool = true) 隐藏侧边栏全部
 * @method $this default($value) 默认选中值
 * @method $this span(int $value) 侧边栏包含列的数量
 * @method $this selectedField(string $value) 选中字段
 * @method $this searchPlaceholder(string $value) 搜索提示文本
 */
class Sidebar extends Component
{
    protected $name = 'ExSidebar';

    protected $driver;

    protected $tree = false;

    protected $custom = null;

    protected $actions = null;

    protected $form;

    protected $grid;

    public function __construct(Grid $grid,$data, string $label = 'name', string $id = 'id')
    {
        $manager = admin_config('admin.grid.manager');
        $this->driver = (new $manager($data, $grid))->getDriver();

        $this->grid = $grid;
        $this->attr('url',$this->grid->attr('url'));
        $this->attr('params',$this->grid->attr('callParams')+['ex_admin_sidebar'=>true,'ex_admin_action'=>'data']);
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
        $this->form = $form;
        $tools['add'] = Button::create()
            ->shape('circle')
            ->size('small')
            ->icon('<plus-outlined />')
            ->modal($form,['GridRefreshOff'=>true])->title(admin_trans('form.add'));
        $this->attr('tools', $tools);
        return $this;
    }
    public function getForm(){
        return $this->form;
    }
    public function getGrid(){
        return $this->grid;
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

    /**
     * 自定义显示
     * @param \Closure $closure
     */
    public function custom(\Closure $closure){
        $this->custom = $closure;
        return $this;
    }

    /**
     * 操作
     * @param \Closure $closure
     * @return $this
     */
    public function actions(\Closure $closure){
        $this->actions = $closure;
        return $this;
    }
    public function jsonSerialize()
    {
        $fieldNames = $this->attr('fieldNames');
        $data = $this->driver->data(1,20,true);
        $sourceList = [];
        foreach ($data as $key => $row) {
            if(is_object($row) && method_exists($row,'toArray')){
                $row = $row->toArray();
            }
            $row['ex_admin_render'] = Html::create($row[$fieldNames['title']]);
            if(!is_null($this->custom)){
                $result = call_user_func($this->custom,$row);
                if($result){
                    $row['ex_admin_render'] = $result instanceof Component ?$result:Html::create($result);
                }
            }
            $action = new Actions($this);
            if(!is_null($this->actions)) {
                call_user_func($this->actions, $action,$row);
            }
            $row = $action->row($row);
            $sourceList[] = $row;
        }
        if (Request::has('ex_admin_sidebar')) {
            return $sourceList;
        }else{
            $this->attr('sourceList', $sourceList);
            return parent::jsonSerialize(); // TODO: Change the autogenerated stub
        }
    }
}
