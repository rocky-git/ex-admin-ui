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
        'manager' => '',
    ],
    'form' => [
        //ExAdmin\ui\Manager
        'manager' => '',
        //ExAdmin\ui\contract\ValidatorForm
        'validator' => '',
    ],
    //扫描权限目录
    'auth_scan' => [],
    //语言
    'lang' => [
        // 默认语言
        'default'=>'zh-CN',
        //语言列表
        'list'=>[
            'zh-CN'=>'中文',
            'en'=>'English',
        ]
    ],
    //布局 headerSider顶部侧边  sider侧边
    'layout'=>'headerSider',
    //主题 light 暗黑dark
    'theme' => 'light',
    //主题色
    'theme_color' => 'red',
    //菜单主题 dark light
    'menu_theme' => 'dark',
    //导航模式 sideTopMenuLayout sideMenuLayout topMenuLayout
    'navigationMode' => 'sideTopMenuLayout',
    //侧边栏
    'sidebar' => [
        //宽度
        'width'=>200,
        //是否收起状态
        'collapsed' => false,
        //显示隐藏
        'visible' => true,
    ],
    //多页标签
    'tabs' => true,
    //登录路由
    'loginRoute' => '/ex-admin/login/index',
    //公用渲染路由前缀
    'commonRoutePrefix' => 'common/',
    //后台渲染路由前缀
    'adminRoutePrefix' => '',
    //主题css
    'theme_css'=>[

        'light'=>file_get_contents(__DIR__.'/../../theme/antd.min.css'),

        'dark'=>file_get_contents(__DIR__.'/../../theme/antd.dark.min.css'),
    ]
];
