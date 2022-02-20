<?php

namespace ExAdmin\ui\enum\component\form;

class Enum
{
    /**
     * 校验触发时机 - 失去焦点
     */
    const TRIGGER_BLUR = 'blur';

    /**
     * 校验触发时机 - 改变
     */
    const TRIGGER_CHANGE = 'change';

    /**
     * 标签文本对齐方式 - 左对齐
     */
    const LABEL_ALIGN_LEFT = 'left';

    /**
     * 标签文本对齐方式 - 右对齐
     */
    const LABEL_ALIGN_RIGHT = 'right';

    /**
     * 表单布局 - 水平
     */
    const LAYOUT_HORIZONTAL = 'horizontal';

    /**
     * 表单布局 - 垂直
     */
    const LAYOUT_VERTICAL = 'vertical';

    /**
     * 表单布局 - 行
     */
    const LAYOUT_INLINE = 'inline';
}