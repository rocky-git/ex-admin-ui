<?php

namespace ExAdmin\ui\component\form\field\mentions;

use ExAdmin\ui\component\Component;

/**
 * 提及选项
 * Class MentionsOption
 * @link    https://next.antdv.com/components/mentions-cn 提及组件
 * @method $this value(string $value = '') 选择时填充的值																	string
 * @package ExAdmin\ui\component\form\field
 */
class MentionsOption extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'AMentionsOption';

	public static function create()
	{
		return new self();
	}
}