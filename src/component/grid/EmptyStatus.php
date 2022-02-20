<?php

namespace ExAdmin\ui\component\grid;

/**
 * 空状态
 * Class EmptyStatus
 * @link    https://next.antdv.com/components/empty-cn 空状态组件
 * @method $this description(mixed $description) 自定义描述内容                                        					string | v-slot
 * @method $this image(mixed $image = false) 设置显示图片，为 string 时表示自定义图片地址                                    string | v-slot
 * @package ExAdmin\ui\component\form\field
 */
class EmptyStatus
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AEmpty';

	public static function create()
	{
		return new self();
	}
}