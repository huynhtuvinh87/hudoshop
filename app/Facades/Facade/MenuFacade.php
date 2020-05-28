<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;
use App\Models\Menu;

class MenuFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
