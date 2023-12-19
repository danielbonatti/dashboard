@extends('login.layout')
@section('content')
    <div class="container">
        <div class="box-login">
            <div class="card-painel">
                <h3>Dashboard</h3>
            </div>
            <div class="login-form">
                <form method="post" action=" {{ route('login.user') }} ">
                    @csrf
                    <a href="http://hsist.com.br" class="logo-hsist">
                        <img src="{{ asset('public/images/logo.png') }}" alt="Logo Hsist">
                    </a>
                    <h1>Login</h1>
                    <!-- Validacao -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                    <!-- Fim Validação -->

                    <div class="dados-login">
                        <input type="text" name="usr_usuari" id="usernameId" placeholder="&#xF007; Digite seu usuário."
                            style="font-family: FontAwesome, nunito" autofocus required>
                        <input type="password" name="usr_senweb" id="passwordId" placeholder="&#xF023; Digite sua senha."
                            style="font-family: FontAwesome, nunito" required>

                        <button name="btn_button" id="btn_button" value="btn-button">ACESSAR</button>
                    </div>
                    <!--<div class="login-infos">
                            <a href="#">Esqueceu a senha?</a>
                        </div>-->
                </form>
            </div>
        </div>
    </div>

@endsection
