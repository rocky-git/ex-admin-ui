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
        $html = Html::create();
        //自定义内容显示处理
        if (!is_null($this->closure)) {
            call_user_func_array($this->closure, [$this, $data]);
        }
        //前面追加
        $html->content($this->prependArr);

        if (!$this->hideDetailButton) {
            $html->content(
                Button::create(ui_trans('detail', 'grid'))
                    ->icon('<InfoCircleFilled />')
            );
        }
        if (!$this->hideEditButton) {
            $html->content(
                Button::create(ui_trans('edit', 'grid'))
                    ->type('primary')
                    ->icon('<EditFilled />')
            );

        }
        if (!$this->hideDelButton) {
            $html->content(
                Button::create(ui_trans('delete', 'grid'))
                    ->type('primary')
                    ->danger()
                    ->icon('<DeleteFilled />')
                    ->confirm(ui_trans('confim_delete', 'grid'), '1', ['a' => 1])
            );
        }
        //追加尾部
        $html->content($this->appendArr);
        return $html;
    }
}