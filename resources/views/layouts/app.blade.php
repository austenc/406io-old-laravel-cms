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

@section('bodytag')
<body>
@show

    @section('adminbar')
        @auth
            <div class="admin-bar">
                <div>
                    <a href="{{ url('/') }}" class="mr-6 text-grey-dark">
                        <i class="fa fa-fw fa-home"></i>
                        406.io
                    </a>
                    <a href="{{ route('pages.index') }}" class="text-grey @active('pages')">
                        <i class="fa fa-fw fa-newspaper"></i>
                        Pages
                    </a>
                    @if (Route::currentRouteName() == 'pages.edit' && isset($page)) 
                        <a href="{{ route('pages.display', $page) }}" class="text-grey">
                            <i class="fa fa-fw fa-search"></i>
                            View Page
                        </a>                        
                    @endif

                    @if (Route::currentRouteName() == 'pages.display' && isset($page)) 
                        <a href="{{ route('pages.edit', $page) }}" class="text-grey">
                            <i class="fa fa-fw fa-edit"></i>
                            Edit Page
                        </a>                        
                    @endif
                </div>
                <div class="text-right">
                     <a href="{{ route('logout') }}" 
                        class="text-grey"
                        onclick="event.preventDefault();
                        if (confirm('Are you sure?')) { document.getElementById('logout-form').submit(); }">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>                                   
                </div>                
            </div>
        @endauth
    @show
    
    @yield('nav')

    <div class="wrap">
        <div id="app">
            <div class="page-bar">
                @section('title')
                @show
            </div>
            
            @yield('content')
        
            <vue-toast ref="toast"></vue-toast>
        </div>

        @yield('comments')

        @yield('footer')
    
    </div> {{-- .wrap --}}

    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
