<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '406.io') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @section('nav')
        @auth
        <nav class="navbar-admin">
            <div class="flex items-center flex-no-shrink text-white mr-6">            
                <a href="{{ url('/') }}" class="font-semibold text-xl tracking-tight text-white">
                    {{ config('app.name', '406.io') }}
                </a>
            </div>
            <div class="block lg:hidden">
                <button id="sidebar-toggle" class="px-3 py-2 pb-1  text-white hover:text-white">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <button id="sidebar-close" class="hidden px-2 py-2 pb-1 text-white hover:text-white">
                    <i class="fa fa-fw fa-times"></i>
                </button>              
            </div>
            <div id="sidebar" class="hidden z-50 w-2/3 sm:w-1/3 fixed pin-y pin-l flex-none bg-grey-light overflow-y-scroll lg:overflow-visible scrolling-touch lg:static lg:scrolling-auto lg:border-none shadow lg:shadow-none lg:bg-transparent lg:flex-grow lg:flex lg:w-auto lg:flex-row flex-col">
                <div class="flex-1 overflow-y-scroll">
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('pages.index') }}" class="nav-item {{ request()->is('pages/*') || request()->is('pages') ? 'active' : '' }}">Manage Pages</a>
                    </div>
                <div class="lg:p-0">
                    <a href="{{ route('logout') }}" 
                        class="nav-item"
                        onclick="event.preventDefault();
                        if (confirm('Are you sure?')) { document.getElementById('logout-form').submit(); }">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </nav>
        @endauth
    @show

    <div class="wrap">
        <div id="app">
            <div class="admin-title-bar">
                @section('title')
                @show
            </div>
            
            @yield('content')
        
            <vue-toast ref="toast"></vue-toast>
        </div>

        @yield('comments')

    </div>

    <div class="footer">
        <strong class="text-lg block mb-4 font-heading">
            <i class="fa fa-heart text-red"></i> Follow Me On Social Media 
        </strong>
        <div class="text-xl mb-4">
            <div class="fa-2x">
                <a href="https://twitch.tv/austencam" class="fa-layers fa-fw text-white twitch-icon">
                    <i class="fas fa-circle"></i>
                    <i class="fab fa-twitch" data-fa-transform="shrink-6"></i>
                </a>
                <a href="https://twitter.com/austencam" class="fa-layers fa-fw text-white twitter-icon">
                    <i class="fas fa-circle"></i>
                    <i class="fab fa-twitter" data-fa-transform="shrink-6"></i>
                </a>
            </div>
        </div>

        <div class="copyright">
            Copyright &copy; {{ date('Y') }} Austen Cameron, all rights reserved
        </div>
    </div>

    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
