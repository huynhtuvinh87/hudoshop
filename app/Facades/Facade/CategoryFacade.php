<?php

namespace App\Facades\Facade;

use Illuminate\Support\Facades\Facade;

class CategoryFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'category';
    }
}
