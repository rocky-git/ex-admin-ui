<?php

namespace ExAdmin\ui\contract;

use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\response\Response;
use ExAdmin\ui\support\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class UploaderAbstract
{
    protected $form;
    public function __construct()
    {
        $this->chunk = Request::input('chunkNumber');
        $this->chunks = Request::input('totalChunks');
        $this->filename = Request::input('filename');
        $this->directory = Request::input('directory');
        $this->type = Request::input('type');
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
        for ($index = 1; $index <= $this->chunks; $index++) {
            $file = "{$this->tempDirectory}/" . $this->getChunkFileName($index);
            $content = file_get_contents($file);
            file_put_contents($filename, $content, FILE_APPEND);
            unlink($file);
        }
        return $filename;
    }
    
    /**
     * 上传
     * @param \Closure $complete
     * @param bool $exists 判断秒传
     * @return Response
     */
    public function upload(\Closure $complete = null, bool $exists = false)
    {
        $path = $this->directory . $this->identifier;
        $url = '';
        if ($this->testChunks()) {
            if ($this->exists($path) && $exists) {
                //秒传
                $url = $this->url($path);
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
            if ($complete) {
                $completeFile = call_user_func($complete, $file);
                if ($completeFile === $file) {
                    $this->putFile( $path,$file);
                } else {
                    $name = md5($completeFile);
                    $path = $this->directory . $name . '.' . $this->extension;
                    $this->putFile($path,$completeFile);
                }
            } else {
                $this->putFile($path,$file);
            }
            unlink($file->getRealPath());
            $url = $this->url($path);
        }
        return Response::success(['url' => $url,'path'=>$path]);
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
        return $result ? $filename : false;
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
