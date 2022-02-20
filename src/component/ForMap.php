<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2021-01-01
 * Time: 15:29
 */

namespace ExAdmin\ui\component;




trait ForMap
{
    protected $map = [
        'attribute' => []
    ];

    /**
     * 遍历绑定字段
     * @param string $attrName 属性名称
     * @param string $field 遍历元素中的字段
     * @return $this
     */
    public function mapAttr($attrName, $field)
    {
        $this->map['attribute'][$attrName] = $field;
        return $this;
    }

    /**
     * 遍历
     * @param array $data 绑定字段
     * @param string $bindName 绑定字段
     * @return $this
     */
    public function map(array $data, $bindName = null)
    {
        if (is_null($bindName)) {
            $bindName = $this->random();
        }
        $this->bind($bindName, $data);
        $this->map['bindName'] = $bindName;
        return $this;
    }
}
