<?php
namespace ExAdmin\ui\component\form\field\upload;

use ExAdmin\ui\component\form\Field;

/**
 * 上传组件
 * @method $this action(string $value) 请求地址
 * @method $this options(array $options) uploader选项参数
 * @method $this params(array $params) 附加请求参数
 * @method $this headers(array $headers) 设置上传的请求头部
 * @method $this type(string $value) 类型：file文件 image图片
 * @method $this drive(string $value) 上传驱动：local本地 oss阿里云 qiniu七牛云
 * @method $this saveDir(string $value) 保存目录
 * @method $this accept(string $value) 接受上传的文件类型
 * @method $this chunk(bool $value) 是否开启分片
 * @method $this directory(bool $value) 是否支持上传文件夹
 * @method $this input(bool $value) 显示输入框
 * @method $this chunkSize(int $value) 分片大小MB为单位
 * @method $this domain(string $value) 第三方存储驱动域名
 * @method $this limit(int $value) 限制数量
 * @method $this accessKey(string $value) oss accessKey
 * @method $this secretKey(string $value) oss secretKey
 * @method $this bucket(string $value) oss bucket
 * @method $this region(string $value) oss region
 * @method $this uploadToken(string $value) 七牛云上传token
 * @method $this disabled(bool $disabled = false) 是否禁用状态，默认为 false 											 	boolean
 */
class File extends Field
{
    protected $name='ExUploader';
    public function __construct($field = null, $value = '')
    {
        parent::__construct($field, $value);

    }

    /**
     * 是否支持多选文件
     */
    public function multiple(bool $value=true){
        $this->value = [];
        $this->modelValue();
        return $this->attr('multiple',true);
    }
    /**
     * 限制文件上传大小
     * @param $value
     * @return $this
     */
    public function fileSize($value)
    {
        $this->attr('fileSizeText', $value);
        $value = str_replace('b', '', strtolower($value));
        $pow = 1;
        if (strpos($value, 'k')) {
            $pow = pow(1024, 1);
        } elseif (strpos($value, 'm')) {
            $pow = pow(1024, 2);
        } elseif (strpos($value, 'g')) {
            $pow = pow(1024, 3);
        } elseif (strpos($value, 't')) {
            $pow = pow(1024, 4);
        }
        $value = str_replace(['k', 'm', 'g', 't'], '', $value);
        //字节
        $value = $value * $pow;
        $this->attr('fileSize', $value);
        return $this;
    }
}
