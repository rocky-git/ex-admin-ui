<?php

namespace ExAdmin\ui\plugin;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Copy;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\common\Icon;
use ExAdmin\ui\component\common\typography\TypographyText;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\form\FormAction;
use ExAdmin\ui\component\grid\badge\Badge;
use ExAdmin\ui\component\grid\card\Card;
use ExAdmin\ui\component\grid\grid\Actions;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\tabs\Tabs;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\component\grid\timeline\TimeLine;
use ExAdmin\ui\component\grid\ToolTip;
use ExAdmin\ui\component\navigation\dropdown\Dropdown;
use ExAdmin\ui\response\Response;

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
        return Grid::create(new \ExAdmin\ui\component\grid\grid\driver\Plugin(), function (Grid $grid) {
            $grid->driver()->setPk('name');
            $grid->column('title', '名称')->display(function ($val, $data) {
                return Html::div()->content([
                    Image::create()
                        ->style(['width' => '60px', 'height' => '60px', 'marginRight' => '10px', "borderRadius" => '5px'])
                        ->src($data->getLogo())
                        ->whenShow($data->getLogo()),
                    Html::div()->content([
                        Html::div()->when(empty($data['authorized']) && $data->installed(), function (Html $html) use ($data) {
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
            $grid->column('author','作者');
            $grid->column('price', '价格')->display(function ($val, $data) {
                if (!isset($data['is_free'])) {
                    return '--';
                } elseif (empty($data['is_free'])) {
                    return Html::create('￥' . $data['price'])->style(['color' => 'red']);
                } else {
                    return '免费';
                }
            });
            $grid->column('version', '版本')
                ->header(ToolTip::create(
                    Html::create('版本')
                        ->content(
                            Icon::create('QuestionCircleOutlined')->style(['marginLeft' => '5px'])
                        )
                )->title('点击查看历史版本'))
                ->display(function ($val, $data) {
                    $tag = Tag::create($val);
                    if (!empty($data['versions'])) {
                        $timeLine = TimeLine::create();
                        foreach ($data['versions'] as $item) {
                            $timeLine->item(Html::div()->content([
                                ToolTip::create(
                                    Tag::create($item['version'])
                                        ->style(['cursor' => 'pointer'])
                                        ->modal()
                                        ->width('80%')
                                        ->title($item['version'].' 介绍说明')
                                        ->content(Html::markdown($item['content'])),
                                 )->title('查看介绍说明'),
                                Html::create($item['version_content'])->tag('pre'),
                            ]));
                        }
                        $tag = $tag->modal()
                            ->title('历史版本')
                            ->content($timeLine);
                    }
                    return $tag;
                });
            $grid->column('status')->when(function ($val, $data) {
                return $data->installed();
            }, function (Column $column) {
                $column->switch([
                    'on' => ['value' => true, 'text' => '启用'],
                    'off' => ['value' => false, 'text' => '禁用'],
                ]);
            });
            $grid->actions(function (Actions $actions, $data) {
                $actions->hideDel();
                $dropdown = null;
                if(!empty($data['versions'])){
                    $dropdown = Dropdown::create(
                        Button::create(
                            [
                                $data->installed()?'更新':'安装',
                                Icon::create('DownOutlined')->style(['marginRight' => '5px'])
                            ]
                        )
                    )->trigger(['click']);
                    foreach ($data['versions'] as $item) {
                        if($data->installed()){
                            $dropdown->item($item['version'])
                                ->confirm('更新版本可能会覆盖数据，请谨慎操作',[$this, 'onlineInstall'], ['name' => $data['name'], 'version' => $item['version'],'update'=>true])
                                ->gridRefresh();
                        }else{
                            $dropdown->item($item['version'])
                                ->ajax([$this, 'onlineInstall'], ['name' => $data['name'], 'version' => $item['version']])
                                ->gridRefresh();
                        }

                    }
                }
                $actions->append([
                    Button::create('上传到插件市场')
                        ->modal($this->uploadForm($data->getInfo()))
                        ->width('70%')
                        ->whenShow(empty($data['online']) && plugin()->token()),
                    Button::create('更新到插件市场')
                        ->modal($this->uploadForm($data->getInfo(), 1))
                        ->width('70%')
                        ->whenShow($data->installed() && !empty($data['online']) && plugin()->token() && plugin()->token(true) == $data['uid']),
                    Button::create('设置')
                        ->whenShow(method_exists($data, 'setting'))
                        ->when(method_exists($data, 'setting'), function ($button) use ($data) {
                            return $button->modal($data->setting())->width('50%');
                        }),
                    $dropdown,
                    Button::create('卸载')
                        ->type('danger')
                        ->confirm([
                            Html::div()->content('确认卸载《' . $data['title'] . '》?'),
                            Html::div()->content('卸载将会删除所有插件文件且不可找回')->style(['color' => 'red'])
                        ], [$this, 'uninstall'], ['name' => $data['name']])
                        ->whenShow($data->installed() && $data['name'] != php_frame())
                        ->gridRefresh(),
                ]);
            });
            $grid->quickSearch();
            $grid->header([
                Button::create('创建插件')
                    ->modal($this->create()),
                Button::create('生成IDE')->ajax([$this, 'ide']),
                Button::create('本地安装')
                    ->upload([$this, 'localInstall'])
                    ->style(['margin' => '0 8px']),
                Button::create('登陆')
                    ->type('primary')
                    ->modal([$this, 'login'])
                    ->whenShow(!plugin()->token()),
                Button::create('退出登陆')
                    ->ajax([$this, 'logout'])
                    ->whenShow(plugin()->token())
                    ->gridRefresh(),
            ]);
            $grid->hideDelete();
            $grid->hideSelection();
        });

    }
    public function intallView($name,$version){
        return admin_view(__DIR__.'/view/install.vue');
    }
    /**
     * 退出登陆
     * @return \ExAdmin\ui\response\Message
     */
    public function logout()
    {
        setcookie('plugin_token', '', time() - 3600);
        return message_success('已退出登陆');
    }

    /**
     * 登陆
     * @return Form
     */
    public function login()
    {
        return Form::create([], function (Form $form) {
            $form->removeAttr('labelCol');
            $form->push(
                TypographyText::create()
                    ->type('secondary')
                    ->style(['marginBottom'=>'10px','display'=>'flex','justify-content'=>'flex-end'])
                    ->content('还未注册？')
                    ->redirect('https://www.ex-admin.com/register')
            );
            $form->text('username')
                ->prefix(Icon::create('fas fa-user-alt'))
                ->placeholder('你的手机号、邮箱')
               ;
            $form->password('password')
                ->prefix(Icon::create('fas fa-key'))
                ->placeholder('你的密码');
            $form->saved(function (Form $form) {
                $result = plugin()->login($form->input('username'), $form->input('password'));
                if ($result !== true) {
                    return message_error($result);
                }
                return message_success('登陆成功');
            });
        });
    }

    /**
     * 上传到插件市场
     * @param $data
     * @return Form
     */
    public function uploadForm($data, $update = 0)
    {
        return Form::create($data, function (Form $form) use ($update) {
            $form->select('cate_id', '分类')
                ->options(array_column(plugin()->getCate(), 'name', 'id'))
                ->required();
            $form->select('frame', '支持框架')
                ->options([
                    'thinkphp'=>'thinkphp',
                    'laravel'=>'laravel',
                    'hyperf'=>'hyperf',
                ])
                ->default([php_frame()])
                ->multiple()
                ->required();
            $form->text('name', '扩展标识')
                ->ruleAlphaDash()
                ->required();
            $form->text('author', '作者')->required();
            $form->text('title', '名称')->required();
            $form->text('description', '描述');
            $form->radio('is_free', '收费类型')
                ->options([0 => '收费', 1 => '免费'])
                ->default(1)
                ->when(0, function (Form $form) {
                    $form->row(function (Form $form) {
                        $form->number('cost_price', '原价')->required();
                        $form->number('price', '售价')->required();
                    }, '标准授权');
                    $form->row(function (Form $form) {
                        $form->number('high_cost_price', '原价')->required();
                        $form->number('high_price', '售价')->required();
                    }, '高级授权');
                });
            $form->mdEditor('content', '介绍内容');
            $form->radio('public_type','发布环境')
                ->options([1=>'测试',2=>'正式'])
                ->default(1)
                ->when(2,function (Form $form){
                    $form->text('version', '版本号');
                });
            $form->textarea('version_content', '版本说明')->rows(5);
            $form->saved(function (Form $form) use ($update) {
                if($form->input('public_type') == 1){
                    $form->input('version','dev');
                }
                $result = plugin()->upload($form->input(), (bool)$update);
                if ($result !== true) {
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
     * 在线安装
     * @param string $name
     * @param string$version
     * @param bool $update
     * @return \ExAdmin\ui\response\Message
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function onlineInstall($name, $version,$update = false)
    {
        if (!plugin()->token()) {
            return message_error('请登录后操作！');
        }
        try {
            $path = plugin()->download($name, $version);
        } catch (PluginException $exception) {
            return message_error($exception->getMessage());
        }
        if ($path === false) {
            return message_error('文件下载失败');
        }
        $force = false;
        if($name == php_frame()){
            $force = true;
        }
        if($update && !$force){
            $plug = plugin()->uninstall($name);
        }
        return $this->install($path,$force);
    }

    /**
     * 本地安装
     */
    public function localInstall()
    {
        return $this->install($_FILES['file']['tmp_name']);
    }

    protected function install($path,$force)
    {
        $result = plugin()->install($path,$force);
        unlink($path);
        if ($result === true) {
            if(php_frame() == 'laravel'){
                $cmd = 'php artisan plugin:composer';
            }elseif (php_frame() == 'thinkphp'){
                $cmd = 'php think plugin:composer';
            }
            return notification_success('安装完成',Html::div()->content([
                Html::div()->content('安装插件依赖请手动执行命令'),
                Html::create($cmd)->style(['color'=>'red']),
                Copy::create($cmd) ->style(['cursor'=>'pointer','marginLeft'=>'5px'])
            ]),['duration'=>10])->refreshMenu();
        }
        return message_error($result);
    }

    /**
     * 卸载
     * @param $name
     * @return \ExAdmin\ui\response\Message
     */
    public function uninstall($name)
    {
        $plug = plugin()->uninstall($name);
        return message_success('操作完成')->refreshMenu();
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
