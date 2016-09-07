<?php

namespace psig\Http\Middleware;

use Closure;
use Auth;
use psig\models\Modusuarios;
use Session;
use View;
use Redirect;
class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()){
             $usuario = Modusuarios::find(Session::get('usu_id'));
             $rol = $usuario->roles;
             if ($rol->rol_nombre != 'administrador')
            {
                //return response('Unauthorized.', 401);
              return response(View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.'));
            }
        }
        else{
        return Redirect::guest('login')->with('msg', 'Debes identificarte primero.');
        }
        return $next($request);
    }
}
