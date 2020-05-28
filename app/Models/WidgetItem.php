<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'widget_id', 'post_id'
    ];

    public function page()
    {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
    public function post()
    {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
