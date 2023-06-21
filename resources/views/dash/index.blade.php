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
                                    <input class="form-control" id="compe" type="month" value="<?php echo date('Y-m'); ?>">
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

                <div class="border-0 col-2">
                    <div class="row">
                        <div class="col-3 rounded-left border border-dark border-right-0 bg-dark d-flex justify-content-center pt-4">
                            <i class="fa-solid fa-user-doctor fa-2xl" style="color: #fafafa;"></i>
                        </div>
                        <div class="col-9 rounded-right border border-dark border-left-0 bg-white text-center pt-3">
                            <div id="qtd_ate">0</div>
                            <p class="text-muted">Total de Atendimentos</p>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection

