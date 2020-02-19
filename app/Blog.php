<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_id');
    }
}
