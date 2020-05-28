<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;

class WidgetFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'widget';
    }
}
