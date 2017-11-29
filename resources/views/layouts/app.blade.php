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
        <nav class="flex items-center justify-between flex-wrap bg-teal-dark p-4">
            <div class="flex items-center flex-no-shrink text-white mr-6">            
                <a href="{{ url('/') }}" class="font-semibold text-xl tracking-tight text-white">
                    {{ config('app.name', '406.io') }}
                </a>
            </div>
            <div class="block lg:hidden">
                <button id="sidebar-toggle" class="px-3 py-2 pb-1  text-teal-lighter hover:text-white hover:border-white">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
                <button id="sidebar-close" class="hidden px-2 py-2 pb-1">
                    <svg class="w-4 h-4 cursor-pointer text-teal-lighter" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"></path></svg>
                </button>              
            </div>
            <div id="sidebar" class="hidden z-50 w-2/3 sm:w-1/3 fixed pin-y pin-l flex-none bg-grey-light overflow-y-scroll lg:overflow-visible scrolling-touch lg:static lg:scrolling-auto lg:border-none shadow lg:shadow-none lg:bg-transparent lg:flex-grow lg:flex lg:w-auto lg:flex-row flex-col">
                <div class="flex-1 overflow-y-scroll">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('pages.index') }}" class="nav-item {{ request()->is('pages/*') || request()->is('pages') ? 'active' : '' }}">Manage Pages</a>

                    @endauth
                </div>
                <div class="lg:p-0">
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

    <div id="app">
        <div class="flex items-center justify-between flex-wrap bg-grey-light px-6">
            @section('title')
            @show
        </div>
        
        <div class="container mx-auto py-8 px-2">
            @yield('content')
        </div>

        <vue-toast ref="toast"></vue-toast>
    </div>


    <div class="mx-auto w-full p-4 text-center text-sm text-grey pt-8">
        Copyright &copy; {{ date('Y') }} Austen Cameron, all rights reserved
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
