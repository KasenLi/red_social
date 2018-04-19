<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(4);
        $posts->each(function($posts){
            $posts->user;
        });
        return view('home')->with('posts', $posts);
    }

    public function like($id)
    {
        $post = Post::find($id);
        $likes = $post->likes + 1;
        $post->likes = $likes;
        $post->save();
        
        return redirect()->route('home'); 
    }
}
