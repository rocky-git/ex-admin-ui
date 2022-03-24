<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\response\Message;

use Illuminate\Http\Request;

interface GridInterface
{
    /**
     * 设置数据源
     * @param mixed $data
     * @param Grid $grid
     */
    public function __construct($data,Grid $grid);

    /**
     * 返回唯一标识字段，一般数据库主键自增字段
     * @return string
     */
    public function getPk():string;


    /**
     * 删除
     * @param array $ids 删除id
     * @return Message
     */
    public function delete(array $ids): Message;
    /**
     * 恢复数据
     * @param array $ids 恢复id
     * @return Message
     */
    public function restore(array $ids): Message;
    /**
     * 删除全部
     * @return Message
     */
    public function deleteAll(): Message;

    /**
     * 拖拽排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @return Message
     */
    public function dragSort($id, int $sort): Message;

    /**
     * 输入框排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @return Message
     */
    public function inputSort($id, int $sort): Message;

    /**
     * 表格列触发排序
     * @param string $field 字段
     * @param string $sort 排序 asc desc
     * @return mixed
     */
    public function tableSort($field,$sort);
    /**
     * 快捷搜索
     * @param string $keyword 关键词
     * @return mixed
     */
    public function quickSearch(string $keyword);

    /**
     * 数据源
     * @param int $page 第几页
     * @param int $size 分页大小
     * @return mixed
     */
    public function data(int $page, int $size);

    /**
     * 返回总条数
     * @return int
     */
    public function total(): int;

    /**
     * 是否有回收站
     * @return bool
     */
    public function trashed():bool;
    

    /**
     * 导出数据
     * @param array $selectIds 导出选中id
     * @param array $columns 导出列
     * @param bool $all 是否导出全部
     * @return mixed
     */
    public function export(array $selectIds,array $columns,bool $all):Message;

    /**
     * 筛选
     * @param array $rule
     * @return mixed
     */
    public function filter(array $rule);
    /**
     * 删除前
     * @param \Closure $closure
     * @return mixed
     */
    public function deling(\Closure  $closure);
    /**
     * 删除后
     * @param \Closure $closure
     * @return mixed
     */
    public function deleted(\Closure  $closure);
}
