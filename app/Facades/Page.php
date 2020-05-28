<?php

namespace App\Facades;

use Storage;
use App\Models\Post;

class Page
{
    public function getById($id)
    {

        if (isset(json_decode(Storage::disk('local')->get('page'))->{$id})) {
            return json_decode(Storage::disk('local')->get('page'))->{$id};
        }
        return false;
    }
    public function getBySlug($slug)
    {

        if (isset(json_decode(Storage::disk('local')->get('page'))->{$slug})) {
            return json_decode(Storage::disk('local')->get('page'))->{$slug};
        }
        return false;
    }
}
