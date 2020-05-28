<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;
use App\Models\Menu;

class ConstantFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'constant';
    }
}
