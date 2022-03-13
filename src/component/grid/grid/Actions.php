<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-03
 * Time: 20:55
 */

namespace ExAdmin\ui\component\grid\grid;


use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\feedback\Drawer;
use ExAdmin\ui\component\feedback\Modal;

class Actions
{
    /**
     * @var Grid
     */
    protected $grid;
    /**
     * @var Column
     */
    protected $column;

    //隐藏详情按钮
    protected $hideDetailButton = false;
    //隐藏编辑按钮
    protected $hideEditButton = false;
    //隐藏删除按钮
    protected $hideDelButton = false;
    //详情按钮
    protected $detailButton;
    //编辑按钮
    protected $editButton;
    //删除按钮
    protected $delButton;
    protected $prependArr = [];

    protected $appendArr = [];

    protected $closure = null;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->column = new Column('ExAdminAction', '', $grid);
    }

    //隐藏详情按钮
    public function hideDetail(bool $bool = true)
    {
        $this->hideDetailButton = $bool;
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

    /**
     * 详情按钮
     * @return ActionButton
     */
    public function detailButton()
    {
        return $this->detailButton;
    }

    /**
     * 编辑按钮
     * @return ActionButton
     */
    public function editButton()
    {
        return $this->editButton;
    }

    /**
     * 删除按钮
     * @return ActionButton
     */
    public function delButton()
    {
        return $this->delButton;
    }

    /**
     * 前面追加
     * @param mixed $val
     */
    public function prepend($val)
    {
        $this->prependArr[] = $val;
        return $this;
    }

    /**
     * 追加尾部
     * @param mixed $val
     */
    public function append($val)
    {
        $this->appendArr[] = $val;
        return $this;
    }

    /**
     * 操作列
     * @return Column
     */
    public function column()
    {
        return $this->column;
    }

    public function setClosure(\Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * 设置编辑按钮
     * @param ActionButton $actionButton
     */
    public function setEditButton(ActionButton $actionButton)
    {
        $this->editButton = $actionButton;
    }

    /**
     * 设置详情按钮
     * @param ActionButton $actionButton
     */
    public function setDetailButton(ActionButton $actionButton)
    {
        $this->detailButton = $actionButton;
    }
    protected function setActionParams(ActionButton $actionButton,$id){
        if($actionButton->action() instanceof Modal || $actionButton->action() instanceof Drawer){
            $reference = $actionButton->action()->attr('reference');
            $event = $reference->getEvent('Click','custom');
            foreach ($event as &$item){
                if($item['type'] == 'Modal'){
                    $item['params']['data']= array_merge($item['params']['data'],[$this->grid->drive()->getPk()=>$id]);
                }
            }
            $reference->setEvent('Click','custom',$event);
        }else{
            $directive = $actionButton->action()->getDirective();
            foreach ($directive as &$item){
                if($item['name'] =='redirect'){
                    $parse = parse_url($item['value']);
                    $params = [];
                    if(isset($parse['query'])){
                        parse_str($parse['query'],$params);
                    }
                    $params = array_merge($params,[$this->grid->drive()->getPk()=>$id]);
                    $item['value'] = $parse['path'].'?'.http_build_query($params);
                }
            }
            $actionButton->action()->setDirective($directive);
        }
    }
    public function row($data)
    {
        $id = $data[$this->grid->drive()->getPk()];
        if ($this->detailButton) {
            $this->detailButton->button()->content(admin_trans('grid.detail'))
                ->icon('<InfoCircleFilled />');
            $this->setActionParams($this->detailButton,$id);
        }
        if ($this->editButton) {
            $this->editButton->button()->content(admin_trans('grid.edit'))
                ->type('primary')
                ->icon('<EditFilled />');
            $this->setActionParams($this->editButton,$id);
        }
        $this->delButton = new ActionButton;
        $this->delButton->content(admin_trans('grid.delete'))
            ->type('primary')
            ->danger()
            ->icon('<DeleteFilled />')
            ->confirm(admin_trans('grid.confim_delete'), $this->grid->attr('url'), ['ex_admin_action' => 'delete', 'ids' => [$id]])
            ->method('delete')
            ->gridRefresh();
        $html = Html::create()->attr('class', $this->column->attr('dataIndex'));;
        //自定义内容显示处理
        if (!is_null($this->closure)) {
            call_user_func_array($this->closure, [$this, $data]);
        }
        //前面追加
        $html->content($this->prependArr);

        if (!$this->hideDetailButton && $this->detailButton) {
            $html->content($this->detailButton->action());
        }
        if (!$this->hideEditButton && $this->editButton) {
            $html->content($this->editButton->action());
        }
        if (!$this->hideDelButton) {
            $html->content($this->delButton->action());
        }
        //追加尾部
        $html->content($this->appendArr);
        return $html;
    }
    public function __clone()
    {
        if($this->editButton ){
            $this->editButton  = clone $this->editButton;
        }
        if($this->detailButton ) {
            $this->detailButton = clone $this->detailButton;
        }
    }
}
