<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'menu_id', 'parent_id', 'order', 'level', 'title', 'link', 'type', 'type_id'
    ];


    public function children()
    {
        return $this->hasMany('App\Models\MenuItem', 'parent_id', 'id')->select('id', 'parent_id', 'order', 'title', 'link', 'level', 'type', 'type_id')->orderBy('order', 'asc');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'parent_id')->select('id', 'order', 'parent_id', 'title', 'link', 'level', 'type', 'type_id')->orderBy('order', 'asc');
    }

    public function page()
    {
        return $this->hasOne('App\Models\Post', 'id', 'type_id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
