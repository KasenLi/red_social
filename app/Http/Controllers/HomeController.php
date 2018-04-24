<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostLike;
use Illuminate\Support\Facades\Auth;

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
        $post_likes = PostLike::where('user_id', Auth::user()->id)->get();
        $posts->each(function($posts){
            $posts->user;
            $posts->post_likes;
        });
        return view('home')->with('posts', $posts)->with('post_likes', $post_likes);
    }

    public function like(Request $request, $id)
    {
        if($request->ajax()){
            $existe_like = PostLike::where('post_id', $id)->get();
            $post = Post::find($id);
            $message = "";
            $likes_count = 0;
            if(count($existe_like) > 0){
               foreach ($existe_like as $like) {
                    global $message, $likes_count;
                    if($like->user_id !== \Auth::user()->id){
                        
                        $likes = $post->likes + 1;
                        $post->likes = $likes;
                        $post->save();

                        $post_like = new PostLike($request->all());
                        $post_like->user_id = \Auth::user()->id;
                        $post_like->post_id = $id;
                        $post_like->save();

                        $likes_count = PostLike::where('post_id', $id)->count();
                        $message = "Ya no me gusta";
                        
                    }else{

                        $user_id = \Auth::user()->id;
                        $post_like = PostLike::where('user_id', $user_id)->where('post_id', $id);
                        $post_like->delete();
                        $likes = $post->likes - 1;
                        $post->likes = $likes;
                        $post->save();
                        $message = "Me gusta";
                        $likes_count = PostLike::where('post_id', $id)->count();
                    }
                }

            }else{
                $likes = $post->likes + 1;
                $post->likes = $likes;
                $post->save();
                $post_like = new PostLike($request->all());
                $post_like->user_id = \Auth::user()->id;
                $post_like->post_id = $id;
                $post_like->save();

                $likes_count = PostLike::where('post_id', $id)->count();
                $message = "Ya no me gusta";
            } 
        }
            
        return response()->json([
            'total' =>  $likes_count,
            'mensaje' => $message
        ]);
            
    }
         
}
