<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CatalogView
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('catalog-view') === 'grid') {
            session(['catalog-view' => 'grid']);
        }

        if ($request->get('catalog-view') === 'list') {
            session(['catalog-view' => 'list']);
        }

        return $next($request);
    }
}
