<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-21
 * Time: 21:12
 */
return [
    'request_interface' => [
        //ExAdmin\ui\contract\LoginInterface
        'login' => '',
        //ExAdmin\ui\contract\SystemAbstract
        'system' => '',
    ],
    'grid' => [
         //ExAdmin\ui\Manager
        'manager' => \ExAdmin\ui\manager\GridManager::class,
    ],
    'form' => [
        //ExAdmin\ui\Manager
        'manager' => \ExAdmin\ui\manager\FormManager::class,
        //ExAdmin\ui\contract\ValidatorAbstract
        'validator' => '',
        //ExAdmin\ui\contract\UploaderAbstract
        'uploader'=>'',
    ],
    'echart' => [
        //ExAdmin\ui\Manager
        'manager' => \ExAdmin\ui\manager\EchartManager::class,
    ],
    //扫描权限目录
    'auth_scan' => [],
    
    //插件
    'plugin'=>[
        //插件目录
        'dir'=>dirname(__DIR__,5).DIRECTORY_SEPARATOR.'plugin',
        //插件命名空间
        'namespace'=>'plugin'
    ],
    //菜单
    //ExAdmin\ui\contract\MenuAbstract
    'menu'=>'',
];
