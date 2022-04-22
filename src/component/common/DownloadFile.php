<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2021-02-16
 * Time: 00:00
 */

namespace ExAdmin\ui\component\common;



use ExAdmin\ui\component\Component;

/**
 * Class DownloadFile
 * @package namespace ExAdmin\ui\component\common
 * @method $this filename(string $filename) 文件名
 * @method $this url(string $url) 文件链接
 * @method $this onlyImage(bool $value = true) 只是图片
 */
class DownloadFile extends Component
{
    protected $name = 'ExDownloadFile';

}
