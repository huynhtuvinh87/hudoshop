<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;

class PageFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'page';
    }
}
