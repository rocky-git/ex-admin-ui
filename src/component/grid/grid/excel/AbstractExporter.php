<?php

namespace ExAdmin\ui\component\grid\grid\excel;

use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Request;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

abstract class AbstractExporter
{
    protected $only = [];

    protected $except = [];

    protected $columns = [];

    protected $imageColumns = [];

    protected $filename;

    protected $extension = 'xlsx';

    protected $mapCallback = null;

    protected $currentRow = 1;

    protected $count = 1;

    protected $cache;

    protected $progressKey;
    /**
     * @var FilesystemAdapter
     */
    protected $filesystemAdapter;


    public function __construct()
    {
        $this->filesystemAdapter= new FilesystemAdapter();
        $this->init();
    }

    /**
     * 设置进度缓存key
     * @param $value
     * @return $this
     */
    public function setProgressKey($value){
        $this->progressKey = $value;
        $this->cache = $this->filesystemAdapter->getItem($value);
        return $this;
    }
    /**
     * 设置文件名称
     * @param $filename
     */
    public function filename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * 设置数据总行数
     * @param $count
     */
    public function count($count){
        $this->count = $count;
    }
    /**
     * @return $this
     */
    public function xlsx()
    {
        return $this->extension('xlsx');
    }

    /**
     * @return $this
     */
    public function ods()
    {
        return $this->extension('ods');
    }

    /**
     * @return $this
     */
    public function csv()
    {
        return $this->extension('csv');
    }

    /**
     * @return $this
     */
    public function html()
    {
        return $this->extension('html');
    }

    public function extension(string $ext)
    {
        $this->extension = $ext;

        return $this;
    }
    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }
    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * 设置表头列
     * @param array $columns
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * 设置图片列
     * @param array $imageColumns
     * @return $this
     */
    public function imageColumns(array $imageColumns){
        $this->imageColumns = $imageColumns;
        return $this;
    }
    /**
     * 指定列
     * @param array $columns
     * @return $this
     */
    public function only(array $columns)
    {
        $this->only = $columns;
        return $this;
    }

    /**
     * 排除列
     * @param array $columns
     * @return $this
     */
    public function except(array $columns)
    {
        $this->except = $columns;
        return $this;
    }

    /**
     * @param \Closure $closure
     */
    public function map(\Closure $closure)
    {
        $this->mapCallback = $closure;
    }
    /**
     * 获取列
     * @return array
     */
    public function getColumns()
    {
        foreach ($this->columns as $field => $title) {
            if (count($this->only) > 0) {
                if (!in_array($field, $this->only)) {
                    unset($this->columns[$field]);
                }
            } elseif (count($this->except) > 0) {
                if (in_array($field, $this->except)) {
                    unset($this->columns[$field]);
                }
            }
        }
        return $this->columns;
    }

    /**
     * 初始化
     * @return mixed
     */
    abstract public function init();
    /**
     * 返回百分比
     */
    protected function progress()
    {
        return floor( $this->currentRow / $this->count * 100);
    }
    /**
     * 写入数据
     * @param array $data
     * @param \Closure $progress 进度百分比
     * @param \Closure $finish 完成
     */
    abstract public function write(array $data,\Closure $finish = null);

    /**
     * 保存
     * @param string $path 保存目录
     * @return string|bool
     */
    abstract public function save(string $path);

    public function exportError(){
        $this->cache->set([
            'status' => 2,
        ]);
        $this->cache->expiresAfter(60);
        $this->filesystemAdapter->save($this->cache);
    }
    /**
     * @return Response
     */
    public function export(){
        return Response::success(['key' => $this->progressKey]);
    }
}
