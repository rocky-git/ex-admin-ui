<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-08
 * Time: 20:54
 */

namespace ExAdmin\ui\test;


use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\navigation\menu\MenuItem;
use ExAdmin\ui\contract\CommonInterface;
use ExAdmin\ui\contract\SystemAbstract;
use ExAdmin\ui\response\Response;

class System extends SystemAbstract
{

    /**
     * 头部导航右侧
     * @return array
     */
    public function navbarRight(): array
    {
        return [];
    }

    /**
     * 头部点击用户信息下拉菜单
     * @return array
     */
    public function adminDropdown(): array
    {
       return [
           MenuItem::create()->content('个人信息')
       ];
    }

    /**
     * 用户信息
     * @return array
     */
    public function userInfo(): array
    {
       return [
           'id' => 1,
           'nickname' => 'admin123',
           'avatar' => 'https://gw.alipayobjects.com/zos/antfincdn/XAosXuNZyF/BiazfanxmamNRoxxVxka.png',
       ];
    }

    /**
     * 菜单
     * @return array
     */
    public function menu(): array
    {
        return [
            [
                "id" => 1092,
                "pid" => 0,
                "name" => "菜单管理",
                "icon" => "fa fa-hourglass-start",
                "url" => "ex-admin/ExAdmin-laravel-Controllers-MenuController/index",
                "mark" => "",
                "sort" => 1,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 13=>57=>15",
                "update_time" => "2021-11-12 10=>16=>25"
            ],
            [
                "id" => 1093,
                "pid" => 0,
                "name" => "角色管理",
                "icon" => "fa fa-hourglass-start",
                "url" => "ex-admin/ExAdmin-laravel-Controllers-RoleController/index",
                "mark" => "",
                "sort" => 1,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 13=>57=>15",
                "update_time" => "2021-11-12 10=>16=>25"
            ],
            [
            "id" => 1011,
            "pid" => 0,
            "name" => "用户管理",
            "icon" => "fa fa-hourglass-start",
            "url" => "ex-admin/ExAdmin-laravel-Controllers-AdminController/index",
            "mark" => "",
            "sort" => 1,
            "open" => 1,
            "status" => 1,
            "admin_visible" => 1,
            "create_time" => "2021-11-10 13=>57=>15",
            "update_time" => "2021-11-12 10=>16=>25"
        ]
        ];
        return [
            [
                "id" => 1092,
                "pid" => 0,
                "name" => "启动页",
                "icon" => "fa fa-hourglass-start",
                "url" => "admin/system/startPage",
                "mark" => "",
                "sort" => 1,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 13=>57=>15",
                "update_time" => "2021-11-12 10=>16=>25"
            ],

            [
                "id" => 1096,
                "pid" => 0,
                "name" => "产品管理",
                "icon" => "fa fa-shopping-basket",
                "url" => "",
                "mark" => "",
                "sort" => 2,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-11 14=>57=>34",
                "update_time" => "2021-11-12 10=>15=>09",
                "children" => [
                    [
                        "id" => 10961,
                        "pid" => 1096,
                        "name" => "产品列表",
                        "icon" => "",
                        "url" => "admin/product",
                        "mark" => "",
                        "sort" => 3,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-10 10=>57=>42",
                        "update_time" => "2021-11-11 14=>57=>47",
                        "children" => [
                            [
                                "id" => 10861,
                                "pid" => 10961,
                                "name" => "产品列表",
                                "icon" => "",
                                "url" => "admin/product1",
                                "mark" => "",
                                "sort" => 3,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 10=>57=>42",
                                "update_time" => "2021-11-11 14=>57=>47"
                            ],
                            [
                                "id" => 10881,
                                "pid" => 10961,
                                "name" => "产品分类管理",
                                "icon" => "",
                                "url" => "admin/ProductCate/index",
                                "mark" => "",
                                "sort" => 5,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 11=>32=>20",
                                "update_time" => "2021-11-12 10=>18=>01"
                            ]
                        ]
                    ],
                    [
                        "id" => 1088,
                        "pid" => 1096,
                        "name" => "产品分类管理",
                        "icon" => "",
                        "url" => "admin/ProductCate",
                        "mark" => "",
                        "sort" => 5,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-10 11=>32=>20",
                        "update_time" => "2021-11-12 10=>18=>01"
                    ]
                ]
            ],


            [
                "id" => 1085,
                "pid" => 0,
                "name" => "供应商管理",
                "icon" => "fa fa-group",
                "url" => "admin/Supplier",
                "mark" => "",
                "sort" => 3,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 10=>35=>06",
                "update_time" => "2021-11-12 10=>17=>37"
            ],
            [
                "id" => 1087,
                "pid" => 0,
                "name" => "应用行业管理",
                "icon" => "fa fa-gg",
                "url" => "admin/Application",
                "mark" => "",
                "sort" => 4,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 11=>13=>41",
                "update_time" => "2021-11-12 10=>17=>25"
            ],
            [
                "id" => 1089,
                "pid" => 0,
                "name" => "外链设置",
                "icon" => "fa fa-link",
                "url" => "admin/Link",
                "mark" => "",
                "sort" => 6,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 13=>37=>19",
                "update_time" => "2021-11-12 10=>15=>37"
            ],
            [
                "id" => 1090,
                "pid" => 0,
                "name" => "广告管理",
                "icon" => "fa fa-image",
                "url" => "plugin/carousel/Index",
                "mark" => "carousel",
                "sort" => 8,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 13=>43=>48",
                "update_time" => "2022-02-10 10=>23=>52"
            ],
            [
                "id" => 1091,
                "pid" => 0,
                "name" => "内链地址管理",
                "icon" => "el-icon-link",
                "url" => "plugin/innerLink/Index",
                "mark" => "innerLink",
                "sort" => 9,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 13=>43=>50",
                "update_time" => "2021-11-16 12=>02=>33"
            ],
            [
                "id" => 1093,
                "pid" => 0,
                "name" => "同期活动",
                "icon" => "fa fa-sheqel",
                "url" => "",
                "mark" => "",
                "sort" => 11,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-11 09=>28=>40",
                "update_time" => "2022-02-16 17=>07=>29",
                "children" => [
                    [
                        "id" => 1114,
                        "pid" => 1093,
                        "name" => "同期活动列表",
                        "icon" => "",
                        "url" => "admin/activity",
                        "mark" => "",
                        "sort" => 1,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2022-02-16 17=>07=>41",
                        "update_time" => "2022-02-16 17=>07=>41"
                    ],
                    [
                        "id" => 1115,
                        "pid" => 1093,
                        "name" => "同期活动首页推荐",
                        "icon" => "",
                        "url" => "admin/ActivityTop",
                        "mark" => "",
                        "sort" => 2,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2022-02-16 17=>14=>07",
                        "update_time" => "2022-02-16 17=>14=>07"
                    ]
                ]
            ],
            [
                "id" => 1095,
                "pid" => 0,
                "name" => "行业新闻",
                "icon" => "fa fa-wpforms",
                "url" => "admin/news",
                "mark" => "",
                "sort" => 13,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-11 13=>58=>54",
                "update_time" => "2022-02-11 11=>14=>24"
            ],
            [
                "id" => 1098,
                "pid" => 0,
                "name" => "快速链接设置",
                "icon" => "fa fa-link",
                "url" => "admin/links",
                "mark" => "",
                "sort" => 15,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-11 16=>07=>18",
                "update_time" => "2021-11-12 10=>15=>21"
            ],
            [
                "id" => 1099,
                "pid" => 0,
                "name" => "宣传资料管理",
                "icon" => "fa fa-bullhorn",
                "url" => "",
                "mark" => "",
                "sort" => 16,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-11 17=>23=>08",
                "update_time" => "2021-11-12 10=>14=>00",
                "children" => [
                    [
                        "id" => 1101,
                        "pid" => 1099,
                        "name" => "宣传资料",
                        "icon" => "",
                        "url" => "admin/Info",
                        "mark" => "",
                        "sort" => 17,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-11 17=>23=>39",
                        "update_time" => "2021-11-11 17=>23=>39"
                    ],
                    [
                        "id" => 1100,
                        "pid" => 1099,
                        "name" => "宣传分类",
                        "icon" => "",
                        "url" => "admin/InfoCate",
                        "mark" => "",
                        "sort" => 17,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-11 17=>23=>28",
                        "update_time" => "2021-11-11 17=>23=>28"
                    ]
                ]
            ],
            [
                "id" => 1102,
                "pid" => 0,
                "name" => "日历",
                "icon" => "fa fa-calendar",
                "url" => "",
                "mark" => "",
                "sort" => 17,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-12 10=>00=>29",
                "update_time" => "2021-11-12 10=>13=>23",
                "children" => [
                    [
                        "id" => 1103,
                        "pid" => 1102,
                        "name" => "日历展会",
                        "icon" => "",
                        "url" => "admin/Calendar",
                        "mark" => "",
                        "sort" => 18,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-12 10=>00=>44",
                        "update_time" => "2021-11-12 10=>12=>42"
                    ]
                ]
            ],
            [
                "id" => 1105,
                "pid" => 0,
                "name" => "订阅电子快讯",
                "icon" => "fa fa-trademark",
                "url" => "admin/Subscribe",
                "mark" => "",
                "sort" => 19,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-16 10=>02=>39",
                "update_time" => "2021-11-16 10=>02=>39"
            ],
            [
                "id" => 1106,
                "pid" => 0,
                "name" => "用户管理",
                "icon" => "fa fa-user",
                "url" => "admin/User",
                "mark" => "",
                "sort" => 20,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-16 15=>40=>40",
                "update_time" => "2021-11-17 18=>18=>50"
            ],
            [
                "id" => 1107,
                "pid" => 0,
                "name" => "热搜标签",
                "icon" => "fa fa-tags",
                "url" => "admin/Tags",
                "mark" => "",
                "sort" => 21,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-17 18=>13=>00",
                "update_time" => "2021-11-17 18=>13=>16"
            ],
            [
                "id" => 1108,
                "pid" => 0,
                "name" => "专区 / 展团",
                "icon" => "fa fa-list-ul",
                "url" => "admin/Zones",
                "mark" => "",
                "sort" => 23,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-17 18=>29=>06",
                "update_time" => "2021-11-17 18=>29=>06"
            ],
            [
                "id" => 1109,
                "pid" => 0,
                "name" => "国家地区",
                "icon" => "el-icon-discount",
                "url" => "admin/Country",
                "mark" => "",
                "sort" => 24,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-18 16=>36=>37",
                "update_time" => "2021-11-18 16=>36=>37"
            ],
            [
                "id" => 1110,
                "pid" => 0,
                "name" => "分享链接",
                "icon" => "fa fa-share-square",
                "url" => "admin/link/share",
                "mark" => "",
                "sort" => 25,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2022-01-07 16=>33=>01",
                "update_time" => "2022-01-07 16=>49=>17"
            ],
            [
                "id" => 1111,
                "pid" => 0,
                "name" => "帮助图片",
                "icon" => "el-icon-help",
                "url" => "admin/Help",
                "mark" => "",
                "sort" => 26,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2022-01-07 16=>51=>04",
                "update_time" => "2022-01-07 16=>51=>04"
            ],
            [
                "id" => 1112,
                "pid" => 0,
                "name" => "极光推送",
                "icon" => "fa fa-volume-up",
                "url" => "plugin/jpush/Index",
                "mark" => "",
                "sort" => 27,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2022-01-08 10=>19=>15",
                "update_time" => "2022-01-08 10=>34=>54"
            ],
            [
                "id" => 1113,
                "pid" => 0,
                "name" => "产品/展商广告位",
                "icon" => "fa fa-tripadvisor",
                "url" => "admin/Adsense",
                "mark" => "",
                "sort" => 28,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2022-01-24 15=>02=>48",
                "update_time" => "2022-01-24 15=>08=>53"
            ],
            [
                "id" => 2,
                "pid" => 0,
                "name" => "系统管理",
                "icon" => "",
                "url" => "#",
                "mark" => "",
                "sort" => 1111,
                "open" => 1,
                "status" => 1,
                "admin_visible" => 1,
                "create_time" => "2021-11-10 10=>34=>11",
                "update_time" => null,
                "children" => [
                    [
                        "id" => 12,
                        "pid" => 2,
                        "name" => "权限管理",
                        "icon" => "el-icon-user-solid",
                        "url" => "",
                        "mark" => "",
                        "sort" => 5,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-10 10=>34=>11",
                        "update_time" => null,
                        "children" => [
                            [
                                "id" => 5,
                                "pid" => 12,
                                "name" => "系统用户管理",
                                "icon" => "el-icon-user",
                                "url" => "admin/admin",
                                "mark" => "",
                                "sort" => 4,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 10=>34=>11",
                                "update_time" => null
                            ],
                            [
                                "id" => 7,
                                "pid" => 12,
                                "name" => "访问权限管理",
                                "icon" => "el-icon-lock",
                                "url" => "admin/auth",
                                "mark" => "",
                                "sort" => 6,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 10=>34=>11",
                                "update_time" => null
                            ]
                        ]
                    ],
                    [
                        "id" => 4,
                        "pid" => 2,
                        "name" => "系统配置",
                        "icon" => "el-icon-s-tools",
                        "url" => "",
                        "mark" => "",
                        "sort" => 7,
                        "open" => 1,
                        "status" => 1,
                        "admin_visible" => 1,
                        "create_time" => "2021-11-10 10=>34=>11",
                        "update_time" => null,
                        "children" => [
                            [
                                "id" => 1014,
                                "pid" => 4,
                                "name" => "数据库备份",
                                "icon" => "fa fa-stack-exchange",
                                "url" => "admin/backup",
                                "mark" => "",
                                "sort" => 0,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 10=>34=>11",
                                "update_time" => null
                            ],
                            [
                                "id" => 3,
                                "pid" => 4,
                                "name" => "系统菜单管理",
                                "icon" => "el-icon-menu",
                                "url" => "admin/menu",
                                "mark" => "",
                                "sort" => 2,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 10=>34=>11",
                                "update_time" => null
                            ],
                            [
                                "id" => 11,
                                "pid" => 4,
                                "name" => "系统参数配置",
                                "icon" => "el-icon-setting",
                                "url" => "admin/system/config",
                                "mark" => "",
                                "sort" => 3,
                                "open" => 1,
                                "status" => 1,
                                "admin_visible" => 1,
                                "create_time" => "2021-11-10 10=>34=>11",
                                "update_time" => null
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}
