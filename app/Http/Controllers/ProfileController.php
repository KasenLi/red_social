<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Carbon\Carbon;

class ProfileController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
        Carbon::setLocale('es');
    }
    public function index($id){
    	$user = User::find($id);

    	$user->posts;
    	$comments = Comment::orderBy('id', 'ASC')->get();
        $comments->each(function($comments){
            $comments->user;
            $comments->comment_likes;
        });

 		return view('front.profile.index')->with('user',$user)->with('comments',$comments);
    }
}
