@extends('dash.layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light border-right sidebar">
                <div class="sidebar-sticky">
                    <form>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <div class="form-group">
                                    <label for="compe">Competência</label>
                                    <input class="form-control" id="compe" type="month" value="<?php echo '2021-08';//echo date('Y-m'); ?>">
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-group">
                                    <label for="setor">Setor</label>
                                    <select class="form-control" id="setor">
                                        <option value="" data-default disabled selected></option>
                                        @foreach($setores as $setor)
                                            <option value="{{$setor->pcc_codigo}}">{{$setor->pcc_especi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-group">
                                    <label for="convenio">Convênio</label>
                                    <select class="form-control" id="convenio">
                                        <option value="" data-default disabled selected></option>
                                        @foreach($convenios as $convenio)
                                            <option value="{{$convenio->codigo}}">{{$convenio->razao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-group">
                                    <label for="analise">Análise</label>
                                    <select class="form-control" id="analise">
                                        <option value="66">PRONTO SOCORRO</option>
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-group">
                                    <a class="btn btn-primary" id="atualiza" href="#" role="button"><i class="fa-solid fa-rotate"></i> Atualizar</a>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="border-0 col-12">
                                <div class="row">
                                    <div class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-2">
                                        <i class="fa-solid fa-user-doctor fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center">
                                        <div id="qtd_ate">0</div>
                                        <div class="text-muted">Total de Atendimentos</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-3">
                                <div class="row">
                                    <div class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-2">
                                    <i class="fa-solid fa-stethoscope fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center">
                                        <div id="med_ate">0</div>
                                        <div class="text-muted">Média Diária de Atend.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-3">
                                <div class="row">
                                    <div class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-2">
                                    <i class="fa-solid fa-bed-pulse fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center">
                                        <div id="int_ate">0</div>
                                        <div class="text-muted">Intern. Após Consulta</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-3">
                                <div class="row">
                                    <div class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-2">
                                    <i class="fa-solid fa-right-left fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center">
                                        <div id="tax_con">0</div>
                                        <div class="text-muted">Taxa de Conversão</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-2">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h5>Atend. por Setor</h5>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="border-0 col-12 mb-2 text-center">
                                    <h5>Atend. por Setor</h5>
                                    <div id="chart-container">
                                        <canvas id="myChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="border-0 col-4 text-center">
                                    <h5>Top 5 Convênios</h5>
                                    <canvas id="myChart2"></canvas>
                                </div>
                                <div class="border-0 col-4">
                                    gráfico 3
                                </div>
                                <div class="border-0 col-4">
                                    gráfico 4
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection

