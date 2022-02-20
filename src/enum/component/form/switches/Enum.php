<?php

namespace ExAdmin\ui\enum\component\form\switches;

class Enum
{
    /**
     * 选中的值
     */
    const CHECKED_VALUE = 'checkedValue';

    /**
     * 未选中的值
     */
    const UNCHECKED_VALUE = 'unCheckedValue';

    /**
     * 大小 - 小
     */
    const SIZE_SMALL = 'small';

    /**
     * 大小 - 默认
     */
    const SIZE_DEFAULT = 'default';

    /**
     * 是 - 数值
     */
    const TYPE_TRUE = 1;

    /**
     * 否 - 数字
     */
    const TYPE_FALSE = 0;

    /**
     * 是 - 中文
     */
    const TYPE_TRUE_TEXT = '是';

    /**
     * 否 - 中文
     */
    const TYPE_FALSE_TEXT = '否';

    /**
     * 是否 - 类型
     */
    const TYPE_TRUE_STATUS = [
        self::TYPE_TRUE => self::TYPE_TRUE_TEXT,
        self::TYPE_FALSE => self::TYPE_FALSE_TEXT,
    ];

    /**
     * 是否 - 开关
     */
    const TYPE_TRUE_SWITCHES = [
        [self::TYPE_TRUE => self::TYPE_TRUE_TEXT],
        [self::TYPE_FALSE => self::TYPE_FALSE_TEXT],
    ];

    /**
     * 显示 - 数值
     */
    const TYPE_SHOW = 1;

    /**
     * 隐藏 - 数值
     */
    const TYPE_HIDE = 0;

    /**
     * 显示 - 中文
     */
    const TYPE_SHOW_TEXT = '显示';

    /**
     * 隐藏 - 中文
     */
    const TYPE_HIDE_TEXT = '隐藏';

    /**
     * 状态 - 类型
     */
    const TYPE_STATUS = [
        self::TYPE_SHOW => self::TYPE_SHOW_TEXT,
        self::TYPE_HIDE => self::TYPE_HIDE_TEXT,
    ];

    /**
     * 状态 - 开关
     */
    const TYPE_STATUS_SWITCHES = [
        [self::TYPE_SHOW => self::TYPE_SHOW_TEXT],
        [self::TYPE_HIDE => self::TYPE_HIDE_TEXT],
    ];
}