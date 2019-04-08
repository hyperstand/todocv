<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // '/lists/all'
    ];

    public function handle($request, Closure $next)
    {
        $routeAction = $request->route()->getAction();
        if (isset($routeAction['no_csrf_check']) && $routeAction['no_csrf_check']) {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
