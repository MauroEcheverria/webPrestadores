<footer class="main-footer">
    <strong>&copy; {{ now()->year }} Dreconstec</strong> | Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      @if (Auth::user() && auth()->user()->email == "maurovinicio.echeverria@gmail.com")
      @auth
      Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}
      @else @endauth
      @endif
    </div>
</footer>