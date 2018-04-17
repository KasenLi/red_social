@extends('front.template.main')

@section('title', 'Home')

@section('content')
    <div class="form-register">
        @include('auth.register')
    </div>
@endsection