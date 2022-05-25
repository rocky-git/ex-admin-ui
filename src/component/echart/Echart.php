<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-05-23
 * Time: 21:05
 */

namespace ExAdmin\ui\component\echart;

use ExAdmin\ui\component\Component;
use ExAdmin\ui\component\grid\card\Card;
use ExAdmin\ui\component\grid\grid\Filter;
use ExAdmin\ui\contract\EchartAbstract;
use Hisune\EchartsPHP\ECharts;

/**
 * Class Echart
 * @package ExAdmin\ui\component\echart
 * @method static $this create($source = [],string $dateField = 'created_at') 创建
 * @method $this width(string $width)  宽度
 * @method $this height(string $height = '350px')  高度
 * @method $this card()  卡片风格
 * @method $this header(mixed $content)  头部内容
 * @method $this footer(mixed $content)  底部内容
 * @method $this url(string $url) 加载数据地址
 * @method $this params(array $params) 加载数据附加参数
 */
class Echart extends Component
{
    protected $name = 'ExEchart';

    /**
     * @var ECharts
     */
    public $echart;
    /**
     * @var Filter
     */
    protected $filter;

    protected $hideDateFilter = false;

    protected $data = [];
    /**
     * 日期筛选字段
     * @var mixed|string
     */
    protected $dateField;
    /**
     * 日期筛选默认条件
     * @var
     */
    protected $dateDefault = 'today';

    public function __construct()
    {
        parent::__construct();
        $this->url("ex-admin/{$this->call['class']}/{$this->call['function']}");
        $callParams = ['ex_admin_class' => $this->call['class'], 'ex_admin_function' => $this->call['function']];
        $callParams = array_merge($callParams, $this->call['params']);
        $this->attr('callParams', $callParams);
        $this->echart = new ECharts();
    }


    /**
     * 设置日期筛选默认条件
     * @param string|array $value yesterday-昨天 today-今天 week-本周 month-本月 year-今年 ['2020-02-02','2020-02-02']-范围
     * @return $this
     */
    public function dateDefault($value){
        $this->dateDefault = $value;
        return $this;
    }
    /**
     * 选项参数
     * @param mixed $options
     * @return $this
     */
    public function options($options){
        if($options instanceof \Closure){
            call_user_func($options,$this->echart);
            $options = $this->echart->getOption();
        }elseif (is_string($options)){
            $options = preg_replace(["/([a-zA-Z_]+[a-zA-Z0-9_]*)\s*:/", "/:\s*'(.*?)'/", "/'(.*?)'/"], ['"\1":', ': "\1"', '"\1"'], $options);
            $options = json_decode($options,true);
        }
        $this->echart->_options = array_merge($this->echart->_options,$options);
        return $this;
    }

    /**
     * 隐藏默认的日期筛选
     * @param bool $bool
     * @return $this
     */
    public function hideDateFilter(bool $bool=true){
        $this->hideDateFilter = true;
        return $this;
    }
    /**
     * 筛选表单
     * @param \Closure $callback
     * @return $this
     */
    public function filter(\Closure $callback)
    {
        if(!$this->filter){
            $this->filter = new Filter();
            $this->filter->form()->style(['background'=>'none','padding'=>'0','paddingBottom'=>'20px']);
        }
        call_user_func($callback, $this->filter);
        return $this;
    }
    /**
     * 添加数据
     * @param string $name
     * @param mixed $data
     * @return $this
     */
    public function data($name, $data)
    {

        $this->data[$name] = $data;
        return $this;
    }
    public function __call($name, $arguments)
    {
        if($arguments){
            $manager = admin_config('admin.echart.manager');
            $driver = (new $manager($arguments[0], $this))->getDriver();
            if($driver){
                array_shift($arguments);
                if(method_exists($driver,$name)){
                    call_user_func_array([$driver,$name],$arguments);
                    return $this;
                }
            }
        }
        return parent::__call($name, $arguments); // TODO: Change the autogenerated stub
    }

    public function jsonSerialize()
    {
        //日期筛选表单
        if(!$this->hideDateFilter){
            $this->filter(function (Filter $filter){
                $radio = $filter->eq()->radio('filter_date')->options([
                    'yesterday'=>admin_trans('echart.yesterday'),
                    'today'=>admin_trans('echart.today'),
                    'week'=>admin_trans('echart.this_week'),
                    'month'=>admin_trans('echart.this_month'),
                    'year'=>admin_trans('echart.this_year'),
                ])->button()->buttonStyle('solid');
                $dateRange = $filter->between()->dateRange('filter_date');
                if(is_string($this->dateDefault)){
                    $radio->default($this->dateDefault);
                }elseif(is_array($this->dateDefault)){
                    $dateRange->default($this->dateDefault);
                }
            });
        }

        $this->attr('options',$this->echart->getOption());
        if($this->filter &&  !$this->filter->isHide()){
            $this->attr('filter', $this->filter->form());
        }
        $render =  parent::jsonSerialize(); // TODO: Change the autogenerated stub
        if($this->attr('card')){
            $card = Card::create();
            $card->content['default'][] = $render;
            $render = $card;
        }

        return $render;
    }
}
