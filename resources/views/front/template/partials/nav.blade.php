<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Red Social</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
    {!! Form::open([ 'method' => 'POST', 'class' => 'form-inline my-2 my-lg-0' ]) !!}
      @csrf
      {!! Form::email('email',null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'example@example.com']) !!}
      {!! Form::password('password', ['class' => 'form-control mr-sm-2', 'placeholder' => 'Contraseña']) !!}
      {!! Form::submit('Entrar', ['class' => 'btn btn-secondary my-2 my-sm-0']) !!}
    {!! Form::close() !!}
    
  </div>
</nav>