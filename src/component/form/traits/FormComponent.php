<?php

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\component\form\field\AutoComplete;
use ExAdmin\ui\component\form\field\Cascader;
use ExAdmin\ui\component\form\field\CascaderMultiple;
use ExAdmin\ui\component\form\field\checkbox\CheckboxGroup;
use ExAdmin\ui\component\form\field\ColorPicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\DateTimeRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\MonthRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\QuarterRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\WeekRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\range\YearRangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\DatePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\date\DateTimePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\date\MonthPicker;
use ExAdmin\ui\component\form\field\dateTimePicker\date\QuarterPicker;
use ExAdmin\ui\component\form\field\dateTimePicker\date\WeekPicker;
use ExAdmin\ui\component\form\field\dateTimePicker\date\YearPicker;
use ExAdmin\ui\component\form\field\dateTimePicker\RangePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\TimePicker;
use ExAdmin\ui\component\form\field\dateTimePicker\TimeRangePicker;
use ExAdmin\ui\component\form\field\Editor;
use ExAdmin\ui\component\form\field\input\Hidden;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\InputNumber;
use ExAdmin\ui\component\form\field\input\Password;
use ExAdmin\ui\component\form\field\input\TextArea;
use ExAdmin\ui\component\form\field\mentions\Mentions;
use ExAdmin\ui\component\form\field\radio\RadioGroup;
use ExAdmin\ui\component\form\field\Rate;
use ExAdmin\ui\component\form\field\select\Select;
use ExAdmin\ui\component\form\field\select\SelectTable;
use ExAdmin\ui\component\form\field\SelectIcon;
use ExAdmin\ui\component\form\field\Slider;
use ExAdmin\ui\component\form\field\Switches;
use ExAdmin\ui\component\form\field\Transfer;
use ExAdmin\ui\component\form\field\Tree;
use ExAdmin\ui\component\form\field\TreeSelect;
use ExAdmin\ui\component\form\field\upload\File;
use ExAdmin\ui\component\form\field\upload\Image;

/**
 * @method static Input text(string $field, string $label = '') 文本输入框
 * @method static InputNumber number(string $field, string $label = '') 数字输入框
 * @method static Password password(string $field, string $label = '') 密码输入框
 * @method static TextArea textarea(string $field, string $label = '') 文本域输入框
 * @method static Rate rate(string $field, string $label = '') 评分
 * @method static Slider slider(string $field, string $label = '') 滑动输入条
 * @method static Transfer transfer(string $field, string $label = '') 穿梭框
 * @method static Select select(string $field, string $label = '') 下拉选择框
 * @method static TreeSelect treeSelect(string $field, string $label = '') 树形选择框
 * @method static Tree tree(string $field, string $label = '') 树形
 * @method static Switches switch (string $field, string $label = '') 开关
 * @method static CheckboxGroup checkbox(string $field, string $label = '') 多选框 # TODO 全选未封装
 * @method static Cascader cascader(array $field, $label) 级联选择器
 * @method static RadioGroup radio(string $field, string $label = '') 单选框
 * @method static DatePicker date(string $field, string $label = '') 日期选择框
 * @method static DateTimePicker dateTime(string $field, string $label = '') 日期时间选择框
 * @method static YearPicker year(string $field, string $label = '') 年份选择框
 * @method static MonthPicker month(string $field, string $label = '') 月份选择框
 * @method static WeekPicker week(string $field, string $label = '') 星期选择框
 * @method static QuarterPicker quarter(string $field, string $label = '') 季度选择框
 * @method static RangePicker dateRange(string $startFiled, string $endField, string $label = '') 日期范围选择框
 * @method static DateTimeRangePicker dateTimeRange(string $startFiled, string $endField, string $label = '') 日期时间范围选择框
 * @method static YearRangePicker yearRange(string $startFiled, string $endField, string $label = '') 年份范围选择框
 * @method static MonthRangePicker monthRange(string $startFiled, string $endField, string $label = '') 月份范围选择框
 * @method static WeekRangePicker weekRange(string $startFiled, string $endField, string $label = '') 星期范围选择框
 * @method static QuarterRangePicker quarterRange(string $startFiled, string $endField, string $label = '') 季度范围选择框
 * @method static TimePicker time(string $field, string $label = '') 时间选择框
 * @method static TimeRangePicker timeRange(string $startFiled, string $endField, string $label = '') 时间范围选择框
 * @method static File file(string $field, string $label = '') 文件上传
 * @method static Image image(string $field, string $label = '') 图片上传
 * @method static Editor editor(string $field, string $label = '') 富文本
 * @method static Mentions mentions(string $field, string $label = '') 提及(@某人)
 * @method static AutoComplete autoComplete(string $field, string $label = '') 自动完成
 * @method static SelectIcon icon(string $field, string $label = '') 图标选择器
 * @method static SelectTable selectTable(string $field, string $label = '') 表格选择器
 * @method static ColorPicker color(string $field, string $label = '') 颜色选择器
 * #TODO 地图组件
 * #TODO 规格组件
 */
trait FormComponent
{
    protected $formComponent = [
        'text'          => Input::class,
        'number'        => InputNumber::class,
        'password'      => Password::class,
        'textarea'      => TextArea::class,
        'rate'          => Rate::class,
        'slider'        => Slider::class,
        'transfer'      => Transfer::class,
        'treeSelect'    => TreeSelect::class,
        'tree'          => Tree::class,
        'select'        => Select::class,
        'switch'        => Switches::class,
        'checkbox'      => CheckboxGroup::class,
        'cascader'      => Cascader::class,
        'cascaderMultiple'      => CascaderMultiple::class,
        'radio'         => RadioGroup::class,
        'date'          => DatePicker::class,
        'dateTime'      => DateTimePicker::class,
        'year'          => YearPicker::class,
        'month'         => MonthPicker::class,
        'week'          => WeekPicker::class,
        'quarter'       => QuarterPicker::class,
        'yearRange'     => YearRangePicker::class,
        'monthRange'    => MonthRangePicker::class,
        'weekRange'     => WeekRangePicker::class,
        'quarterRange'  => QuarterRangePicker::class,
        'dateRange'     => RangePicker::class,
        'dateTimeRange' => DateTimeRangePicker::class,
        'time'          => TimePicker::class,
        'timeRange'     => TimeRangePicker::class,
        'file'          => File::class,
        'image'         => Image::class,
        'editor'        => Editor::class,
        'mentions'      => Mentions::class,
        'autoComplete'  => AutoComplete::class,
        'icon'  => SelectIcon::class,
        'selectTable'  => SelectTable::class,
        'color'  => ColorPicker::class,
    ];
}
