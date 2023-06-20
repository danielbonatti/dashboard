@extends('dash.layout')
@section('content')

    <div class="container"  class="px-md-4">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <label for="compe">Competência</label>
                            <input class="form-control" id="compe" type="month" value="<?php echo date('Y-m'); ?>">
                        </div>
                        <div class="col-auto my-1">
                            <label for="setor">Setor</label>
                            <select class="form-control" id="setor">
                                @foreach($setores as $setor)
                                    <option value="{{$setor->pcc_codigo}}">{{$setor->pcc_especi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <label for="convenio">Convênio</label>
                            <select class="form-control" id="convenio">
                                @foreach($convenios as $convenio)
                                    <option value="{{$convenio->codigo}}">{{$convenio->razao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <label for="analise">Análise</label>
                            <select class="form-control" id="analise">
                                <option value="66">PRONTO SOCORRO</option>
                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div clas="col-md-4">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <h6 class="my-0">Total de atendimentos</h6>
                                    <small class="text-muted">Atendimentos não cancelados</small>
                                </div>
                                <span class="text-muted">875</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <button id="minha-botao">Clique aqui</button>
                <br>
                <div id="minha-tag">Conteúdo inicial da tag</div>

            </div>
        </div>
    </div>
    

@endsection

