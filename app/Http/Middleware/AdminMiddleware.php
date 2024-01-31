<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

//Para validar si un usuario es administrador y dejarlo pasar si es solo administrador
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Si el usuario autenticado es administrador, déjalo pasar y sino redirígelo a la ruta principal
        if (Auth::user()->rol_id == 2) {
            return $next($request); //Continuar el camino, no haría nada
        } else {
            return redirect('/');
        }
    }
}
