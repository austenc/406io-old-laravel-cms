<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Web Dev | 406.io</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex flex-wrap text-grey-darkest">
            <div class="text-center pt-8 leading-normal m-auto w-full sm:w-3/4 px-6 md:w-1/2">
                <h1>
                    Hello! <small class="mb-4 mt-2 block text-grey text-xs font-normal uppercase">Nov. 6th, 2017</small>
                </h1>

                <p>
                    My name is Austen Cameron, I'm a professional web developer and technology enthusiast.
                    In the past 15+ years of being a developer, I've gotten the 
                    opportunity to explore many different frameworks, CMS platforms and packages. 
                    Like many other developers, I've spent more hours rebuilding 
                    my site over the years than actually writing content for it. 
                </p>
                <p class="mt-6">
                    <strong>This time I'm taking a different approach.</strong>
                    <br><br>
                    In the past, I've built my site on things like 
                    <a href="https://octobercms.com/">October CMS</a>, 
                    <a href="https://wordpress.org/">Wordpress</a>, 
                    <a href="https://getgrav.org/">Grav CMS</a>, and 
                    <a href="https://statamic.com/">Statamic</a> (briefly). 
                    While these are all great platforms, none of them ever felt 
                    "just right". This time I'm starting with a new Laravel (5.5) 
                    install and building a site and management dashboard from scratch. 
                    I'll be documenting every part of the build process as I take 
                    the site from a brand new framework install to a dynamic 
                    markdown-content-supporting beast. The whole project will be 
                    open source and available on github. Hopefully we can all learn 
                    something together, enjoy the ride!
                </p>
                <p>
                    <h4 class="mt-4 mb-2">The Initial (Rough) Roadmap</h4>
                    <ol class="text-left pl-4 mx-auto mb-6 w-full sm:w-2/3">
                        <li class="pl-2">Add some initial design using <a href="https://tailwindcss.com">Tailwind CSS</a></li>
                        <li class="pl-2">Database-driven page structure</li>
                        <li class="pl-2">Markdown content support / display</li>
                        <li class="pl-2">Syntax Highlighting</li>
                        <li class="pl-2 text-grey">TBD</li>
                    </ol>
                </p>
                <hr class="my-8 mx-auto border-t-1 w-3/4">
                <h3>First Steps and Making Things Look Better</h3>
                <small class="mb-4 mt-2 block text-grey text-xs font-normal uppercase">Nov. 7th, 2017</small>
                <p>
                    Although I started and launched the site yesterday, there isn't much to it yet.
                    All I really did was run <code>composer create-project laravel/laravel</code>, 
                    edited some content and set up auto deploy with <a href="https://forge.laravel.com">Forge</a>.
                    For now, static content and pages are just fine, so my first order of business
                    will be to spruce up how the site looks.
                </p>
            
                <p>
                    To accomplish this, I'll be using <a href="https://tailwindcss.com/">Tailwind CSS</a>, 
                    an exciting new project from <a href="https://twitter.com/adamwathan">@adamwathan</a>, <a href="https://twitter.com/steveschoger">@steveschoger</a>, <a href="https://twitter.com/reinink">@reinink</a> 
                    and <a href="https://twitter.com/davidhemphill">@davidhemphill</a>. 
                    I've been looking for a good excuse to try out Tailwind, and the "from scratch"
                    nature of the framework fits right in with my vision for this project. 
                    After using it to create some simple styles, I must say working with Tailwind 
                    seems like a serious breath of fresh air, and that feels great!
                </p>

                <p>
                    <h4 class="mt-4 mb-2">
                        Installing Tailwind in a Laravel project is pretty 
                        straightforward, here's what I did:
                    </h4>
                                   
                    <ul class="list text-left">
                        <li>
                            Add the project as an npm dependency and run its utility to create
                            a <strong>tailwind.js</strong> config file in your project's root
                            <br>
<pre>
    $ npm i tailwindcss
    $ ./node_modules/.bin/tailwind init</pre>
                            
                        </li>
                        <li>
                            Add tailwind to the <strong>webpack.mix.js</strong> file, which should look like:
                            <br>
<pre>
    let mix = require('laravel-mix');
    let tailwindcss = require('tailwindcss');
    
    mix.js('resources/assets/js/app.js', 'public/js')
       .sass('resources/assets/sass/app.scss', 'public/css')
       .options({
            processCssUrls: false,
            postCss: [ tailwindcss('./tailwind.js') ],
        });</pre>
                        </li>
                        <li>
                            Replace the contents of <strong>resources/assets/sass/app.scss with</strong>
                            <br>
<pre>
    @tailwind preflight;
    @tailwind utilities;
</pre>
                        </li>
                    </ul>
                    Finally, run <code>npm run dev</code> and you should see 
                    the tailwind classes in the generated <strong>public/css/app.css</strong> file! 
                    From here, you can start creating your design. Chances are you'll find the <a href="https://tailwindcss.com/docs/adding-new-utilities/">adding new utilities</a> and <a href="https://tailwindcss.com/docs/extracting-components">extracting components</a> pages really helpful. Have fun!
                </p>
                
                <hr class="my-8 mx-auto border-t-1 w-3/4">
                <h3>Roughing Out a Plan</h3>
                <small class="mb-4 mt-2 block text-grey text-xs font-normal uppercase">Nov. 9th, 2017</small>
                <p>
                    Thus far we've installed Laravel and Tailwind CSS, so we've got an 
                    excellent starting point for the "application" part of the site. 
                    However, the static one-page nature of the site's content is 
                    starting to become a burden, so it's time to plan out a rudimentary 
                    content management system!
                </p>
                <strong class="block my-2 underline text-lg">The Outline</strong>
                <ul class="text-center list-reset pl-4 mx-auto mb-6 w-full sm:w-3/4">
                    <li class="pl-2 mb-2">Scaffold Laravel Authentication</li>
                    <li class="pl-2 mb-2">Page management CRUD (create-read-update-delete)</li>
                    <li class="pl-2 mb-2">Initial rough design and barebones dashboard page</li>
                    <li class="pl-2 mb-2">Display of single pages at direct URL (basic page router)</li>
                    <li class="pl-2 mb-2">A blog-like display of all pages with prev/next buttons</li>
                    <li class="pl-2 mb-2">Add support for markdown in content</li>
                </ul>
                <p>
                    Although I'm sure it will change, I think that's a pretty good outline 
                    for now. With that plan in mind, we'll get started on the code in the 
                    next article.
                </p>

                <hr class="my-8 mx-auto border-t-1 w-1/2">                
                <a href="http://archive.406.io" class="block uppercase no-underline text-sm my-8 font-semibold">
                    Temporary Link to Old Site
                </a>            
            </div>
        </div>
    </body>
</html>
