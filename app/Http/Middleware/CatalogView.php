<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CatalogView
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('catalog-view')) {
            $request->session()->put('catalog-view', $request->get('catalog-view'));
        }

        return $next($request);
    }
}
