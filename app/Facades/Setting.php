<?php

namespace App\Facades;

use Storage;

class Setting
{
    public function get()
    {
        return json_decode(Storage::disk('local')->get('setting'));
    }
}
