<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! config('app.name', 'Sport Manager') !!}</title>

    <!-- Styles -->
    {!! Html::style('css/vendor.css') !!}
    {!! Html::style('css/app.css') !!}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
            <div class="container"> 
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Sport Manager') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::check())
                        <ul class="nav navbar-nav">
                        <li class="{{ Request::is('country') ? 'active' : '' }}"><a href="{{ route('country.index') }}">Сountries</a></li>
                            <li class="{{ Request::is('sport') ? 'active' : '' }}"><a href="{{ route('sport.index') }}">Sports</a></li>
                            <li class="{{ Request::is('team') ? 'active' : '' }}"><a href="{{ route('team.index') }}">Teams</a></li>
                            <li class="{{ Request::is('player') ? 'active' : '' }}"><a href="{{ route('player.index') }}">Players</a></li>
                            <li class="{{ Request::is('tournament') ? 'active' : '' }}"><a href="{{ route('tournament.index') }}">Tournaments</a></li>
                            <li class="{{ Request::is('game') ? 'active' : '' }}"><a href="{{ route('game.index') }}">Games</a></li>
                        </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    {{ Html::script('js/vendor.js') }}
    {{ Html::script('js/app.js') }}
    @yield('scripts')

</script>
</body>
</html>
