<?php

namespace App\Facades;

use Storage;

class Widget
{
    public function get()
    {
        return json_decode(Storage::disk('local')->get('widget.json'));
    }
}
