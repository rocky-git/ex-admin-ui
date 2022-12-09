<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class UploaderAbstract
{
    protected $form;
    protected $successHandle = null;
    public function __construct()
    {
        $this->totalSize = Request::input('totalSize');
        $this->chunk = Request::input('chunkNumber');
        $this->chunks = Request::input('totalChunks');
        $this->filename = Request::input('filename');
        $this->directory = Request::input('directory');
        $this->type = Request::input('type');
        $this->file_type = Request::input('file_type');
        $this->disk = Request::input('disk','local');
        $this->file = Request::file('file');
        $this->extension = pathinfo($this->filename, PATHINFO_EXTENSION);
        $this->identifier = Request::input('identifier') . '.' . $this->extension;
        $this->tempDirectory = $this->tempDirectory();
    }
    public function setForm(Form $form){
        $this->form = $form;
    }
    /**
     * 测试分片请求
     * @return bool
     */
    public function testChunks()
    {
        return Request::getMethod() === 'GET';
    }
    /**
     * 获取分片名称
     * @param string $chunk
     * @return string
     */
    public function getChunkFileName($chunk = null)
    {
        if (is_null($chunk)) {
            $chunk = $this->chunk;
        }
        return $this->identifier . '-' . $chunk . '.part';
    }
    /**
     * 分片是否存在
     * @param string $chunk
     * @return bool
     */
    public function chunkExists($chunk = null)
    {
        if (is_null($chunk)) {
            $chunk = $this->chunk;
        }
        if (is_file("{$this->tempDirectory}/" . $this->getChunkFileName($chunk))) {

            return true;
        }
        return false;
    }
    /**
     * 获取存在分片
     * @return array
     */
    public function getExistsChunk()
    {
        $chunk = [];
        for ($index = 1; $index <= $this->chunks; $index++) {
            if ($this->chunkExists($index)) {
                $chunk[] = $index;
            }
        }
        return $chunk;
    }
    /**
     * 是否上传完成
     * @return bool
     */
    protected function isComplete()
    {
        for ($index = 1; $index <= $this->chunks; $index++) {
            if (!$this->chunkExists($index)) {
                return false;
            }
        }
        return true;
    }
    /**
     * 合并分片
     * @return string
     */
    protected function merge()
    {
        $filename = "{$this->tempDirectory}/" . $this->filename;
        $fp = fopen($filename,'a+');
        flock($fp,LOCK_EX);
        for ($index = 1; $index <= $this->chunks; $index++) {
            $file = "{$this->tempDirectory}/" . $this->getChunkFileName($index);
            $content = @file_get_contents($file);
            @file_put_contents($filename, $content, FILE_APPEND);
            @unlink($file);
        }
        flock($fp,LOCK_UN);
        fclose($fp);
        return $filename;
    }

    /**
     * 上传
     * @param \Closure $complete 完成前回调
     * @param bool $exists 判断秒传
     * @return Response
     */
    public function upload(\Closure $complete = null, bool $exists = false)
    {
        try {
            $path = $this->directory . $this->identifier;
            $url = '';
            if ($this->testChunks()) {
                if ($this->exists($path) && $exists) {
                    //秒传
                    $url = $this->url($path);
                    $this->successHandle(new UploadedFile($this->path($path), $this->filename),$url,$path);
                    return Response::success(['url' => $url,'path'=>$path]);
                } else {
                    //已上传分片，断点续传
                    $uploaded_chunks = $this->getExistsChunk();
                    if (count($uploaded_chunks) != $this->chunks) {
                        return Response::success(['uploaded_chunks' => $uploaded_chunks]);
                    }
                }
            }
            if(in_array($this->extension,admin_config('admin.upload.disabled_ext',[]))){
                return Response::success([],'disabled upload',500);
            }
            if ($this->file) {
                $this->file->move($this->tempDirectory, $this->getChunkFileName());
            }
            if ($this->chunks == 1 || $this->isComplete()) {
                $file = new UploadedFile($this->merge(), $this->filename);
                $completeFile = $file;
                if ($complete) {
                    $completeFile = call_user_func($complete, $file);
                    if ($completeFile !== $file) {
                        $path = $this->directory . md5($completeFile) . '.' . $this->extension;
                    }
                }
                $url = $this->putFile($path,$completeFile);
                $this->successHandle($completeFile,$url,$path);
                @unlink($file->getRealPath());
            }
            return Response::success(['url' => $url,'path'=>$path]);
        }catch (\Throwable $exception){
            return Response::success([],$exception->getMessage(),500);
        }
    }
    protected function successHandle($file,$url,$path){
        if($this->successHandle instanceof \Closure){
            call_user_func($this->successHandle, [
                'file'=>$file,
                'name'=>$this->filename,
                'file_type'=>$this->file_type,
                'size'=>$this->totalSize,
                'url'=>$url,
                'path'=>$path,
            ]);
        }
    }
    /**
     * 上传成功后处理
     * @param \Closure $closure
     * @return Response
     */
    public function success(\Closure $closure){
        $this->successHandle = $closure;
        return $this->upload();
    }
    /**
     * 写入文件
     * @param string $filename
     * @param string|UploadedFile $content
     * @return false|mixed
     */
    public function putFile(string $filename,$content){
        if($content instanceof UploadedFile){
            $content = fopen($content->getRealPath(), 'r');
        }
        if (is_resource($content)){
            $resource = $content;
            $content = '';
            while (!feof($resource)) {
                $content .= fread($resource, 1024);
            }
            fclose($resource);

        }
        $result = $this->put($filename,$content);
        return $result ? $this->url($filename) : false;
    }
    /**
     * 返回绝对路径
     * @param string $path 路径
     * @return string
     */
    protected function path($path)
    {
        return $path;
    }
    /**
     * 写入文件
     * @param string $filename 文件名
     * @param $content 文件内容
     * @return bool
     */
    abstract protected function put(string $filename,$content):bool;
    /**
     * 是否存在
     * @param string $path 路径
     * @return bool
     */
    abstract public function exists(string $path):bool;

    /**
     * 返回访问url
     * @param string $path 路径
     * @return string
     */
    abstract public function url(string $path):string;

    /**
     * 临时目录
     * @return string
     */
    abstract protected function tempDirectory():string;
}
