<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function auth(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'E-mail obrigatório',
            'password.required' => 'Senha obrigatória'
        ]);
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Logou
            dd('deu bom');
            //return view('pesquisa.index');
        } else {
            // Não logou
            return redirect()->back()->with('danger','Credencial inválida');
        }
    }
}
