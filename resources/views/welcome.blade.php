@extends('front.template.main')

@section('title', 'Home')

@section('content')
    <div class="form-register" style="margin-top: 10%;">
        @include('auth.register')
    </div>
@endsection