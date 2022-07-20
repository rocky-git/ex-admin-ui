<?php
return [
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
    'theme_color' => '#1890ff',
    //菜单主题 dark light
    'menu_theme' => 'dark',
    //导航模式 sideTopMenuLayout sideMenuLayout topMenuLayout
    'navigationMode' => 'sideTopMenuLayout',
    //header背景色
    'header_background'=>'#121929',
    //侧边栏
    'sidebar' => [
        //选中色
        'color'=>'#1890ff',
        //背景色
        'background'=>'#121929',
        //宽度
        'width'=>200,
        //是否收起状态
        'collapsed' => false,
        //显示隐藏
        'visible' => true,
        //菜单并排数量
        'menu_num'=>1
    ],
    //多页标签
    'tabs' => true,
    //登录路由
    'loginRoute' => '/ex-admin/login/index',
    //公用渲染路由前缀
    'commonRoutePrefix' => 'common/',
    //后台渲染路由前缀
    'adminRoutePrefix' => '',
];
