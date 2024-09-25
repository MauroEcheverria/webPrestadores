<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sistema de Negocios">
  <link href="{{ asset('vendor/bootstrap-5.1.3/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-5.1.3/dist/css/carousel.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-5.1.3/dist/css/features.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<title>@yield('title')</title>
</head>
<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ url('/') }}" class="nav-link px-2 {{ Request()->routeIs('/')? 'text-secondary' : 'text-white'}}">Inicio</a></li>
            <li><a href="{{ url('/productos') }}" class="nav-link px-2 {{ Request()->routeIs('info.productos')? 'text-secondary' : 'text-white'}}">Productos</a></li>
            <li><a href="{{ url('/planes') }}" class="nav-link px-2 {{ Request()->routeIs('info.planes')? 'text-secondary' : 'text-white'}}">Planes</a></li>
            <li><a href="{{ url('/contactanos') }}" class="nav-link px-2 {{ Request()->routeIs('info.contactanos')? 'text-secondary' : 'text-white'}}">Contáctanos</a></li>
            </ul>
            <div class="text-end">
              @if (Route::has('login'))
                @auth
                  <a href="{{ url('/dashboard') }}">
                    <button type="button" class="btn btn-outline-light me-2">Panel Principal</button>
                  </a>
                @else
                  <a href="{{ url('/login') }}">
                    <button type="button" class="btn btn-outline-light me-2">Inicio de Sesión</button>
                  </a>
                @endauth
              @endif
            </div>
        </div>
        </div>
    </header>
    @yield('content')
    <div class="container">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="{{ url('/') }}" class="nav-link px-2 text-muted">Inicio</a></li>
          <li class="nav-item"><a href="{{ url('/productos') }}" class="nav-link px-2 text-muted">Productos</a></li>
          <li class="nav-item"><a href="{{ url('/planes') }}" class="nav-link px-2 text-muted">Planes</a></li>
          <li class="nav-item"><a href="{{ url('/contactanos') }}" class="nav-link px-2 text-muted">Contáctanos</a></li>
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link px-2 text-muted">Inicio de Sesión</a></li>
        </ul>
        <p class="text-center text-muted">&copy; {{ now()->year }} Dreconstec 
            @if (Auth::user() && auth()->user()->email == "maurovinicio.echeverria@gmail.com")
            @auth
            | Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}
            @else @endauth
            @endif
        </p>
      </footer>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>