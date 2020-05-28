<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;

class ProvinceFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'province';
    }
}
