@extends('dash.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav class="col-12 col-sm-12 col-md-3 col-lg-2 bg-light border-right sidebar"> <!-- d-none d-md-block -->
                <div class="sidebar-sticky">
                    <form>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <label for="">Período</label>
                                <div class="form-group">
                                    <label for="data_inicial" class="periodoData">Data inicial</label>
                                    <input class="form-control compe" id="data_inicial" type="date"
                                        value="<?php echo date('Y-m-d', strtotime('-6 months')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="data_final" class="periodoData">Data final</label>
                                    <input class="form-control compe" id="data_final" type="date"
                                        value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-group">
                                    <label for="setor">Setor</label>
                                    <select class="form-control" id="setor">
                                        <option value="" data-default selected></option>
                                        @foreach ($setores as $setor)
                                            <option value="{{ $setor->pcc_codigo }}">{{ $setor->pcc_especi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="form-group">
                                    <label for="convenio">Convênio</label>
                                    <select class="form-control" id="convenio">
                                        <option value="" data-default selected></option>
                                        @foreach ($convenios as $convenio)
                                            <option value="{{ $convenio->codigo }}">{{ $convenio->razao }}</option>
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
                                    <a class="btn btn-primary" id="atualiza" href="#" role="button"><i
                                            class="fa-solid fa-rotate"></i> Atualizar</a>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </nav>

            <main role="main" class="col-12 col-sm-12 col-md-9 col-lg-10 ml-sm-auto px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="border-0 col-12">
                                <div class="row">
                                    <div
                                        class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-3">
                                        <i class="fa-solid fa-user-doctor fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center pt-2 pb-2"
                                        style="line-height: 0.7;">
                                        <h5 id="qtd_ate">0</h5>
                                        <div class="text-muted">Total de Atendimentos</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-3">
                                <div class="row">
                                    <div
                                        class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-3">
                                        <i class="fa-solid fa-stethoscope fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center pt-2 pb-2"
                                        style="line-height: 0.7;">
                                        <h5 id="med_ate">0</h5>
                                        <div class="text-muted">Média Diária de Atend.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-3">
                                <div class="row">
                                    <div
                                        class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-3">
                                        <i class="fa-solid fa-bed-pulse fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center pt-2 pb-2"
                                        style="line-height: 0.7;">
                                        <h5 id="int_ate">0</h5>
                                        <div class="text-muted">Intern. Após Consulta</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-3">
                                <div class="row">
                                    <div
                                        class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-3">
                                        <i class="fa-solid fa-right-left fa-2xl" style="color: #fafafa;"></i>
                                    </div>
                                    <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center pt-2 pb-2"
                                        style="line-height: 0.7;">
                                        <h5 id="tax_con">0</h5>
                                        <div class="text-muted">Taxa de Conversão</div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-0 col-12 mt-2">
                                <div class="row">
                                    <div class="border-top border-bottom pt-2 mt-2 pb-2 mb-2 col-12 text-center">
                                        <h5>Atend. por Setor</h5>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="border-0 col-12 col-sm-12 col-md-12 col-lg-12 mb-2 text-center">
                                    <h5>Atendimentos por Mês</h5>
                                    <div class="d-flex justify-content-center" id="chart-container">
                                        <canvas id="myChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="border-top pt-2 pb-2 col-12 col-sm-12 col-md-12 col-lg-4 text-center">
                                    <h5>Tempo médio de espera por classificação</h5>
                                    <canvas id="myChart2"></canvas>
                                </div>
                                <div class="border-top pt-2 pb-2 col-12 col-sm-12 col-md-12 col-lg-4 text-center">
                                    <h5>Top 5 Médicos</h5>
                                    <canvas id="myChart3"></canvas>
                                </div>
                                <div class="border-top pt-2 pb-2 col-12 col-sm-12 col-md-12 col-lg-4 text-center">
                                    <h5>Top 5 Diagnósticos</h5>
                                    <canvas id="myChart4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
