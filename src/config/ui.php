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
    //布局 default classic
    'layout'=>'default',
    //布局方向 horizontal vertical
    'layout_direction'=>'horizontal',
    //主题 light 暗黑dark
    'theme' => 'light',
    //主题色
    'theme_color' => '#1890ff',
    //导航模式 sideTopMenuLayout sideMenuLayout topMenuLayout
    'navigationMode' => 'sideTopMenuLayout',
    //布局背景色
    'layout_background'=>'#f0f2f5',
    //顶部栏
    'header'=>[
        //文字颜色
        'text_color'=>'#393939',
        //选中色
        'color'=>'#1890ff',
        //背景色
        'background'=>'#ffffff',
    ],
    //侧边栏
    'sidebar' => [
        //文字颜色
        'text_color'=>'#393939',
        //选中色
        'color'=>'#1890ff',
        //背景色
        'background'=>'#ffffff',
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
