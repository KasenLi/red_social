<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostLike;

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
            $posts->post_likes;
        });

        return view('home')->with('posts', $posts);
    }

    public function like(Request $request, $id)
    {
        if($request->ajax()){
            $existe_like = PostLike::where('post_id', $id)->get();
            if($existe_like->user_id !== \Auth::user()->id){
                $post = Post::find($id);
                $likes = $post->likes + 1;
                $post->likes = $likes;
                $post->save();

                $post_like = new PostLike($request->all());
                $post_like->user_id = \Auth::user()->id;
                $post_like->post_id = $id;
                $post_like->save();

                $likes_count = PostLike::where('post_id', $id)->count();
                
                
            }else{

            }
            return response()->json([
                'total' => $likes_count
            ]);
            
        }
         
    }
}
