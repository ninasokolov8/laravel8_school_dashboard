<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if (session()->get('user.role') == "ROLE_ADMIN")
                <a class="navbar-brand" href="{{ url('/admin/') }}">
                    {{ config('app.name', 'Dashboard') }}
                </a>
                @elseif (session()->get('user.role') == "ROLE_STUDENT")
                    <a class="navbar-brand" href="{{ url('/student/') }}">
                        {{ config('app.name', 'Dashboard') }}
                    </a>
                @elseif (session()->get('user.role') == "ROLE_TEACHER")
                    <a class="navbar-brand" href="{{ url('/teacher/') }}">
                        {{ config('app.name', 'Dashboard') }}
                    </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (session()->get('user.role') == "ROLE_ADMIN")
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('admin.users') }}"  >
                                    Users
                                </a>
                                </li>
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('calendar.index') }}" >
                                    Calendar
                                </a>
                                </li>
                            @elseif (session()->get('user.role') == "ROLE_STUDENT")
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('logout') }}"  >
                                    Classes
                                </a>
                                </li>
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('calendar.index') }}" >
                                    Grades
                                </a>
                                </li>
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('calendar.index') }}"  >
                                    Calendar
                                </a>
                                </li>

                            @elseif (session()->get('user.role') == "ROLE_TEACHER")
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('logout') }}" >
                                    Classes
                                </a>
                                </li>
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('logout') }}"  >
                                    Grades
                                </a>
                                </li>
                                <li  class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="{{ route('calendar.index') }}" >
                                    Calendar
                                </a>
                                </li>
                            @endif
                                <li class="nav-item dropdown">


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                        <a class="nav-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        @csrf
                                    </form>

                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
