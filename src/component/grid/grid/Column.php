<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\image\ImagePreviewGroup;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\component\grid\ToolTip;
use ExAdmin\ui\support\Arr;

/**
 * 表格列
 * Class Column
 * @method $this dataIndex(string $value) 对应列内容的字段名
 * @method $this header(string $value)    自定义内容
 */
class Column extends Component
{
    protected $name = 'ATableColumn';

    protected $grid;

    protected $closure = null;

    public function __construct($field, $label = '', Grid $grid)
    {
        $this->grid = $grid;
        $this->dataIndex($field);
        if (!empty($label)) {
            $this->attr('title', $label);
            $this->header(
                Html::create($label)->attr('class', 'ex_admin_table_th_' . $this->attr('dataIndex'))
            );
        }
    }

    /**
     * 解析每行数据
     * @param array $data 数据
     * @return mixed
     */
    public function row($data)
    {

        $field = $this->attr('dataIndex');
        $originValue = Arr::get($data, $field);
        if (is_null($originValue)) {
            //空默认占位符
            $value = '--';
        } else {
            $value = $originValue;
        }
        //自定义内容显示处理
        if (!is_null($this->closure)) {
            $value = call_user_func_array($this->closure, [$originValue, $data]);
        }
        $html = Html::create($value)->attr('class', 'ex_admin_table_td_' . $field);
        $fontSize = $this->grid->attr('fontSize');
        if ($fontSize) {
            $html->style(['fontSize' => $fontSize . 'px']);
        }
        return $html;
    }

    /**
     * 星级
     * @param int $count star总数
     * @param bool $allowHalf 是否允许半选
     * @param string[] $toolTips 自定义每项的提示信息
     * @param mixed $character 自定义字符
     * @return $this
     */
    public function rate(int $count = 5, bool $allowHalf = false, array $toolTips = [], $character = '<StarOutlined />')
    {
        $this->display(function ($value) use ($count, $allowHalf, $character, $toolTips) {
            return Rate::create(null, $value)
                       ->disabled()
                       ->tooltips($toolTips)
                       ->count($count)
                       ->allowHalf(true)
                       ->character($character);
        });
        return $this;
    }

    /**
     * 文字提示
     * @param int $width 宽度
     * @param string $placement 气泡框位置 top left right bottom topLeft topRight bottomLeft bottomRight leftTop leftBottom rightTop rightBottom
     * @param string $color 背景颜色
     * @param string $trigger 触发行为  hover/focus/click/contextmenu
     * @return $this
     */
    public function tip(int $width = 150, string $placement = 'top', string $color = '', string $trigger = 'hover')
    {
        $this->display(function ($value) use ($width, $placement, $color, $trigger) {
            return ToolTip::create(
                Html::create($value)
                    ->tag('div')
                    ->style([
                        'width'        => "{$width} px",
                        'textOverflow' => 'ellipsis',
                        'overflow'     => 'hidden',
                        'whiteSpace'   => 'nowrap',
                    ]))
                          ->title($value)
                          ->placement($placement)
                          ->trigger($trigger)
                          ->color($color);
        })->width($width);
        return $this;
    }

    /**
     * 开启排序 #TODO 没有排序效果
     * @return $this
     */
    public function sortable()
    {
        $this->attr('sorter', true);
        return $this;
    }

    /**
     * 标签显示
     * @param string $color 标签颜色
     * @param mixed $icon 图标
     */
    public function tag($color = '#87d068', $icon = '')
    {
        $this->display(function ($value) use ($color, $icon) {
            return Tag::create($value)
                      ->color($color)
                      ->icon($icon);
        });
        return $this;
    }

    /**
     * 图片
     * @param string $value 值
     * @param int $height 高度
     * @param int $width 宽度
     * @param string $alt 图像描述
     * @param bool $preview 预览参数
     * @return $this
     */
    protected function commonImage(string $value, int $height = 80, int $width = 80, string $alt = '', bool $preview = true)
    {
        $image = Image::create()
                      ->src($value)
                      ->height("{$height}px")
                      ->width("{$width}px")
                      ->alt($alt ?: $this->attr('title'));
        if ($preview) $image->preview($preview);
        return $image;
    }

    /**
     * 单图片
     * @param int $height 高度
     * @param int $width 宽度
     * @param string $alt 图像描述
     * @param bool $preview 预览参数
     * @return $this
     */
    public function image(int $height = 80, int $width = 80, string $alt = '', bool $preview = true)
    {
        $this->display(function ($value) use ($height, $width, $alt, $preview) {
            return $this->commonImage($value, $height, $width, $alt, $preview);
        });
        return $this;
    }

    /**
     * 多图片
     * @param int $height 高度
     * @param int $width 宽度
     * @param string $alt 图像描述
     * @param string[] $style 样式，margin-right这种采用小驼峰命名
     * @return $this
     */
    public function images(int $height = 80, int $width = 80, string $alt = '', $style = ['marginRight' => '5px', 'marginBottom' => '5px'])
    {
        $this->display(function ($value) use ($height, $width, $alt, $style) {
            if (empty($value)) return '';
            if (is_string($value)) $value = explode(',', $value);
            $html = [];
            foreach ($value as $image) {
                $html[] =
                    Html::create(
                        $this->commonImage($image, $height, $width, $alt, false)
                    )
                        ->tag('div')
                        ->style($style);
            }
            return ImagePreviewGroup::create(Html::create($html)->tag('div')->style(['display' => 'flex']));
        });
        return $this;
    }

    /**
     * 音频显示 #TODO
     * @return $this
     */
    public function audio()
    {
        $this->display(function ($value) {
            return Html::create()
                ->attr('src', $val)
                ->content('您的浏览器不支持 audio 标签。')
                ->tag('audio');
        });
        return $this;
    }

    /**
     * 自定义显示
     * @param \Closure $closure
     * @return $this
     */
    public function display(\Closure $closure)
    {
        $this->closure = $closure;
        return $this;
    }

}
