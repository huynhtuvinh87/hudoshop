<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'parent_id', 'level', 'title', 'slug', 'description', 'image', 'status'
    ];


    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id')->select('id', 'parent_id', 'title', 'slug', 'description', 'level')->where('status', '!=', 3);
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id')->select('id', 'parent_id', 'title', 'slug', 'description', 'level')->where('status', '!=', 3);
    }

    public function post()
    {
        return $this->hasMany('App\Models\PostCategory', 'category_id', 'id')->select(
            'posts.id',
            'posts.price',
            'posts.price_sale',
            'posts.title',
            'posts.slug',
            'posts.image'
        )->leftjoin('posts', function ($q) {
            $q->on('posts.id', 'post_categories.post_id');
        });
    }

    public function post_limit()
    {
        return $this->hasMany('App\Models\PostCategory', 'category_id', 'id')->select(
            'posts.id',
            'posts.price',
            'posts.price_sale',
            'posts.title',
            'posts.slug',
            'posts.image'
        )->leftjoin('posts', function ($q) {
            $q->on('posts.id', 'post_categories.post_id');
        })->limit(10);
    }


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
