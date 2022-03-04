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
    protected $editButton ;
    //删除按钮
    protected $delButton;
    protected $prependArr = [];

    protected $appendArr = [];

    protected $closure = null;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->column = new Column('ExadminAction', '', $grid);
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
    public function detailButton(){
        return $this->detailButton;
    }
    /**
     * 编辑按钮
     * @return ActionButton
     */
    public function editButton(){
        return $this->editButton;
    }
    /**
     * 删除按钮
     * @return ActionButton
     */
    public function delButton(){
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

    public function row($data)
    {
        $id = $data[$this->grid->drive()->getPk()];
        $this->detailButton = new ActionButton;
        $this->detailButton->content(ui_trans('detail', 'grid'))
            ->icon('<InfoCircleFilled />');
        $this->editButton = new ActionButton;
        $this->editButton->content(ui_trans('edit', 'grid'))
            ->type('primary')
            ->icon('<EditFilled />')
            ->modal('http://laravel.com/admin/system/startPage1',['id'=>$id]);
        $this->delButton = new ActionButton;
        $this->delButton->content(ui_trans('delete', 'grid'))
            ->type('primary')
            ->danger()
            ->icon('<DeleteFilled />')
            ->confirm(ui_trans('confim_delete', 'grid'), 'ex-admin/grid/delete', ['id' => $id])
            ->method('delete');
        $html = Html::create();
        //自定义内容显示处理
        if (!is_null($this->closure)) {
            call_user_func_array($this->closure, [$this, $data]);
        }
        //前面追加
        $html->content($this->prependArr);

        if (!$this->hideDetailButton) {
            $html->content($this->detailButton->button());
        }
        if (!$this->hideEditButton) {
            $html->content($this->editButton->button());
        }
        if (!$this->hideDelButton) {
            $html->content($this->delButton->button());
        }
        //追加尾部
        $html->content($this->appendArr);
        return $html;
    }
}
