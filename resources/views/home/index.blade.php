@extends('home.layout')
@section('content')
    <div class="container conteudo">
        <div class="row">
            <div class="col-md-8 cards">
                <div class="itens-box-card">
                    <div class="row content-box-card">
                        <div class="col-md-8">
                            <h1>Bem vindo!</h1>
                            <p>Você está no painel de indicadores de desempenho.</p>
                        </div>
                        <div class="col-md-4 img-hospital">
                            <img src="{{ asset('public/images/hospital.png') }}" alt="Imagem hospital">
                        </div>
                        <div class="col-md-12 calendario" >
                            <p id="data_hora">Quarta-feira. Nov. 22</p>
                            <img src="{{ asset('public/images/calendario.png') }}" alt="Imagem calendario">
                        </div>
                    </div>
                </div>

                <div class="itens-box-card analises">
                    <div class="row content-box-card">
                        <h1>ANÁLISES</h1>
                        <a href="{{ route('dash') }}">Pronto Socorro</a>
                        <a href="#" class="disabled">Internação</a>
                        <a href="#" class="disabled">Ambulatório</a>
                        <a href="#" class="disabled">SADT</a>
                    </div>
                </div>
            </div>
            
            <!--
            <div class="col-md-4 cards">
                <div class="itens-box-card clima" style="display: none;">
                    <div class="row content-box-card">
                        <div class="conteudo-clima" id="conteudo-clima">
                        </div>
                    </div>
                </div>
            </div>
        -->
        </div>
    </div>

    
@endsection
