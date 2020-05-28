<?php

namespace App\Facades;

use Storage;

class Category
{
    public function get()
    {
        return json_decode(Storage::disk('local')->get('category.json'));
    }
}
