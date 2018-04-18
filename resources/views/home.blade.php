@extends('front.template.main')

@section('content')
<div class="container" style="margin-top: -3%;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {!! Form::open(['method' => 'POST', ]) !!}
                @csrf
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class' => 'form-control textarea-content', 'placeholder' => 'Nueva publicación...', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Publicar', ['class' => 'btn btn-primary float-right'] ) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
