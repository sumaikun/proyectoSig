<?php

namespace psig\Http\Middleware;

use Closure;
use Auth;
use response;
use View;
use Redirect;
use psig\models\Modusuarios;
use Session;
class user
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
      if (Auth::check()){
        $usuario = Modusuarios::find(Session::get('usu_id'));
        $rol = $usuario->roles;
            if ($rol->rol_nombre != 'usuario') {
                return response(View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.'));
            }
        }
        else
        {
            return Redirect::guest('login')->with('msg', 'Debes identificarte primero.');
        }
        return $next($request);
    }
}
