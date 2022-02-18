<?php

namespace component\grid\card;

/**
 * 卡片
 * Class Card
 * @link    https://next.antdv.com/components/card-cn 卡片组件
 * @method $this activeTabKey(string $activeTabKey) 当前激活页签的 key                                        			string
 * @method $this headStyle(mixed $headStyle) 自定义标题区域样式                                        					object
 * @method $this bodyStyle(mixed $bodyStyle) 内容区域自定义样式                                        					object
 * @method $this bordered(bool $bordered = true) 是否有边框                                        						boolean
 * @method $this defaultActiveTabKey(string $defaultActiveTabKey) 初始化选中页签的 key，如果没有设置 activeTabKey           string
 * @method $this extra(mixed $extra) 卡片右上角的操作区域                                        							string|slot
 * @method $this hoverable(bool $hoverable = false) 鼠标移过时可浮起                                        				boolean
 * @method $this loading(bool $loading = false) 当卡片内容还在加载中时，可以用 loading 展示一个占位                          boolean
 * @method $this tabList(mixed $tabList) 页签标题列表, 可以通过 customTab(v3.0) 插槽自定义 tab                              Array<{key: string, tab: any}>
 * @method $this size(string $size = 'default') card 的尺寸                                        						default | small
 * @method $this title(mixed $title) 卡片标题                                        									string|slot
 * @method $this type(string $type) 卡片类型，可设置为 inner 或 不设置                                        				string
 * @package component\form\field
 */
class Card
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACard';

	public static function create()
	{
		return new self();
	}
}