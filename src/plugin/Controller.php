<?php
namespace ExAdmin\ui\plugin;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\component\grid\badge\Badge;
use ExAdmin\ui\component\grid\card\Card;
use ExAdmin\ui\component\grid\grid\Actions;
use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\tabs\Tabs;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\support\Container;
use Illuminate\Support\Facades\Log;

class Controller
{
    public function index(){
        $tabs = Tabs::create();
        $tabs->pane('全部',$this->grid());
        $tabs->pane('已安装',$this->grid());
        return Card::create($tabs)->title('插件管理');
    }
    public function grid(){
        $grid = Grid::create(Container::getInstance()->plugin->getPlug());
        $grid->column('title', '名称')->display(function ($val, $data) {
            return Html::div()->content([
                Image::create()
                    ->style(['width'=>'60px','height'=>'60px','marginRight'=>'10px',"borderRadius" => '5px'])
                    ->src($data->getLogo())
                    ->whenShow($data->getLogo()),
                Html::div()->content([
                    Html::div()->when(empty($data['authorized']),function (Html $html)use($data){
                        $html->content(Badge::create()->content(
                            Tag::create($data['title'])->color('#1890ff')
                        )->count('未授权')->type('danger')
                        );
                    },function (Html $html) use($data){
                        $html->content(Tag::create($data['title'])->color('#1890ff'));
                    }),
                    Html::div()->content($data['name']),
                    Html::div()->content($data['description'])
                ])
            ])->style(['display'=>'flex','alignItems' => 'center','alignContent' => 'center']);
        });
        $grid->column('price', '价格')->display(function ($val,$data){
            if(!isset($data['is_free'])){
                return '--';
            }elseif(empty( $data['is_free'])){
                return Html::create('￥'.$data['price'])->style(['color'=>'red']);
            }else{
                return '免费';
            }
        });
        $grid->column('version', '版本');
        $grid->actions(function (Actions  $actions,$data){
            $actions->hideDel();
            $actions->append([
                Button::create($data->enabled()?'禁用':'启用')
                    ->when(!$data->enabled(),function ($button){
                        $button->type('primary');
                    })
                    ->confirm($data->enabled()?'确认禁用？':'确认启用？',[$this,'enable'],['name'=>$data['name'],'status'=>!$data['status']])
                    ->gridRefresh()
            ]);
        });
        $grid->quickSearch();
        $grid->tools([
            Button::create('创建插件')
                ->modal($this->create())
        ]);
        $grid->hideDelete();
        $grid->hideSelection();
        return $grid;
    }
    public function enable($name,$status){
        $plug = Container::getInstance()->plugin->getPlug($name);
        if($status){
            $plug->enable();
        }else{
            $plug->disable();
        }
        return message_success('操作完成');
    }
    /**
     * 创建插件
     * @return Form
     */
    public function create(){
        return Form::create([],function (Form $form){
            $form->text('name','扩展标识')->required();
            $form->text('author','作者')->required();
            $form->text('title','名称')->required();
            $form->text('description','描述');
            $form->saved(function (Form $form) {
                $data = $form->input();
                extract($data);
                Container::getInstance()->plugin->create($author,$name,$title,$description);
            });
        });
    }
}
