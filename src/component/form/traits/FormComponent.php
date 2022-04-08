<?php

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\component\form\field\AutoComplete;
use ExAdmin\ui\component\form\field\Cascade;
use ExAdmin\ui\component\form\field\checkbox\CheckboxGroup;
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
 * @method Input text(string $field, string $label = '') 文本输入框
 * @method InputNumber number(string $field, string $label = '') 数字输入框
 * @method Password password(string $field, string $label = '') 密码输入框
 * @method TextArea textarea(string $field, string $label = '') 文本域输入框
 * @method Rate rate(string $field, string $label = '') 评分
 * @method Slider slider(string $field, string $label = '') 滑动输入条
 * @method Transfer transfer(string $field, string $label = '') 穿梭框
 * @method Select select(string $field, string $label = '') 下拉选择框
 * @method TreeSelect treeSelect(string $field, string $label = '') 树形选择框
 * @method Tree tree(string $field, string $label = '') 树形
 * @method Switches switch (string $field, string $label = '') 开关
 * @method CheckboxGroup checkbox(string $field, string $label = '') 多选框 # TODO 全选未封装
 * @method Cascade cascader(string $field, string $label = '') 级联选择 #todo
 * @method RadioGroup radio(string $field, string $label = '') 单选框
 * @method DatePicker date(string $field, string $label = '') 日期选择框
 * @method DateTimePicker dateTime(string $field, string $label = '') 日期时间选择框
 * @method YearPicker year(string $field, string $label = '') 年份选择框
 * @method MonthPicker month(string $field, string $label = '') 月份选择框
 * @method WeekPicker week(string $field, string $label = '') 星期选择框
 * @method QuarterPicker quarter(string $field, string $label = '') 季度选择框
 * @method RangePicker dateRange(string $startFiled, string $endField, string $label = '') 日期范围选择框
 * @method DateTimeRangePicker dateTimeRange(string $startFiled, string $endField, string $label = '') 日期时间范围选择框
 * @method YearRangePicker yearRange(string $startFiled, string $endField, string $label = '') 年份范围选择框
 * @method MonthRangePicker monthRange(string $startFiled, string $endField, string $label = '') 月份范围选择框
 * @method WeekRangePicker weekRange(string $startFiled, string $endField, string $label = '') 星期范围选择框
 * @method QuarterRangePicker quarterRange(string $startFiled, string $endField, string $label = '') 季度范围选择框
 * @method TimePicker time(string $field, string $label = '') 时间选择框
 * @method TimeRangePicker timeRange(string $startFiled, string $endField, string $label = '') 时间范围选择框
 * @method File file(string $field, string $label = '') 文件上传
 * @method Image image(string $field, string $label = '') 图片上传
 * @method Editor editor(string $field, string $label = '') 富文本
 * @method Mentions mentions(string $field, string $label = '') 提及(@某人)
 * @method AutoComplete autoComplete(string $field, string $label = '') 自动完成
 * @method SelectIcon icon(string $field, string $label = '') 图标选择器
 * @method SelectTable selectTable(string $field, string $label = '') 表格选择器
 * #TODO 地图组件
 * #TODO 规格组件
 * #TODO 颜色选择器
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
        'cascader'      => Cascade::class,
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
    ];
}
