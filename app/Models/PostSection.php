<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSection extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'section_id', 'post_id'
    ];

    public function post()
    {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }

    public $timestamps = false;
}
