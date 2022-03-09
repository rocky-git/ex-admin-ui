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
use ExAdmin\ui\response\Response;

class Common implements CommonInterface
{
    public function navbarRight(): array{
        return [
            
        ];
    }
    public function adminDropdown(): array
    {
        return [
            MenuItem::create()->content('个人信息')
        ];
    }

    public function config(): Response
    {
        return Response::success(ui_config('*'));
    }
}
