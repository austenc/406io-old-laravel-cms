<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @section('nav')
            <nav class="flex items-center justify-between flex-wrap bg-teal-dark p-6">
                <div class="flex items-center flex-no-shrink text-white mr-6">            
                    <span class="font-semibold text-xl tracking-tight">{{ config('app.name', '406.io') }}</span>
                </div>
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div class="lg:flex-grow">
                        @auth
                            <a href="{{ route('pages.index') }}" class="nav-item {{ request()->is('pages/*') ? 'active' : '' }}">Manage Pages</a>
                        @endauth
                    </div>
                    <div>
                        @auth                  

                            <a href="{{ route('logout') }}" 
                                class="nav-item"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        @show

        <div class="flex items-center justify-between flex-wrap bg-grey-light px-6">
            @section('title')
            @show
        </div>

        <div class="container mx-auto py-8 px-2">
            @yield('content')
        </div>
    </div>

    <div class="mx-auto w-full p-4 text-center text-sm text-grey pt-8">
        Copyright &copy; {{ date('Y') }} Austen Cameron, all rights reserved
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
