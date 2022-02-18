<?php

namespace component\navigation;

/**
 * 页头
 * Class PageHeader
 * @link    https://next.antdv.com/components/page-header-cn 页头组件
 * @link    https://next.antdv.com/components/avatar-cn/ avatar props
 * @link 	https://next.antdv.com/components/tag-cn/ Tag
 * @link    https://next.antdv.com/components/breadcrumb-cn/ breadcrumb
 * @method $this title(mixed $title) 自定义标题文字                                                        string|slot
 * @method $this subTitle(mixed $subTitle) 自定义的二级标题文字                                           string|slot
 * @method $this ghost(bool $ghost = true) pageHeader 的类型，将会改变背景颜色                             boolean
 * @method $this avatar(mixed $avatar) 标题栏旁的头像                                                    avatar props
 * @method $this backIcon(mixed $backIcon) 自定义 back icon ，如果为 false 不渲染 back icon               string|slot
 * @method $this tags(mixed $tags) title 旁的 tag 列表                                                   Tag[] | Tag
 * @method $this extra(mixed $extra) 操作区，位于 title 行的行尾                                          string|slot
 * @method $this breadcrumb(mixed $breadcrumb) 面包屑的配置                                              breadcrumb
 * @method $this footer(mixed $footer) PageHeader 的页脚，一般用于渲染 TabBar                             string|slot
 * @package component\form\field
 */
class PageHeader
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'APageHeader';

	public static function create()
	{
		return new self();
	}
}