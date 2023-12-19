<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        //Se o token JWT existir, redireciona o usuário para a págna inicial
        if ($request->hasCookie('jwt')) {
            return redirect()->route('home');
        }
        //Verificando se possui um link de redirecionamento no banco.
        $ssoLogin = DB::table('GSC_PAR')->where('CODIGO_EMP', 1)->value('PAR_UNILOG');

        //Se possuir, segue o fluxo, salva a url atual na sessão, e manda o usuário para o SSO.
        if ($ssoLogin) {
            return redirect($ssoLogin)->withCookie(cookie('intended_url', url()->previous()));
        } else {
            //Caso não possua, remove o cookie, e manda para a página de erro.
            $cookie = Cookie::forget('intended_url');
            return redirect()->route('error.page')->withCookie($cookie);
        }
    }

    public function error(Request $request)
    {
        //Verificando se possui um cookie de sessão
        if (!$request->hasCookie('intended_url')) {
            //Se não possuir, manda para a página de erro.
            return view('home.error');
        }
        //Se possuir, manda para a rota home.
        return redirect()->route('home');
    }

    public function out()
    {
        Auth::logout();
        $cookie = Cookie::forget('jwt');
        return redirect()->route('home')->withCookie($cookie);
    }
}
