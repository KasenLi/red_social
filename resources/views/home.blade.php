@extends('front.template.main')

@section('content')
<div class="container" style="margin-top: -3%; height: auto;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {!! Form::open([ 'route'=> 'posts.store', 'method' => 'POST' ]) !!}
                @csrf
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class' => 'form-control textarea-content', 'placeholder' => 'Nueva publicación...', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Publicar', ['class' => 'btn btn-primary float-right'] ) !!}
                </div>
            {!! Form::close() !!}
            @foreach($posts as $post)
            <br>
            <br>
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
                        {!! Form::close() !!}
                        
                    </div>
                    <p id="liked"></p>
                </div>
                <br>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        var activo = false;
        function action_like(){
            if(activo == false){
                document.getElementById("like").style.background = "#4286f4";
                activo = true;    
            }else{
                document.getElementById("like").style.background = "#fff";
            }
            
        }
        
        $(document).ready(function(){
            
            $('.like').click(function(e){
                e.preventDefault();

                var form = $(this).parents('form');
                var url = form.attr('action');

                $.get(url,form.serialize(), function(result){
                    $('#post_likes').html(result.total);
                    $('#like_status_c').html(result.mensaje);
                }).fail(function(){
                    $('.alert').html('Algo salió mal');
                });
            });
        });
    </script>
@endsection