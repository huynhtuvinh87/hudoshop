<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
