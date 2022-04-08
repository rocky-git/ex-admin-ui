<?php

namespace ExAdmin\ui\component\form\field\select;

use ExAdmin\ui\component\grid\grid\Grid;

class SelectTable extends Select
{
    protected $name = 'ExSelectTable';

    /**
     * 渲染实例
     * @param Grid|string $grid
     * @return $this
     */
    public function grid($grid){
        list($url, $params) = $this->parseComponentCall($grid);
        $this->attr('gridUrl',$url);
        $this->attr('params',$params);
        return $this;
    }
}
