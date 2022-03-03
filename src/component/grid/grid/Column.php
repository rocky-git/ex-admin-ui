<?php

namespace ExAdmin\ui\component\grid\grid;

use ExAdmin\ui\component\common\Button;
use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\feedback\Process;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\form\field\Switches;
use ExAdmin\ui\component\grid\image\Image;
use ExAdmin\ui\component\grid\image\ImagePreviewGroup;
use ExAdmin\ui\component\grid\Popover;
use ExAdmin\ui\component\grid\statistic\Statistic;
use ExAdmin\ui\component\grid\tag\Tag;
use ExAdmin\ui\component\grid\ToolTip;
use ExAdmin\ui\support\Arr;

/**
 * 表格列
 * Class Column
 * @method $this dataIndex(string $value) 对应列内容的字段名
 * @method $this header(string $value)    自定义内容
 * @method $this width(int $width) 宽度
 */
class Column extends Component
{
    protected $name = 'ATableColumn';

    protected $grid;

    protected $closure = null;

    protected $hide = false;

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
     * 隐藏
     * @return \Eadmin\grid\Column|$this
     */
    public function hide()
    {
        $this->hide = true;
        $this->attr('hide', true);
        return $this;
    }

    /**
     * 获取当前列是否隐藏
     * @return bool
     */
    public function isHide()
    {
        return $this->hide;
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
     * 标签显示
     * @param string $color 标签颜色
     * @param mixed $icon 图标
     */
    public function tag($color = '#2db7f5', $icon = '')
    {
        $this->display(function ($value) use ($color, $icon) {
            return $this->getTag($value, $color, $icon);
        });
        return $this;
    }


    /**
     * 多个标签
     * @param string $field 指定字段
     * @param string $color 颜色
     * @param string $icon 图标
     * @return $this
     */
    public function tags($field = '', $color = '#2db7f5', $icon = '')
    {
        $this->display(function ($value, $data) use ($field, $color, $icon) {
            $valueData = $this->getAssignValue($value, $data, $field);
            if (empty($valueData)) return '';
            $valueData = $this->getArrayValue($valueData);
            return $this->getTags($valueData, $color, $icon);
        });
        return $this;
    }

    /**
     * 标签组组装
     * @param array $value 数据
     * @param string $color 标签颜色
     * @param mixed $icon 图标
     * @param array $style 样式
     * @return Html
     */
    public function getTags(array $dataSource = [], string $color = '#2db7f5', string $icon = '')
    {
        $html = [];
        foreach ($dataSource as $data) {
            $html[] = $this->getTag($data, $color, $icon);
        }
        return Html::create($html)
                   ->tag('div')
                   ->style(['display' => 'flex', 'flexWrap' => 'wrap']);
    }

    /**
     * 获取标签
     * @param string $color 标签颜色
     * @param mixed $icon 图标
     */
    protected function getTag($value, string $color, string $icon = '')
    {
        return Tag::create($value)
                  ->color($color)
                  ->icon($icon);
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
    protected function commonImage(string $value, int $width = 80, int $height = 80 , string $alt = '', bool $preview = true)
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
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $alt 图像描述
     * @param bool $preview 预览参数
     * @return $this
     */
    public function image(int $width = 80, int $height = 80, string $alt = '', bool $preview = true)
    {
        $this->display(function ($value) use ($width, $height, $alt, $preview) {
            return $this->commonImage($value, $width, $height, $alt, $preview);
        });
        return $this;
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
        $this->display(function ($value) use ($width, $height, $alt, $style) {
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
        return $this;
    }

    /**
     * 音频显示
     * @return $this
     */
    public function audio($width = 300, $height = 54)
    {
        $this->display(function ($value) use ($width, $height) {
            return Html::create('您的浏览器不支持 audio 标签。')
                       ->attr('src', $value)
                       ->attr('controls', true)
                       ->tag('audio')
                        ->style(["width" => "{$width}px", 'height' => "{$height}px"]);
        });
        return $this;
    }

    /**
     * 视频 #TODO
     * @return $this
     */
    public function video()
    {
        $this->display(function ($value) {

        });
        return $this;
    }

    /**
     * 进度条
     * @param string $type  line(线形) circle(圆形) dashboard(仪表盘)
     * @param int $width 宽度
     * @param string $status success exception normal active(仅限 line)
     * @param string[]|string $strokeColor 进度条的色彩，渐变设置 ['0%' => '#108ee9', '100%' => '#87d068']
     * @param string $trailColor 未完成的分段的颜色
     * @return $this
     */
    public function process(string $type = 'line', int $width = 80, string $status = 'normal', $strokeColor = '', string $trailColor = '')
    {
        $this->display(function ($value) use ($type, $width, $status, $strokeColor, $trailColor) {
            $process = Process::create()
                ->percent($value)
                ->type($type)
                ->width($width)
                ->status($status);
            if (!empty($strokeColor)) $process->strokeColor($strokeColor);
            if (!empty($trailColor) && !is_array($strokeColor)) $process->trailColor($trailColor);
            return $process;
        });
        return $this;
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
        $this->display(function ($value) use ($precision, $prefix, $suffix, $groupSeparator) {
            $statistic = Statistic::create()
                ->value($value)
                ->precision($precision)
                ->groupSeparator($groupSeparator);
            if (!empty($prefix)) $statistic->prefix($prefix);
            if (!empty($suffix)) $statistic->suffix($suffix);
            return $statistic;
        });
        return $this;
    }

    /**
     * 跳转链接
     * @param string $field 字段，不指定则显示当前value
     * @param string $target 打开方式 _blank(在新窗口中打开) / _self(在相同的窗口打开) / _parent(在父窗口打开) / _top(在整个窗口中)
     * @return $this
     */
    public function link($field = '', $target = '_blank')
    {
        $this->display(function ($value, $data) use ($field, $target) {
            $href = $this->getAssignValue($value, $data, $field);
            return Html::create($href)
                       ->attr('href', $href)
                       ->attr('target', $target)
                       ->tag('a');
        });
        return $this;
    }

    /**
     * 弹出框 #TODO
     * @param string $field 指定字段
     * @param string $label 按钮名称
     * @param string $width 宽度
     * @param string $tigger 触发方式  click/focus/hover/manual
     * @param string $placement 出现位置 top/top-start/top-end/bottom/bottom-start/bottom-end/left/left-start/left-end/right/right-start/right-end
     * @return $this
     */
    public function popover($field = '', $label = '查看', $width = '500px', $tigger = 'hover', $placement = 'top')
    {
        $this->display(function ($value, $data) use ($field, $label, $width, $tigger, $placement) {
            $value = $this->getAssignValue($value, $data, $field);
            if (empty($value)) return '';
            $value = $this->getArrayValue($value);
            return Popover::create(Button::create($label))
                          ->content($this->getTags($value), 'content')
                          ->width($width)
                          ->trigger($tigger)
                          ->placement($placement);
        });
        return $this;
    }

    /**
     * 开关 #todo
     * @return $this
     */
    public function switch($swithArr)
    {
        $this->display(function ($value) use ($swithArr) {
            return $this->getSwitch($value, $data, $this->prop, $swithArr);
        });
        return $this;
    }

    /**
     * 开关组 #TODO
     * @param array $fields
     * @return $this
     */
    public function switchGroup($fields)
    {
        $this->display(function ($value, $data) use ($fields) {
            $content = [];
            foreach ($fields as $field => $label) {
                $content[] = Html::create([
                    Html::create($label . ': '),
                    $this->getSwitch($data[$field], $data, $field),
                ])->style(['display' => 'flex', 'justifyContent' => 'space-between'])->tag('p');
            }
            return $content;
        });
        return $this;
    }

    /**
     * switch开关Html::create中直接使用 #TODO
     * @param string $text 开关名称
     * @param string $field 开关的字段
     * @param array $data 当前行的数据
     * @param array $switchArr 二维数组 开启的在下标0 关闭的在下标1
     *                              $arr = [
     *                              [1 => '开启'],
     *                              [0 => '关闭'],
     *                              ];
     * @return Html
     */
    public function switchHtml($text, $field, $data, $switchArr = [[1 => '开启'], [0 => '关闭']])
    {
        if (!empty($text)) $text .= "：";
        return Html::create([
            $text,
            $this->getSwitch($data[$field], $data, $field, $switchArr)
        ])->tag('p');
    }

    /**
     * 获取开关
     * @param string $value 当前值
     * @param array $data 行数据
     * @param string $field 字段
     * @param array $switchArr 开关选项
     * @return mixed
     */
    protected function getSwitch($value, $data, $field, $switchArr = [])
    {
        $params = $this->grid->getCallMethod();
        $params['eadmin_ids'] = [$data[$this->grid->drive()->getPk()]];
        return Switches::create(null, $value)
                       ->options($switchArr ?? admin_trans('admin.switch'))
                       ->url('/eadmin/batch.rest')
                       ->field($field)
                       ->params($params);
    }

    /**
     * 文件显示 #TODO
     * @return $this
     */
    public function file()
    {
        $this->display(function ($value) {
            $html = [];
            foreach ($vals as $val) {
                $file = new DownloadFile();
                $file->url($val);
                $html[] = $file;
            }
            return Html::create()->content($html)->tag('div');
        });
        return $this;
    }

    /**
     * 追加前面
     * @param mixed $prepend
     * @return $this
     */
    public function prepend($prepend)
    {
        $this->display(function ($val) use ($prepend) {
            return $prepend . $val;
        });
        return $this;
    }

    /**
     * 追加末尾
     * @param mixed $append
     * @return $this
     */
    public function append($append)
    {
        $this->display(function ($val) use ($append) {
            return $val . $append;
        });
        return $this;
    }

    /**
     * 内容映射
     * @param array $usings 映射内容
     * @param array $color 标签颜色
     */
    public function using(array $usings, array $color = [])
    {
        $this->display(function ($value) use ($usings, $color) {
            return $this->getTag($usings[$value], $color[$value] ?? '');
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
