<?php

namespace App\Facades;

use App\Models\Post;
use Storage;

class Menu
{
    public function getByName($name)
    {
        if (isset(json_decode(Storage::disk('local')->get('menu'))->{$name})) {
            return json_decode(Storage::disk('local')->get('menu'))->{$name};
        }
        return FALSE;
    }

    public function getByType($name)
    {
        if (isset(json_decode(Storage::disk('local')->get('menu'))->{$name})) {
            return json_decode(Storage::disk('local')->get('menu'))->{$name};
        }
        return FALSE;
    }
}
