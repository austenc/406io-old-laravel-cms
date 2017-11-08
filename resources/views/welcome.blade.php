<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Web Dev | 406.io</title>


        <!-- Styles -->
        <style>
            @import("https://fonts.googleapis.com/css?family=Avenir:100,600");
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Avenir', sans-serif;
                font-weight: 100;
                margin: 0;
                padding: 1em;
            }

            .flex-center {
                align-items: center;
                display: flex;
                margin-top: 0;
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
                margin-bottom: 40px;
            }
            h3 {
                margin-top: 3rem;
                margin-bottom: 0.5rem;
            }

            h4 {
                margin-bottom: 0.5rem;
            }

            .title small, .date {
                display: block;
                margin: 0 auto;
                text-align: center;
                font-size: 14px;
                margin-bottom: 1rem;
                color: #999;
            }

            .links  {
                margin: 2rem auto;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            ul > li {
                margin-bottom: 2rem;
                list-style: none;
            }

            code, pre {
                background-color: #eee;
                padding: 0.15rem;
                border-radius: 4px;
            }
            pre {
                white-space: pre-line;
                margin-top: 0.25em;
                padding: 0.75em;
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
                    My name is Austen Cameron, I'm a professional web developer and technology enthusiast.
                    In the past 15+ years of being a developer, I've gotten the 
                    opportunity to explore many different frameworks, CMS platforms and packages. 
                    Like many other developers, I've spent more hours rebuilding 
                    my site over the years than actually writing content for it. 
                </p>
                <p style="margin: 0 auto; max-width: 800px; margin-top: 2em;">
                    <strong>This time I'm taking a different approach.</strong>
                    <br><br>
                    In the past, I've built my site on things like 
                    <a href="https://octobercms.com/">October CMS</a>, 
                    <a href="https://wordpress.org/">Wordpress</a>, 
                    <a href="https://getgrav.org/">Grav CMS</a>, and 
                    <a href="https://statamic.com/">Statamic</a> (briefly). 
                    While these are all great platforms, none of them ever felt 
                    "perfect". This time I'm starting with a new Laravel (5.5) 
                    install and building a new site from scratch. I'll be documenting 
                    every part of the build process as I take the site from a brand new 
                    framework install to a dynamic markdown-content-supporting beast. 
                    The whole project will be open source and available on github. 
                    Hopefully we can all learn something together and enjoy the ride!
                </p>
                <hr>
                <h3>First Steps and Making Things Look Better</h3>
                <small class="date">Nov. 7th, 2017</small>
                <div style="margin: 0 auto; max-width: 800px;">
                    <p>
                        Although I started and launched the site yesterday, there isn't much to it yet.
                        All I really did was run <br><code>composer create-project laravel/laravel</code>, 
                        edited some content and set up auto deploy with <a href="https://forge.laravel.com">Forge</a>.
                        For now, static content and pages are just fine, so my first order of business
                        will be to spruce up how the site looks.
                    </p>
                
                    <p>
                        To accomplish this, I'll be using <a href="https://tailwindcss.com/">Tailwind CSS</a>, 
                        an exciting new project from <a href="https://twitter.com/reinink">@reinink</a>, <a href="https://twitter.com/davidhemphill">@davidhemphill</a>, <a href="https://twitter.com/steveschoger">@steveschoger</a> 
                        and <a href="https://twitter.com/adamwathan">@adamwathan</a>. 
                        Admittedly, I'm super stoked to get the chance to use Tailwind, 
                        it's a project with a lot of promise, and it looks awesome so far!
                    </p>

                    <p>
                        <h4>Installing Tailwind and Getting Down to Business</h4>
                        Installing Tailwind in a Laravel project is pretty 
                        straightforward, here's what I did:                 
                        <br>
                        <ul style="text-align: left">
                            <li>
                                Install it as an npm dependency, and run its utility to create
                                a <strong>tailwind.js</strong> config file in your project's root
                                <br>
                                <pre>
                                    $ npm i tailwindcss
                                    $ ./node_modules/.bin/tailwind init
                                </pre>
                                
                            </li>
                            <li>
                                Added tailwind to the <strong>webpack.mix.js</strong> file, which now looks like this:
                                <br>
                                <pre>
                                    <code>
                                        let mix = require('laravel-mix');
                                        let tailwindcss = require('tailwindcss');
                                        
                                        mix.js('resources/assets/js/app.js', 'public/js')
                                           .sass('resources/assets/sass/app.scss', 'public/css')
                                           .options({
                                                processCssUrls: false,
                                                postCss: [ tailwindcss('./tailwind.js') ],
                                            });
                                    </code>
                                </pre>
                            </li>
                            <li>
                                Replaced the contents of <strong>resources/assets/sass/app.scss with</strong>
                                <br>
                                <pre>
                                    @tailwind preflight;
                                    @tailwind utilities;
                                </pre>
                            </li>
                        </ul>
                        Once I did those few steps, I ran <code>npm run dev</code> and 
                        I see tailwind classes in my generated app.css file, great!
                    </p>
                </div>
                
                <hr>
                <div class="links">
                    <a href="http://archive.406.io">Temporary Link to Old Site</a>
                </div>
            </div>
        </div>
    </body>
</html>
