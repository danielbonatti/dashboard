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

        $erros = array();

        $retor = 0;  // Total de Atendimentos
        $medate = 0; // Média Diária de Atendimentos
        try {
            $consulta = DB::select("
                select count(*) qtd 
                from chc_ate 
                where concat(year(ate_datini),'-',substring(ate_datini,6,2))='$compe'
                and ate_modate='$anali'
                and coalesce(ate_cancel,'N')='N'
                $cond1
                $cond2
            ");

            if(!empty($consulta) && isset($consulta[0]->qtd)){
                $retor = $consulta[0]->qtd;                                                               // Total de atendimentos
                $medate = $retor / cal_days_in_month(CAL_GREGORIAN,substr($compe,-2),substr($compe,0,4)); // Média Diária de Atendimentos
                $medate = number_format($medate, 2, '.', '');
            }
        } catch (\Throwable $th) {
            $erros[] = $th->getMessage();
        }

        $qtdiac = 0; // Internações após consulta
        $taxcon = 0; // Taxa de conversão
        try {
            $intcon = DB::select("
                select count(*) qtd 
                from chc_ate 
                inner join gsc_sol_infgui on (sol_numate=ate_numate and sol_datcan is null)
                where concat(year(ate_datini),'-',substring(ate_datini,6,2))='$compe'
                and ate_modate='$anali'
                and coalesce(ate_cancel,'N')='N'
                $cond1
                $cond2
            ");

            if(!empty($intcon) && isset($intcon[0]->qtd)){
                $qtdiac = $intcon[0]->qtd;  // Intern. Após Consulta
                $taxcon = $qtdiac / $retor; // Taxa de conversão
            }
        } catch (\Throwable $th) {
            $erros[] = $th->getMessage();
        }

        // Retorna a resposta em JSON
        return response()->json(['success' => true,'totate' => $retor,'medate' => $medate,'inapco' => $qtdiac,'taxcon' => $taxcon]);
    }

    public function atualizarGra(Request $request)
    {
        $dados = $request->input('dados');

        $compe = $dados['compe'];
        $setor = $dados['setor'];
        $conve = $dados['conve'];
        $anali = $dados['anali'];
        
        $cond1 = !empty($setor) ? " AND ate_codset=$setor " : "";
        $cond2 = !empty($conve) ? " AND ate_conven=$conve " : "";

        $erros = array();
        
        $descr = array();
        $quant = array();
        // Gráfico => atend. por setor
        try {
            $cons1 = DB::select("
                select pcc_espsim descr, quant from (
                    select ate_codset,count(*) quant
                    from chc_ate
                    where concat(year(ate_datini),'-',substring(ate_datini,6,2))='$compe'
                    and ate_modate='$anali'
                    and coalesce(ate_cancel,'N')='N'
                    $cond1
                    $cond2
                    group by ate_codset) x
                inner join chc_pcc on pcc_codigo=ate_codset
            ");

            foreach ($cons1 as $row) {
                $descr[] = $row->descr;
                $quant[] = $row->quant;
            }
        } catch (\Throwable $th) {
            $erros[] = $th->getMessage();
        }

        // ==============================

        // Histórico dos últimos 5 meses
        // Criar um objeto DateTime com o valor inicial
        $date = new \DateTime($compe);
        // Subtrair 6 meses
        $date->sub(new \DateInterval('P6M'));
        // Obter o resultado formatado
        $coini = $date->format('Y-m');

        $comp1 = array();
        $quan1 = array();
        $quan2 = array();

        try {
            $cons2 = DB::select("
                select compe,sum(quan1) quan1,sum(quan2) quan2 from (
                    select compe,sum(quan1) quan1,sum(quan2) quan2 from (
                        select ate_conven,concat(year(ate_datini),'-',substring(ate_datini,6,2)) compe,count(*) quan1,0 quan2
                        from chc_ate
                        where concat(year(ate_datini),'-',substring(ate_datini,6,2))>'$coini'
                        and concat(year(ate_datini),'-',substring(ate_datini,6,2))<'$compe'
                        and ate_modate='$anali'
                        and coalesce(ate_cancel,'N')='N'
                        $cond1
                        $cond2
                        group by ate_conven,concat(year(ate_datini),'-',substring(ate_datini,6,2))) x1
                    inner join chc_con on con_codigo=ate_conven
                    where if(con_grufat=(select par_grfapd from gsc_par where codigo_emp=1),1,0)=0
                    group by compe

                    union all

                    select compe,sum(quan1) quan1,sum(quan2) quan2 from (
                        select ate_conven,concat(year(ate_datini),'-',substring(ate_datini,6,2)) compe,0 quan1,count(*) quan2
                        from chc_ate
                        where concat(year(ate_datini),'-',substring(ate_datini,6,2))>'$coini'
                        and concat(year(ate_datini),'-',substring(ate_datini,6,2))<'$compe'
                        and ate_modate='$anali'
                        and coalesce(ate_cancel,'N')='N'
                        $cond1
                        $cond2
                        group by ate_conven,concat(year(ate_datini),'-',substring(ate_datini,6,2))) x2
                    inner join chc_con on con_codigo=ate_conven
                    where if(con_grufat=(select par_grfapd from gsc_par where codigo_emp=1),1,0)=1
                    group by compe
                ) y
                group by compe
                order by compe
            ");

            foreach ($cons2 as $row) {
                $comp1[] = $row->compe;
                $quan1[] = $row->quan1;
                $quan2[] = $row->quan2;
            }
        } catch (\Throwable $th) {
            $erros[] = $th->getMessage();
        }

        // ==============================

        // Retorna a resposta em JSON
        return response()->json(['success' => true,'labels' => $descr,'data' => $quant,'comp1' => $comp1,'quan1' => $quan1,'quan2' => $quan2]);
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
