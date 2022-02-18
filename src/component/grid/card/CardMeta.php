<?php

namespace component\grid\card;

/**
 * 卡片 - 描述卡片
 * Class CardMeta
 * @link    https://next.antdv.com/components/card-cn 卡片组件
 * @method $this avatar(mixed $avatar) 头像/图标                                      									slot
 * @method $this description(mixed $description) 描述内容                                       							string|slott
 * @method $this title(mixed $title) 标题内容                                        									string|slot
 * @package component\form\field
 */
class CardMeta
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACardMeta';

	public static function create()
	{
		return new self();
	}
}