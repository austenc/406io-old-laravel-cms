<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Avenir:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Avenir', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                height: 100vh;
                align-items: center;
                display: flex;
                justify-content: center;
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-weight: normal;
                font-size: 64px;
                margin-bottom: 80px;
            }

            .title small {
                display: block;
                margin: 0 auto;
                text-align: center;
                font-size: 16px;
                color: #999;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                margin-top: 2em;
                margin-bottom: 2em;
            }

            hr {
                width: 70%;
                margin: 2em auto;
                margin-bottom: 2em;
                color: transparent;
                background-color: transparent;
                border: 0; border-top: 1px solid #eee;
            }
        </style>
    </head>
    <body>
        <div class="flex-center">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <h1 class="title">
                    Hello!
                    <small>
                        Nov. 6th, 2017
                    </small>
                </h1>

                <p style="margin: 0 auto; max-width: 800px;">
                    I'm Austen Cameron -- a web developer and outdoor enthusiast. 
                    I've built a lot of websites over the years. This has given me the 
                    opportunity to explore many different CMS platforms and frameworks, 
                    but like many other developers, I've spent more hours 
                    rebuilding my site than actually writing content for it. 
                </p>
                <hr>
                <p style="margin: 0 auto; max-width: 800px; margin-top: 1em;">
                    <strong>This time I'm taking a different approach.</strong>
                    <br><br>
                    In the past, I've built my site on things like 
                    <a href="https://octobercms.com/">October CMS</a>, 
                    <a href="https://wordpress.org/">Wordpress</a>, 
                    <a href="https://getgrav.org/">Grav CMS</a>, and 
                    <a href="https://statamic.com/">Statamic</a> (briefly). 
                    While these are all great platforms, none of them ever felt 
                    "perfect". This time, I'm starting with a new Laravel (5.5) 
                    install and doing everything from scratch and open-source. 
                    I'll be documenting every part of the build process as I take the site 
                    from a scratch Laravel install to a dynamic markdown-content-supporting beast. 
                    Hopefully we can all learn something together and enjoy the ride!
                </p>
                <hr>
                <div class="links">
                    <a href="http://archive.406.io">Old Site Archives</a>
                </div>
            </div>
        </div>
    </body>
</html>
