<?php

namespace ExAdmin\ui\plugin;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\common\Icon;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\grid\badge\Badge;
use ExAdmin\ui\component\grid\card\Card;
use ExAdmin\ui\component\grid\grid\Actions;
use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\tabs\Tabs;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\component\navigation\dropdown\Dropdown;
use Illuminate\Support\Facades\Log;

class Controller
{
    public function index()
    {
        $tabs = Tabs::create();
        $tabs->pane('全部', $this->grid());
        $tabs->pane('已安装', $this->grid(1));
        $cates = plugin()->getCate();
        foreach ($cates as $cate) {
            $tabs->pane($cate['name'], $this->grid(0, $cate['id']));
        }
        return Card::create($tabs)->attr('ex_admin_title', '插件管理');
    }

    public function grid($type = 0, $cate_id = 0)
    {
        $grid = Grid::create(new \ExAdmin\ui\component\grid\grid\driver\Plugin());
        $grid->column('title', '名称')->display(function ($val, $data) {
            return Html::div()->content([
                Image::create()
                    ->style(['width' => '60px', 'height' => '60px', 'marginRight' => '10px', "borderRadius" => '5px'])
                    ->src($data->getLogo())
                    ->whenShow($data->getLogo()),
                Html::div()->content([
                    Html::div()->when(empty($data['authorized']), function (Html $html) use ($data) {
                        $html->content(Badge::create()->content(
                            Tag::create($data['title'])->color('#1890ff')
                        )->count('未授权')->type('danger')
                        );
                    }, function (Html $html) use ($data) {
                        $html->content(Tag::create($data['title'])->color('#1890ff'));
                    }),
                    Html::div()->content($data['name']),
                    Html::div()->content($data['description'])
                ])
            ])->style(['display' => 'flex', 'alignItems' => 'center', 'alignContent' => 'center']);
        });
        $grid->column('price', '价格')->display(function ($val, $data) {
            if (!isset($data['is_free'])) {
                return '--';
            } elseif (empty($data['is_free'])) {
                return Html::create('￥' . $data['price'])->style(['color' => 'red']);
            } else {
                return '免费';
            }
        });
        $grid->column('version', '版本');
        $grid->actions(function (Actions $actions, $data) {
            $actions->hideDel();
            $dropdown = Dropdown::create(
                Button::create(
                    [
                        '安装',
                        Icon::create('DownOutlined')->style(['marginRight'=>'5px'])
                    ]
                )
            )->trigger(['click'])->whenShow(!$data->installed());
//            $dropdown->item('1.0.0')->confirm($data->enabled() ? '确认禁用？' : '确认启用？', [$this, 'enable'], ['name' => $data['name'], 'status' => !$data['status']]);
//            $dropdown->item('1.1.0')->confirm($data->enabled() ? '确认禁用？' : '确认启用？', [$this, 'enable'], ['name' => $data['name'], 'status' => !$data['status']]);

            $actions->append([
                Button::create('上传到插件市场')
                    ->modal($this->uploadForm($data->getInfo()))
                    ->width('70%')
                    ->whenShow(empty($data['online'])),
                Button::create('设置')
                    ->whenShow(method_exists($data, 'setting'))
                    ->when(method_exists($data, 'setting'), function ($button) use ($data) {
                        return $button->modal($data->setting())->width('50%');
                    }),
                Button::create($data->enabled() ? '禁用' : '启用')
                    ->when(!$data->enabled(), function ($button) {
                        $button->type('primary');
                    })
                    ->confirm($data->enabled() ? '确认禁用？' : '确认启用？', [$this, 'enable'], ['name' => $data['name'], 'status' => !$data['status']])
                    ->whenShow($data->installed())
                    ->gridRefresh(),
                Button::create('卸载')
                    ->type('danger')
                    ->confirm('确认卸载？', [$this, 'uninstall'], ['name' => $data['name']])
                    ->whenShow($data->installed())
                    ->gridRefresh(),
                $dropdown

            ]);
        });
        $grid->quickSearch();
        $grid->tools([
            Button::create('创建插件')
                ->modal($this->create()),
            Button::create('生成IDE')->ajax([$this, 'ide'])
        ]);
        $grid->hideDelete();
        $grid->hideSelection();
        return $grid;
    }

    /**
     * 上传到插件市场
     * @param $data
     * @return Form
     */
    public function uploadForm($data){
        return Form::create($data, function (Form $form) {
            $form->text('name', '扩展标识')
                ->ruleAlphaDash()
                ->required();
            $form->text('author', '作者')->required();
            $form->text('title', '名称')->required();
            $form->text('description', '描述');
            $form->editor('content', '介绍内容');
            $form->text('version', '版本号');
            $form->textarea('version_content', '版本说明')->rows(5);
            $form->saved(function (Form $form){
                $result = plugin()->upload($form->input());
                if($result !== true){
                    return message_error($result);
                }
            });
        });
    }
    /**
     * 创建插件
     * @return Form
     */
    public function create()
    {
        return Form::create([], function (Form $form) {
            $form->text('name', '扩展标识')->ruleAlphaDash()->required();
            $form->text('author', '作者')->required();
            $form->text('title', '名称')->required();
            $form->text('description', '描述');
            $form->saved(function (Form $form) {
                $data = $form->input();
                extract($data);
                plugin()->create($author, $name, $title, $description);
                plugin()->buildIde();
            });

        });
    }

    /**
     * 卸载
     * @param $name
     * @return \ExAdmin\ui\response\Message
     */
    public function uninstall($name)
    {
        $plug = plugin()->uninstall($name);
        return message_success('操作完成');
    }

    /**
     * 禁用/启用
     * @param $name
     * @param $status
     * @return \ExAdmin\ui\response\Message
     */
    public function enable($name, $status)
    {
        $plug = plugin()->getPlug($name);
        if ($status) {
            $plug->enable();
        } else {
            $plug->disable();
        }
        return message_success('操作完成');
    }

    /**
     * 生成ide
     * @return \ExAdmin\ui\response\Message
     */
    public function ide()
    {
        plugin()->buildIde();
        return message_success('操作完成');
    }
}
