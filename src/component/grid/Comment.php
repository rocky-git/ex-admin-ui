<?php

namespace ExAdmin\ui\component\grid;

use ExAdmin\ui\component\Component;

/**
 * 评论
 * Class Comment
 * @link    https://next.antdv.com/components/comment-cn 评论组件
 * @method $this actions(mixed $actions) 在评论内容下面呈现的操作项列表                                        				Array|slot
 * @method $this author(mixed $author) 要显示为注释作者的元素                                        						string|slot
 * @method $this avatar(mixed $avatar) 要显示为评论头像的元素 - 通常是 antd Avatar 或者 src                                 string|slot
 * @method $this content(mixed $content) 评论的主要内容                                        							string|slot
 * @method $this datetime(mixed $datetime) 展示时间描述                                        							string|slot
 * @package ExAdmin\ui\component\form\field
 */
class Comment extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'actions',
        'author',
        'avatar',
        'content',
        'datetime',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'AComment';

	
}