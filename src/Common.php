<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-03-08
 * Time: 20:54
 */

namespace ExAdmin\ui;


use ExAdmin\ui\contract\CommonInterface;
use ExAdmin\ui\response\Response;

class Common implements CommonInterface
{
    public function config(): Response
    {
        return Response::success(ui_config('*'));
    }
}