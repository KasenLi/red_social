<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = ['body', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function comments(){
    	return $this->hasMany('App\Comment');
    }
    public function likes(){
    	return $this->hasMany('App\PostLike');
    }
    
}
