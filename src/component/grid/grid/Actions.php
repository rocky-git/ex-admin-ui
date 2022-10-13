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
use ExAdmin\ui\component\common\Icon;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\feedback\Drawer;
use ExAdmin\ui\component\feedback\Modal;
use ExAdmin\ui\component\navigation\dropdown\Dropdown;

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
    //双击触发类型
    protected $dblclick = null;
    //双击操作
    protected $dblclickAction = null;

    protected $prependArr = [];

    protected $appendArr = [];

    protected $icon = false;

    protected $closure = [];
    /**
     * @var Dropdown
     */
    protected $dropdown;

    protected $row = [];

    protected $id;

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

    public function icon()
    {
        $this->icon = true;
    }

    /**
     * 下拉菜单
     * @param string $text
     * @return Dropdown
     */
    public function dropdown($text = null)
    {
        if (is_null($text)) {
            $text = admin_trans('grid.action');
        }
        $this->dropdown = Dropdown::create(
            Button::create(
                [
                    $text,
                    Icon::create('DownOutlined')->style(['marginRight' => '5px'])
                ]
            )
        )->trigger(['click']);
        return $this->dropdown;
    }


    /**
     * 前面追加
     * @param array|Component $content
     */
    public function prepend($content)
    {
        $this->prependArr[] = $content;
        return $this;
    }

    /**
     * 追加尾部
     * @param array|Component $content
     */
    public function append($content)
    {
        $this->appendArr[] = $content;
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
        $this->closure[] = $closure;
    }

    public function edit($new = true)
    {
        if (!$this->editButton || $new) {
            $this->editButton = new ActionButton();
            $this->editButton->button()
                ->type('primary')
                ->icon('<EditFilled />');
        }
        return $this->editButton;
    }

    public function detail($new = true)
    {
        if (!$this->detailButton || $new) {
            $this->detailButton = new ActionButton();
            $this->detailButton->button()
                ->icon('<InfoCircleFilled />');
        }
        return $this->detailButton;
    }

    public function setActionParams(ActionButton $actionButton, $id, $method)
    {
        if ($actionButton->action() instanceof Modal || $actionButton->action() instanceof Drawer) {
            $reference = $actionButton->action()->attr('reference');
            $event = $reference->getEvent('Click.stop', 'custom');
            foreach ($event as &$item) {
                if ($item['type'] == 'Modal') {
                    $item['params']['data'] = array_merge($item['params']['data'], [$this->grid->driver()->getPk() => $id]);
                    $item['params']['method'] = $method;
                    $actionButton->action()->removeBind($actionButton->action()->getModel());
                    $actionButton->action()->vModel('visible', null, false);
                    $item['params']['modal'] = $actionButton->action()->getModel();
                    $actionButton->whenShow(admin_check_permissions($item['params']['url'], $method));
                }
            }
            $reference->setEvent('Click', 'custom', $event);
        } else {
            $directive = $actionButton->action()->getDirective();
            foreach ($directive as &$item) {
                if ($item['name'] == 'redirect') {
                    $parse = parse_url($item['value']);
                    $params = [];
                    if (isset($parse['query'])) {
                        parse_str($parse['query'], $params);
                    }
                    $params = array_merge($params, [$this->grid->driver()->getPk() => $id]);
                    $item['value'] = $parse['path'] . '?' . http_build_query($params);
                    $actionButton->action()->whenShow(admin_check_permissions($parse['path'], $method));
                }
            }
            $actionButton->action()->setDirective($directive);
        }
    }

    /**
     * 双击行触发
     * @param string $type edit｜detail
     */
    public function dblclick($type)
    {
        $this->dblclick = $type;
    }

    public function getDblclickAction()
    {
        return $this->dblclickAction;
    }

    public function row($data)
    {
        $this->row = $data;
        $this->id = $data[$this->grid->driver()->getPk()];
        $html = Html::div()->attr('class', $this->column->attr('dataIndex'))->style(['display' => 'inline-block']);
        //自定义内容显示处理
        foreach ($this->closure as $closure) {
            call_user_func_array($closure, [$this, $this->row]);
        }
        if ($this->detailButton) {
            $this->detailButton->dropdown($this->dropdown ? true : false);
            $this->detailButton->button()->when($this->icon, function ($button) {
                $button->size('small')->shape('circle');
            }, function ($button) {
                $button->content(admin_trans('grid.detail'));
            });
            $this->setActionParams($this->detailButton, $this->id, 'get');
            if ($this->dblclick == 'detail') {
                $this->dblclickAction = $this->detailButton->action();
            }
        }
        if ($this->editButton) {
            $this->editButton->dropdown($this->dropdown ? true : false);
            $this->editButton->button()->when($this->icon, function ($button) {
                $button->size('small')->shape('circle')->type('');
            }, function ($button) {
                $button->content(admin_trans('grid.edit'));
            });
            $this->setActionParams($this->editButton, $this->id, 'put');
            if ($this->dblclick == 'edit') {
                $this->dblclickAction = $this->editButton->action();
            }
        }
        $this->delButton = new ActionButton;
        $this->delButton->dropdown($this->dropdown ? true : false);
        $this->delButton
            ->when(!$this->dropdown, function ($button) {
                $button->danger()->type('primary');
            })
            ->when($this->icon, function ($button) {
                $button->size('small')->shape('circle')->danger(false)->type('');
            }, function ($button) {
                $button->content(admin_trans('grid.delete'));
            })
            ->icon('<DeleteFilled />')
            ->confirm(admin_trans('grid.confim_delete'), $this->grid->attr('url'), $this->grid->getCall()['params'] + ['ex_admin_trashed' => $this->grid->isTrashed(), 'ex_admin_action' => 'delete', 'ids' => [$this->id]])
            ->method('delete')
            ->gridRefresh();

        //前面追加
        $html->content($this->prependArr);

        if (!$this->hideDetailButton && $this->detailButton) {
            if ($this->dropdown) {
                $this->dropdown->menu->content($this->detailButton->action());
            } else {
                $html->content($this->detailButton->action());
            }
        }
        if (!$this->hideEditButton && $this->editButton) {
            if ($this->dropdown) {
                $this->dropdown->menu->content($this->editButton->action());
            } else {
                $html->content($this->editButton->action());
            }
        }
        //恢复数据
        if ($this->grid->isTrashed() && !$this->grid->attr('hideTrashedRestore')) {
            $restoreAction = new ActionButton;
            $restoreAction->dropdown($this->dropdown ? true : false);
            $restoreAction
                ->when($this->icon, function ($button) {
                    $button->size('small')->shape('circle');
                }, function ($button) {
                    $button->content(admin_trans('grid.restore'));
                })
                ->icon('<diff-outlined />')
                ->confirm(admin_trans('grid.confim_restore'), $this->grid->attr('url'), ['ex_admin_action' => 'restore', 'ids' => [$this->id]])
                ->method('put')
                ->gridRefresh();
            if ($this->dropdown) {
                $this->dropdown->menu->content($restoreAction->action());
            } else {
                $html->content($restoreAction->action());
            }
        }
        if (!$this->hideDelButton && !($this->grid->isTrashed() && $this->grid->attr('hideTrashedDelete'))) {
            if ($this->dropdown) {
                $this->dropdown->menu->content($this->delButton->action());
            } else {
                $html->content($this->delButton->action());
            }
        }
        if ($this->dropdown) {
            $html->content($this->dropdown);
        }
        //追加尾部
        $html->content($this->appendArr);
        return $html;
    }

    public function __clone()
    {
        if ($this->editButton) {
            $this->editButton = clone $this->editButton;
        }
        if ($this->detailButton) {
            $this->detailButton = clone $this->detailButton;
        }
    }
}
