<?php

namespace ExAdmin\ui\test;

use ExAdmin\ui\component\common\Html;
use ExAdmin\ui\component\Component;
use ExAdmin\ui\contract\LoginInterface;
use ExAdmin\ui\response\Response;

class Login implements LoginInterface
{

    public function index(): Component
    {
        return ui_view(file_get_contents(__DIR__ . '/login.vue'));
    }

    public function check(array $data): Response
    {
        return Response::success([
            'token' => '234234234',
        ]);
    }
    

    public function logout(): Response
    {
        return Response::success();
    }
}
