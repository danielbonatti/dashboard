<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dash.index');
    }

    public function atualizarTag(Request $request)
    {
        // Obtenha os dados enviados via AJAX
        $dados = $request->input('dados');
        $array = $dados['array']; // Acessando o array enviado via AJAX
        $outroDado = $dados['outroDado']; // Acessando o outro dado enviado via AJAX

        $compe = $dados['compe'];
        $setor = $dados['setor'];
        $conve = $dados['conve'];
        $anali = $dados['anali'];
        
        $cond1 = !empty($setor) ? " and ate_codset=$setor " : "";
        $cond2 = !empty($conve) ? " and ate_conven=$conve " : "";

        /*$consulta = DB::select("
            select 7 qtd
            from chc_ate 
            where concat(year(ate_datini),'-',substring(ate_datini,6,2))=$compet
            and ate_modate=$analis
            and coalesce(ate_cancel,'N')='N'
            $cond1
            $cond2
        ");*/

        $consulta = DB::select("
            select count(*) qtd 
            from chc_ate 
            where concat(year(ate_datini),'-',substring(ate_datini,6,2))='$compe'
            and ate_modate='$anali'
            and coalesce(ate_cancel,'N')='N'
            $cond1
            $cond2
        ");

        $retor = 0;
        if(!is_null($consulta)){
            $retor = $consulta[0]->qtd;
        }

        // Retorna a resposta em JSON
        return response()->json(['success' => true,'retorno' => $retor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
