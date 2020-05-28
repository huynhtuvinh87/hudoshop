<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prefix', 'name'
    ];


    public function items()
    {
        return $this->hasMany('App\Models\WidgetItem', 'widget_id', 'id')->select(
            'post_id as id',
            'widget_id',
            'title',
            'slug',
            'image',
            'price',
            'price_sale',
            \DB::raw('(CASE WHEN posts.type = "widget" THEN posts.content ELSE "" END) AS content')
        )->leftjoin('posts', function ($q) {
            $q->on('posts.id', 'widget_items.post_id');
        });
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
