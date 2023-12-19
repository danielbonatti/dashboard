<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ClientAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $token = $request->cookie('jwt');

        if ($token) {
            return $next($request);
        }

        //O token JWT não existe, redireciona o usuário para a página de login
        return redirect('http://localhost/loginCentralizado')->withCookie(cookie('intended_url', url()->previous()));
    }
}
