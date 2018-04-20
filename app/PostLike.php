<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = "post_likes";

    protected $fillable = ['user_id', 'post_id'];

    public function post(){
    	return $this->belongsTo('App\Post');
    }
}
