<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-15
 * Time: 12:39
 */

namespace ExAdmin\ui\support;


class Composer
{
    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function loader(){
        $loader = include dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'autoload.php';
        return $loader;
    }
}