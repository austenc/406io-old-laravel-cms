<?php

namespace App\Http\Middleware;

use Closure;

class PublishedOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->route('page')->published_at)) {
            abort(404);
        }

        return $next($request);
    }
}
