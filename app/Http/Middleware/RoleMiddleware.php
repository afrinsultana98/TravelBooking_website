<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle($request, Closure $next)
     {
         if (Auth::check()) {
             if ( $request->user()->can('admin-panel')) {
                 return redirect()->route('admin.index');
             } else {
                return redirect()->route('home.index');
             }
         }

         return $next($request);
     }

}
