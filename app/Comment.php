<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id', 
        'blog_id',
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
