@extends('front.template.main')

@section('title', 'Perfil de ' . $user->name . ' | Red Social')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="portada" >
					
					<img src="{{ asset('images/portada.jpg')}}" style="width: 920px; height: 300px;">
					<button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon float-right" style="right:20px; top: 10px; background-color: rgba(238,251,244,0.2); position: absolute;">
                        <i class="material-icons">more_vert</i>
                    </button>

                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="demo-menu-lower-right">
                      <li class="mdl-menu__item">Cambiar foto de perfil</li>
                      <li class="mdl-menu__item">Cambiar foto de portada</li>
                      <li class="mdl-menu__item">Yet Another Action</li>
                    </ul>
					<img src="{{ asset('images/perfil.png')}}" class="img-perfil">
					<p id="user_username">{!!$user->name!!}</p>

				</div>
				<br>
				<div class="container page-container">
					@foreach($user->posts as $post)
						<div class="container-posts" style="margin-top: 2%;">
			                <div class="card">
			                    <div class="card-header">
			                        {{$post->user->name}}
			                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon float-right">
			                          <i class="material-icons">more_vert</i>
			                        </button>

			                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
			                            for="demo-menu-lower-right">
			                          <li class="mdl-menu__item">Some Action</li>
			                          <li class="mdl-menu__item">Another Action</li>
			                          <li disabled class="mdl-menu__item">Disabled Action</li>
			                          <li class="mdl-menu__item">Yet Another Action</li>
			                        </ul>
			                    </div>
			                    <div class="card-body">
			                        <p class="card-text">{{ $post->body}}</p>
			                    </div>
			                    <div class="card-footer text-muted">
			                    
			                        {!! Form::open(['route' => ['post.update.like', $post->id], 'method' => 'GET']) !!}
			                            @csrf
			                            @if($post->likes == 0)
			                                <a href="#" class="like">
			                                    <button class="like-button" id="like" onclick="action_like()">
			                                        <i class="far fa-thumbs-up"></i>
			                                    </button>
			                                </a>                     
			                                <span id="post_likes">{{ $post->likes}}</span>
			                            @else
			                                <a href="#" class="like" >
			                                    <button class="like-button" id="like" onclick="action_like()" 
			                                    @foreach($post->post_likes as $likes)
			                                        @if($likes->user_id === Auth::user()->id)
			                                        style="background-color: #4286f4;"
			                                        @else
			                                        style="background-color: white;"
			                                        @endif
			                                    @endforeach
			                                     />
			                                        <i class="far fa-thumbs-up"></i>
			                                    </button>
			                                </a>
			                                <span id="post_likes" >{{ $post->likes}}</span>
			                            @endif
			                            <div class="float-right">
			                                <i class="fa fa-clock"></i> {{$post->created_at->diffForHumans()}}
			                            </div>
			                        {!! Form::close() !!}
			                    </div>
			                </div>
			                <p style="padding-left: 20px;">Comentarios<p>
			                @foreach($comments as $comment)

			                    @if($comment->post_id == $post->id)
			                        <div class="comment-container">
			                             <div class="card" style="padding: 20px; box-sizing: border-box;">
			                                 <div class="card-header" style="border-left: 2px solid blue">
			                                     {{$comment->user->name}}
			                                 </div>
			                                 <div class="card-body" style="border-left: 2px solid blue">
			                                     {{$comment->body}}
			                                 </div>
			                                 <div class="card-footer" style="border-left: 2px solid blue">
			                                     {!! Form::open(['route' => ['comment.like', $comment->id], 'method' => 'GET']) !!}
			                                        @csrf
			                                        @if($comment->likes == 0)
			                                            <a href="#" class="comment-like">
			                                                <button class="like-button" id="comment-like" onclick="action_comment_like()">
			                                                    <i class="far fa-thumbs-up"></i>
			                                                </button>
			                                            </a>                     
			                                            <span id="comment_likes">{{ $comment->likes}}</span>
			                                        @else
			                                            <a href="#" class="comment-like" >
			                                                <button class="like-button" id="comment-like" onclick="action_comment_like()" 
			                                                @if(is_array($comment->comment_likes) || is_object($comment->comment_likes))
			                                                    @foreach($comment->comment_likes as $c_likes)
			                                                        @if($c_likes->user_id === Auth::user()->id)
			                                                        style="background-color: #4286f4;"
			                                                        @else
			                                                        style="background-color: white;"
			                                                        @endif
			                                                    @endforeach
			                                                @endif
			                                                 />
			                                                    <i class="far fa-thumbs-up"></i>
			                                                </button>
			                                            </a>
			                                            <span id="comment_likes" >{{ $comment->likes}}</span>
			                                        @endif
			                                        <div class="float-right">
			                                            <i class="fa fa-clock"></i> {{$comment->created_at->diffForHumans()}}
			                                        </div>
			                                    {!! Form::close() !!}
			                                 </div>
			                             </div>
			                        </div>  
			                    @endif
			                @endforeach
			                {!! Form::open(['route' => ['post.comment', $post->id], 'method' => 'POST', 'class' => 'comment-form']) !!}
		                    @csrf
		                    <div class="form-group">
		                        {!! Form::textarea('body', null, ['class' => 'form-control textarea-comment', 'id' => 'comment', 'placeholder' => 'Escribe un comentario...', 'required', 'rows' => '3']) !!}
		                    </div>
		                    <div class="form-group">
		                        {!! Form::submit('Comentar', ['class' => 'btn btn-primary float-right'] ) !!}
		                    </div>
		                {!! Form::close() !!}
		                
		                <br>
		            </div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
@endsection