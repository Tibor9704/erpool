@if(Auth::check())
    <a href="{{ url('/profile') }}">Profil</a>
    <a href="{{ route('products.index') }}">Termékek</a>
    <a href="{{ route('purchases.index') }}">Vásárlások</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@else
    <a href="{{ route('login') }}">Bejelentkezés</a>
    <a href="{{ route('register') }}">Regisztráció</a>
@endif
