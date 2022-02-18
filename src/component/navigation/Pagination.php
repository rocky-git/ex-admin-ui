<?php

namespace component\navigation;

/**
 * 分页
 * Class Pagination
 * @link    https://next.antdv.com/components/pagination-cn 分页组件
 * @method $this current(int $current) 当前页数                                                        					number
 * @method $this pageSize(int $pageSize) 每页条数                                                        				number
 * @method $this defaultPageSize(int $defaultPageSize = 10) 默认的每页条数                                                number
 * @method $this disabled(bool $disabled) 禁用分页                                                        				boolean
 * @method $this hideOnSinglePage(bool $hideOnSinglePage = false) 只有一页时是否隐藏分页器                                 boolean
 * @method $this pageSizeOptions(array $pageSizeOptions = ['10', '20', '30', '40']) 指定每页可以显示多少条                 string[]
 * @method $this showLessItems(bool $showLessItems = false) 是否显示较少页面内容                                           boolean
 * @method $this showQuickJumper(bool $showQuickJumper = false) 是否可以快速跳转至某页                                     boolean
 * @method $this showSizeChanger(bool $showSizeChanger = false) 是否可以改变 pageSize                                     boolean
 * @method $this simple(bool $simple) 当添加该属性时，显示为简单分页                                                        boolean
 * @method $this size(string $size = '') 当为「small」时，是小尺寸分页                                                     string
 * @method $this total(int $total = 0) 数据总数                                                        					number
 * @package component\form\field
 */
class Pagination
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'APagination';

	public static function create()
	{
		return new self();
	}
}