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
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-spinner"></i> Atualizar</button>
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

                <h2>Título da seção</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <tr>
                            <td>
                                <div>
                                    <h6 class="my-0">Total de atendimentos</h6>
                                    <small class="text-muted">Atendimentos não cancelados</small>
                                </div>
                                <span class="text-muted">875</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id="minha-botao">Clique aqui</button>
                                <br>
                                <div id="minha-tag">Conteúdo inicial da tag</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </main>
        </div>
    </div>

@endsection

