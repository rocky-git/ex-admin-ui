<?php

namespace ExAdmin\ui\traits;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Copy;
use ExAdmin\ui\component\common\DownloadFile;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\common\Video;
use ExAdmin\ui\component\feedback\Progress;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\form\field\Switches;
use ExAdmin\ui\component\grid\badge\Badge;
use ExAdmin\ui\component\grid\grid\Column;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\image\ImagePreviewGroup;
use ExAdmin\ui\component\grid\Popover;
use ExAdmin\ui\component\grid\statistic\Statistic;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\component\grid\ToolTip;
use ExAdmin\ui\support\Arr;

trait Display
{
    public $using = [];

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
        return $this->display(function ($value) use ($count, $allowHalf, $character, $toolTips) {
            return Rate::create(null, $value)
                ->disabled()
                ->tooltips($toolTips)
                ->count($count)
                ->allowHalf(true)
                ->character($character);
        });
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
        return $this->display(function ($value) use ($width, $placement, $color, $trigger) {
            return ToolTip::create(
                Html::create($value)
                    ->tag('div')
                    ->style([
                        'width' => "{$width} px",
                        'textOverflow' => 'ellipsis',
                        'overflow' => 'hidden',
                        'whiteSpace' => 'nowrap',
                    ]))
                ->title($value)
                ->placement($placement)
                ->trigger($trigger)
                ->color($color);
        })->width($width);
    }

    /**
     * 标签显示
     * @param string $color 标签颜色
     * @param mixed $icon 图标
     */
    public function tag($color = 'blue', $icon = '')
    {
        return $this->display(function ($value) use ($color, $icon) {
            return $this->getTag($this->getArrayValue($value), $color, $icon);
        });
    }


    /**
     * 获取标签
     * @param string $color 标签颜色
     * @param mixed $icon 图标
     */
    protected function getTag($value, string $color = '', string $icon = '')
    {
        if (is_array($value)) {
            $tags = [];
            foreach ($value as $item) {
                $tags[] = $this->getTag($item, $color, $icon);
            }
            return $tags;
        } else {
            return Tag::create($value)
                ->color($color)
                ->icon($icon);
        }
    }

    /**
     * 图片
     * @param string $value 值
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $alt 图像描述
     * @param bool $preview 预览参数
     * @return $this
     */
    protected function commonImage(string $value, int $width = 80, int $height = 80, string $alt = '', bool $preview = true)
    {
        if(empty($value)){
            return $value;
        }
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
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $alt 图像描述
     * @param bool $preview 预览参数
     * @return $this
     */
    public function image(int $width = 80, int $height = 80, string $alt = '', bool $preview = true)
    {
        return $this->display(function ($value) use ($width, $height, $alt, $preview) {
            return $this->commonImage($value, $width, $height, $alt, $preview);
        });
    }

    /**
     * 多图片
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $alt 图像描述
     * @param string[] $style 样式，margin-right这种采用小驼峰命名
     * @return $this
     */
    public function images(int $width = 80, int $height = 80, string $alt = '', $style = ['marginRight' => '5px', 'marginBottom' => '5px'])
    {
        return $this->display(function ($value) use ($width, $height, $alt, $style) {
            if (empty($value)) return '';
            $value = $this->getArrayValue($value);
            $html = [];
            foreach ($value as $image) {
                $html[] =
                    Html::create(
                        $this->commonImage($image, $width, $height, $alt, false)
                    )
                        ->tag('div')
                        ->style($style);
            }
            return ImagePreviewGroup::create(Html::create($html)->tag('div')->style(['display' => 'flex']));
        });
    }

    /**
     * 音频显示
     * @param int $width 宽度
     * @param int $height 高度
     * @return mixed
     */
    public function audio($width = 300, $height = 54)
    {
        return $this->display(function ($value) use ($width, $height) {
            return Html::create('您的浏览器不支持 audio 标签。')
                ->attr('src', $value)
                ->attr('controls', true)
                ->tag('audio')
                ->style(["width" => "{$width}px", 'height' => "{$height}px"]);
        });
    }

    /**
     * 视频显示
     * @param int|string $width 宽度
     * @param int|string $height 高度
     * @return $this
     */
    public function video($width = 200, $height = 100)
    {
        return $this->display(function ($value) use ($width, $height) {
            return Video::create()->url($value)->size($width, $height);
        })->width($width);
    }

    /**
     * 进度条
     * @param string $type line(线形) circle(圆形) dashboard(仪表盘)
     * @param int $width 宽度
     * @param string $status success exception normal active(仅限 line)
     * @param string[]|string $strokeColor 进度条的色彩，渐变设置 ['0%' => '#108ee9', '100%' => '#87d068']
     * @param string $trailColor 未完成的分段的颜色
     * @return $this
     */
    public function progress(string $type = 'line', int $width = 80, string $status = 'normal', $strokeColor = '', string $trailColor = '')
    {
        return $this->display(function ($value) use ($type, $width, $status, $strokeColor, $trailColor) {
            $process = Progress::create()
                ->percent($value)
                ->type($type)
                ->width($width)
                ->status($status);
            if (!empty($strokeColor)) $process->strokeColor($strokeColor);
            if (!empty($trailColor) && !is_array($strokeColor)) $process->trailColor($trailColor);
            return $process;
        });
    }

    /**
     * 统计数值
     * @param int $precision 数值精度(保留小数位)
     * @param mixed $prefix 设置数值的前缀
     * @param mixed $suffix 设置数值的后缀
     * @param string $groupSeparator 设置千分位标识符
     * @return $this
     */
    public function statistic(int $precision = 0, $prefix = '', $suffix = '', string $groupSeparator = ',')
    {
        return $this->display(function ($value) use ($precision, $prefix, $suffix, $groupSeparator) {
            $statistic = Statistic::create()
                ->value($value)
                ->precision($precision)
                ->groupSeparator($groupSeparator);
            if (!empty($prefix)) $statistic->prefix($prefix);
            if (!empty($suffix)) $statistic->suffix($suffix);
            return $statistic;
        });
    }

    /**
     * 跳转链接
     * @param string $field 字段，不指定则显示当前value
     * @param string $target 打开方式 _blank(在新窗口中打开) / _self(在相同的窗口打开) / _parent(在父窗口打开) / _top(在整个窗口中)
     * @return $this
     */
    public function link($field = '', $target = '_blank')
    {
        return $this->display(function ($value, $data) use ($field, $target) {
            $href = $this->getAssignValue($value, $data, $field);
            return Html::create($href)
                ->attr('href', $href)
                ->attr('target', $target)
                ->tag('a');
        });
    }

    /**
     * 弹出框
     * @param string $field 指定字段
     * @param string $label 按钮名称
     * @param string $width 宽度
     * @param string $tigger 触发方式  click/focus/hover/manual
     * @param string $placement 出现位置 top/top-start/top-end/bottom/bottom-start/bottom-end/left/left-start/left-end/right/right-start/right-end
     * @return $this
     */
    public function popover($field = '', $label = '查看', $width = '500px', $tigger = 'hover', $placement = 'top')
    {
        return $this->display(function ($value, $data) use ($field, $label, $width, $tigger, $placement) {
            $value = $this->getAssignValue($value, $data, $field);
            if (empty($value)) return '';
            $value = $this->getArrayValue($value);
            return Popover::create(Button::create($label))
                ->content($this->getTag($value))
                ->width($width)
                ->trigger($tigger)
                ->placement($placement);
        });
    }

    /**
     * 文件显示
     * @return $this
     */
    public function file()
    {
        return $this->display(function ($value) {
            if (empty($value)) {
                return $value;
            }
            if (is_string($value)) {
                $value = [$value];
            }
            $html = Html::create()->tag('div');
            foreach ($value as $val) {
                $html->content(DownloadFile::create()->url($val));
            }
            return $html;
        });
    }

    /**
     * 追加前面
     * @param mixed $prepend 内容
     * @return $this
     */
    public function prepend($prepend)
    {
        return $this->display(function ($val) use ($prepend) {
            return $prepend . $val;
        });
    }

    /**
     * 追加末尾
     * @param mixed $append 内容
     * @return $this
     */
    public function append($append)
    {
        return $this->display(function ($val) use ($append) {
            return $val . $append;
        });

    }

    /**
     * 内容映射
     * @param array $usings 映射内容
     * @param array $color 标签颜色
     */
    public function using(array $usings, array $color = [])
    {
        $this->using = $usings;
        return $this->display(function ($value) use ($usings, $color) {
            if (isset($usings[$value])) {
                $value = $usings[$value];
            }
            if (count($color) > 0) {
                return $this->getTag($value, $color[$value] ?? '');
            }
            return $value;
        });

    }

    /**
     * 复制
     * @param string $content 复制内容
     * @return mixed
     */
    public function copy($content = null)
    {
        return $this->display(function ($value) use ($content) {
            $content = is_null($content) ? $value : $content;
            return Html::div()->content([
                $value,
                Copy::create($content)
            ])->attr('class', 'ex-admin-editable-cell');
        });

    }

    /**
     * 获取指定值
     * @param mixed $value 值
     * @param array $data 行数据
     * @param string $field 指定字段
     * @return array|\ArrayAccess|mixed|null
     */
    public function getAssignValue($value, $data, $field = '')
    {
        return $field ? Arr::get($data, $field) : $value;
    }

    /**
     * 字符串转数组
     * @param $value
     * @return false|string[]
     */
    public function getArrayValue($value)
    {
        return is_string($value) ? explode(',', $value) : $value;
    }
}
