<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }

    //Modo antigo
    /*public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'E-mail obrigatório',
            'password.required' => 'Senha obrigatória'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Logou
            //dd('deu bom');

            // Combos 
            $setores = DB::table('chc_pcc')->whereRaw('coalesce(pcc_inativ,"N")="N"')->get(); // setor
            $convenios = DB::table('clientes')->select('xclientes as codigo', 'razao')->get(); // convênio
            // -----------

            return view('dash.index', compact('setores', 'convenios'));
        } else {
            // Não logou
            return redirect()->back()->with('danger', 'Credencial inválida');
        }
    }*/

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['usr_usuari' => 'required', 'usr_senweb' => 'required|min:3|max:100'],
            [
                'usr_usuari.required' => 'O campo :attribute é obrigatório.',
                'usr_usuari.min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
                'usr_usuari.max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            ]
        )->setAttributeNames(['usr_usuari' => 'usuário', 'usr_senweb' => 'senha']);

        if (!$validator->fails()) {
            // Busca usuário
            $wo_usuari = User::where('usr_usuari', $request->usr_usuari);
            // Se o usuário tiver acesso web
            if ($wo_usuari->count() > 0) {
                // Descriptografa a senha
                $ws_senweb = $this->descriptografaSenha($wo_usuari);
                // Verifica se as senhas conferem
                if ($ws_senweb == $request->usr_senweb) {
                    $wo_usuari = $wo_usuari->first();
                    // Verifica se deve trocar a senha
                    if ($wo_usuari->remember_token == 'TROCASENHA') {
                        return redirect(route('login.alterar', $wo_usuari->nrecno));
                    }
                    // Verifica se o usuário é adm
                    if ($wo_usuari->inibido != 'S') {
                        // Faz o login
                        Auth::login($wo_usuari, $request->ws_lembra == 'on');
                        Auth::user()->usuarios = \DB::table('usuarios')->where('nome', Auth::user()->usr_usuari)->first();
                        Session::flash('mensagem_sucesso', 'Ok');

                        // Combos 
                        $setores = DB::table('chc_pcc')->whereRaw('coalesce(pcc_inativ,"N")="N"')->get(); // setor
                        $convenios = DB::table('clientes')->select('xclientes as codigo', 'razao')->get(); // convênio
                        // -----------

                        return view('dash.index', compact('setores', 'convenios'));
                    } else {
                        // Retorna caso não confiram
                        return redirect(route('login.page'))
                            ->withErrors(['mensagem_erro' => 'Usuário desabilitado.'])
                            ->withInput();
                    }
                } else {
                    return redirect(route('login.page'))
                        ->withErrors(['mensagem_erro' => 'Dados inválidos.'])
                        ->withInput();
                }
                // Retorna caso usuário não tenha acesso
            } else {
                return redirect(route('login.page'))
                    ->withErrors(['mensagem_erro' => 'Usuário não encontrado.'])
                    ->withInput();
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
    }

    public function alterarSenha($wn_nrecno)
    {
        return view('login.alterar', compact('wn_nrecno'));
    }

    public function alterarSenhaPost($id, Request $request)
    {
        // Valida os campos
        $validator = Validator::make($request->all(), [
            'ws_novsen' => 'required|min:3|max:100',
            'ws_consen' => 'required|same:ws_novsen|min:3|max:100',
        ], [
            'ws_novsen.required' => 'O campo :attribute é obrigatório.',
            'ws_novsen.min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'ws_novsen.max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'ws_consen.required' => 'O campo :attribute é obrigatório.',
            'ws_consen.same' => 'O campo :attribute deve ser igual ao campo "nova senha".',
            'ws_consen.min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'ws_consen.max' => 'O campo :attribute não pode ter mais de :max caracteres.',
        ])->setAttributeNames(['ws_novsen' => 'nova senha', 'ws_consen' => 'confirmação da senha'])->validate();

        // Pega dados dos usuário
        $wo_usuari = User::where('nrecno', $id)->first();

        // Nova senha
        $ws_novsen = $request->ws_novsen;
        // Atualiza tabela de usuários
        DB::statement("update gsc_usr set usr_senweb=AES_ENCRYPT('$ws_novsen',MD5('HSIST_INFORMATICA_SUMMER12')),remember_token=null where nrecno=" . $id);
        // Faz o login
        Auth::login($wo_usuari);
        Session::flash('mensagem_sucesso', 'Ok');

        $setores = DB::table('chc_pcc')->whereRaw('coalesce(pcc_inativ,"N")="N"')->get(); // setor
        $convenios = DB::table('clientes')->select('xclientes as codigo', 'razao')->get(); // convênio
        // -----------

        return view('dash.index', compact('setores', 'convenios'));
        //return redirect("/home");
    }

    public function descriptografaSenha($wo_usuari)
    {
        $ws_senweb = $wo_usuari->select(DB::raw("*,CAST(AES_DECRYPT(usr_senweb,MD5('HSIST_INFORMATICA_SUMMER12')) AS CHAR(60)) usr_senweb_des"))->first()->usr_senweb_des;
        return $ws_senweb;
    }

    public function out()
    {
        Auth::logout();
        return view('login.index');
    }
}
