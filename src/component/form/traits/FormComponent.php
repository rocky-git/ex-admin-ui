<?php

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\component\form\field\AutoComplete;
use ExAdmin\ui\component\form\field\Cascader;
use ExAdmin\ui\component\form\field\CascaderMultiple;
use ExAdmin\ui\component\form\field\CascaderSingle;
use ExAdmin\ui\component\form\field\checkbox\CheckboxGroup;
use ExAdmin\ui\component\form\field\CheckboxTag;
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
use ExAdmin\ui\component\form\field\DynamicTag;
use ExAdmin\ui\component\form\field\Editor;
use ExAdmin\ui\component\form\field\input\Hidden;
use ExAdmin\ui\component\form\field\input\Input;
use ExAdmin\ui\component\form\field\InputNumber;
use ExAdmin\ui\component\form\field\input\Password;
use ExAdmin\ui\component\form\field\input\TextArea;
use ExAdmin\ui\component\form\field\MdEditor;
use ExAdmin\ui\component\form\field\mentions\Mentions;
use ExAdmin\ui\component\form\field\NumberRange;
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
 * @method Input text(string $field, string $label = '') ???????????????
 * @method Hidden hidden(string $field) ?????????
 * @method InputNumber number(string $field, string $label = '') ???????????????
 * @method NumberRange numberRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method Password password(string $field, string $label = '') ???????????????
 * @method TextArea textarea(string $field, string $label = '') ??????????????????
 * @method Rate rate(string $field, string $label = '') ??????
 * @method Slider slider(string $field, string $label = '') ???????????????
 * @method Transfer transfer(string $field, string $label = '') ?????????
 * @method Select select(string $field, string $label = '') ???????????????
 * @method TreeSelect treeSelect(string $field, string $label = '') ???????????????
 * @method Tree tree(string $field, string $label = '') ??????
 * @method Switches switch (string $field, string $label = '') ??????
 * @method CheckboxGroup checkbox(string $field, string $label = '') ????????? # TODO ???????????????
 * @method Cascader cascader(array $field, $label) ??????????????? ???????????????
 * @method CascaderSingle cascaderSingle(string $field, $label) ??????????????? ???????????????
 * @method RadioGroup radio(string $field, string $label = '') ?????????
 * @method DatePicker date(string $field, string $label = '') ???????????????
 * @method DateTimePicker dateTime(string $field, string $label = '') ?????????????????????
 * @method YearPicker year(string $field, string $label = '') ???????????????
 * @method MonthPicker month(string $field, string $label = '') ???????????????
 * @method WeekPicker week(string $field, string $label = '') ???????????????
 * @method QuarterPicker quarter(string $field, string $label = '') ???????????????
 * @method RangePicker dateRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method DateTimeRangePicker dateTimeRange(string $startFiled, string $endField, string $label = '') ???????????????????????????
 * @method YearRangePicker yearRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method MonthRangePicker monthRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method WeekRangePicker weekRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method QuarterRangePicker quarterRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method TimePicker time(string $field, string $label = '') ???????????????
 * @method TimeRangePicker timeRange(string $startFiled, string $endField, string $label = '') ?????????????????????
 * @method File file(string $field, string $label = '') ????????????
 * @method Image image(string $field, string $label = '') ????????????
 * @method Editor editor(string $field, string $label = '') ?????????
 * @method Mentions mentions(string $field, string $label = '') ??????(@??????)
 * @method AutoComplete autoComplete(string $field, string $label = '') ????????????
 * @method SelectIcon icon(string $field, string $label = '') ???????????????
 * @method SelectTable selectTable(string $field, string $label = '') ???????????????
 * @method ColorPicker color(string $field, string $label = '') ???????????????
 * @method MdEditor mdEditor($field, $label = '') md?????????
 * @method CheckboxTag checkboxTag($field, $label = '') ????????????
 * @method DynamicTag dynamicTag($field, $label = '') ????????????
 */
trait FormComponent
{
    protected static $formComponent = [
        'text'          => Input::class,
        'hidden'          => Hidden::class,
        'number'        => InputNumber::class,
        'numberRange'        => NumberRange::class,
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
        'cascaderSingle'      => CascaderSingle::class,
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
        'mdEditor'  => MdEditor::class,
        'checkboxTag'  => CheckboxTag::class,
        'dynamicTag'  => DynamicTag::class,
    ];
}
