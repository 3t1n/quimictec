<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        //irá pegar as regras de cargo da rota
        //oq vier do array da rota
        $roles = $this->getRequiredRoleForRoute($request->route());
        //dd($request->user()->hasRole($roles));
        // Cheque se a regra é requerida na rota, e
        // se for, enquadre ele nesse cargo e autorize as seguintes ações.
        if($request->user()->hasRole($roles) || !$roles)
        {
            return $next($request);
        }
        return response()->json([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'Você não tem permissão para acessar essa página.'
            ]
        ], 401);
    }
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
