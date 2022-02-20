<?php

namespace ExAdmin\ui\component\grid;

use ExAdmin\ui\component\Component;

/**
 * 走马灯
 * Class Carousel
 * @link    https://next.antdv.com/components/carousel-cn 走马灯组件
 * @method $this autoplay(bool $autoplay = false) 是否自动切换                                        					boolean
 * @method $this dotPosition(string $dotPosition = 'bottom') 面板指示点位置，可选 top bottom left right                   string
 * @method $this dots(bool $dots = true) 是否显示面板指示点                                       						boolean
 * @method $this dotsClass(string $dotsClass = 'slick-dots') 面板指示点类名                                        		string
 * @method $this easing(string $easing = 'linear') 动画效果                                        						string
 * @method $this effect(string $effect = 'scrollx') 动画效果函数，可取 scrollx, fade                                      string
 * @package ExAdmin\ui\component\form\field
 */
class Carousel extends Component
{
	/**
	 * 组件名称
	 * @var string
	 */
	protected $name = 'ACarousel';

	public static function create()
	{
		return new self();
	}
}