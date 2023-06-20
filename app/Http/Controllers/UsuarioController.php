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
            //dd('deu bom');

            // Combos 
            $setores = DB::table('chc_pcc')->whereRaw('coalesce(pcc_inativ,"N")="N"')->get(); // setor
            $convenios = DB::table('clientes')->select('xclientes as codigo','razao')->get(); // convênio
            // -----------

            return view('dash.index',compact('setores','convenios'));
        } else {
            // Não logou
            return redirect()->back()->with('danger','Credencial inválida');
        }
    }

    public function out()
    {
        Auth::logout();
        return view('login.index');
    }
}
