<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostLike;
use App\Comment;
use App\CommentLike;
use Carbon\Carbon;
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
        Carbon::setLocale('es');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(4);
        //$post_likes = PostLike::where('user_id', Auth::user()->id)->get();
        $posts->each(function($posts){
            $posts->user;
            $posts->post_likes;
        });
        $comments = Comment::orderBy('id', 'ASC')->get();
        $comments->each(function($comments){
            $comments->user;
            $comments->comment_likes;
        });
        
        return view('home')->with('posts', $posts)->with('comments', $comments);
    }

    public function comment(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = \Auth::user()->id;
        $comment->post_id = $id;
        $comment->save();

        return redirect()->route('home');
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
    
    public function comment_like(Request $request, $id)
    {
        if($request->ajax()){
            $existe_like = CommentLike::where('comment_id', $id)->get();
            $comment = Comment::find($id);
            $message_c = "";
            $likes_count_c = 0;
            if(count($existe_like) > 0){
               foreach ($existe_like as $like) {
                    global $message_c, $likes_count_c;
                    if($like->user_id !== \Auth::user()->id){
                        
                        $likes = $comment->likes + 1;
                        $comment->likes = $likes;
                        $comment->save();

                        $new_comment_like = new CommentLike($request->all());
                        $new_comment_like->user_id = \Auth::user()->id;
                        $new_comment_like->comment_id = $id;
                        $new_comment_like->save();

                        $likes_count_c = CommentLike::where('comment_id', $id)->count();
                        $message_c = "Ya no me gusta";
                        
                    }else{

                        $user_id = \Auth::user()->id;
                        $comment_like = CommentLike::where('user_id', $user_id)->where('comment_id', $id);
                        $comment_like->delete();
                        $likes = $comment->likes - 1;
                        $comment->likes = $likes;
                        $comment->save();
                        $message_c = "Me gusta";
                        $likes_count_c = CommentLike::where('comment_id', $id)->count();
                    }
                }
            }else{
                $likes = $comment->likes + 1;
                $comment->likes = $likes;
                $comment->save();
                $comment_like = new CommentLike($request->all());
                $comment_like->user_id = \Auth::user()->id;
                $comment_like->comment_id = $id;
                $comment_like->save();

                $likes_count_c = CommentLike::where('comment_id', $id)->count();
                $message_c = "Ya no me gusta";
            } 
        }
        return response()->json([
            'total' =>  $likes_count_c,
            'mensaje' => $message_c
        ]);
            
    }     
}
