<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\grid\grid\Grid;
use ExAdmin\ui\response\Message;

use ExAdmin\ui\response\Response;
use Illuminate\Http\Request;

abstract class GridAbstract
{
    /**
     * @var Grid
     */
    protected $grid;

    protected $repository;

    protected $pk;

    protected $total = 0;

    /**
     * 初始化
     * @param Grid $grid
     * @param $repository
     */
    public function initialize(Grid $grid, $repository)
    {

        $this->grid = $grid;

        $this->repository = $repository;
    }

    /**
     * 返回主键名称
     * @return string
     */
    public function getPk(): string
    {
        return $this->pk ?: 'id';
    }

    /**
     * 设置主键名称
     * @param $name
     */
    public function setPk($name)
    {
        $this->pk = $name;
    }

    /**
     * 更新
     * @param array $ids 更新条件id集合
     * @param array $data 更新数据
     * @return Message
     */
    abstract public function update(array $ids, array $data): Message;

    /**
     * 删除
     * @param array $ids 删除id
     * @return Message
     */
    abstract public function delete(array $ids): Message;

    /**
     * 恢复数据
     * @param array $ids 恢复id
     * @return Message
     */
    abstract public function restore(array $ids): Message;

    /**
     * 删除全部
     * @return Message
     */
    abstract public function deleteAll(): Message;

    /**
     * 拖拽排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @param string $field 字段
     * @return Message
     */
    abstract public function dragSort($id, int $sort, string $field): Message;

    /**
     * 输入框排序
     * @param int $id 排序id
     * @param int $sort 排序位置
     * @param string $field 字段
     * @return Message
     */
    abstract public function inputSort($id, int $sort, string $field): Message;

    /**
     * 表格列触发排序
     * @param string $field 字段
     * @param string $sort 排序 asc desc
     * @return mixed
     */
    abstract public function tableSort($field, $sort);

    /**
     * 快捷搜索
     * @param string $keyword 关键词
     * @param string|array|\Closure $search 搜索设置
     * @return mixed
     */
    abstract public function quickSearch($keyword, $search);

    /**
     * 数据源
     * @param int $page 第几页
     * @param int $size 分页大小
     * @param bool $hidePage 是否分页
     * @return mixed
     */
    abstract public function data(int $page, int $size, bool $hidePage);

    /**
     * 总条数
     * @return int
     */
    abstract public function total(): int;

    /**
     * 返回总条数
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total > 0 ? $this->total : $this->total();
    }

    /**
     * 设置总条数
     * @param int $total
     */
    public function setTotal(int $total)
    {
        $this->total = $total;
    }

    /**
     * 是否有回收站
     * @return bool
     */
    abstract public function trashed(): bool;


    /**
     * 导出数据
     * @param array $selectIds 导出选中id
     * @param array $columns 导出列
     * @param bool $all 是否导出全部
     * @return Response
     */
    abstract public function export(array $selectIds, array $columns, bool $all): Response;

    /**
     * 筛选
     * @param array $rule
     * @return mixed
     */
    abstract public function filter(array $rule);

    /**
     * 删除前
     * @param \Closure $closure
     * @return mixed
     */
    abstract public function deling(\Closure $closure);

    /**
     * 删除后
     * @param \Closure $closure
     * @return mixed
     */
    abstract public function deleted(\Closure $closure);

    /**
     * 更新前
     * @param \Closure $closure
     * @return mixed
     */
    abstract public function updateing(\Closure $closure);

    /**
     * 更新后
     * @param \Closure $closure
     * @return mixed
     */
    abstract public function updated(\Closure $closure);

    /**
     *
     * @return mixed
     */
    abstract public function model();
}
