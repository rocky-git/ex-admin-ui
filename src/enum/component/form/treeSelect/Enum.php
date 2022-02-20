<?php

namespace ExAdmin\ui\enum\component\form\treeSelect;

class Enum
{
    /**
     * 回填的方式 - 只显示子节点
     */
    const TREE_SELECT_CHILD = 'TreeSelect.SHOW_CHILD';

    /**
     * 回填的方式 - 显示所有选中节点(包括父节点)
     */
    const TREE_SELECT_ALL = 'TreeSelect.SHOW_ALL';

    /**
     * 回填的方式 - 只显示父节点(当父节点下所有子节点都选中时). 默认只显示子节点.
     */
    const TREE_SELECT_PARENT = 'TreeSelect.SHOW_PARENT';

    /**
     * 大小 - 大
     */
    const SIZE_LARGE = 'large';

    /**
     * 大小 - 小
     */
    const SIZE_SMALL = 'small';

    /**
     * 大小 - 默认
     */
    const SIZE_DEFAULT = 'default';
}