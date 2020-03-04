<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'blog_id',
        'user_id',
        'comment_id'
    ];

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
