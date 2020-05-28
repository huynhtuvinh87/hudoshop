<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'code', 'maker', 'type', 'title', 'slug', 'description', 'content', 'price', 'price_sale', 'image', 'images', 'meta_keyword', 'meta_description', 'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
