<nav class="navbar navbar-expand-md navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">Red Social</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        @guest
        {!! Form::open([ 'route' => 'login', 'method' => 'POST', 'class' => 'form-inline my-2 my-lg-0' ]) !!}
          @csrf
          {!! Form::text('login',null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Username ó Email', 'id' => 'login', 'required' => 'true', 'autofocus' => 'true']) !!}
          {!! Form::password('password', ['class' => 'form-control mr-sm-2', 'placeholder' => 'Contraseña']) !!}
          {!! Form::submit('Entrar', ['class' => 'btn btn-secondary my-2 my-sm-0']) !!}
        {!! Form::close() !!}
        <a class="btn btn-link" style="color: white" href="{{ route('password.request') }}">
            {{ __('¿Olvidó su contraseña?') }}
        </a>
        @else
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="navbarDropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="#" class="dropdown-item"
              onclick="event.preventDefault();
                            document.getElementById('profile-form').submit();">
                {{ __('Perfil') }}
            </a>
            {!! Form::open(['route' => ['profile.index', Auth::user()->id], 'method' => 'GET', 'id' => 'profile-form', 'style' => "display:none;"]) !!}
              @csrf
            {!! Form::close() !!}
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>
      @endguest
      </ul>
    </div>
  </div>
</nav>