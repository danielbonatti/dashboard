<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <!--Font-awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link rel="icon" href="{{ asset('public/images/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/login.css') }}" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box-login">
            <div class="card-painel">
                <h3>Painel Dashboard</h3>
            </div>
            <div class="login-form">
                <form method="post" action=" {{ route('login.alterar.post',$wn_nrecno) }} ">
                    @csrf
                    <a href="http://hsist.com.br" class="logo-hsist">
                        <img src="{{ asset('public/images/logo.png') }}" alt="Logo Hsist">
                    </a>
                    <h4>Altere sua senha para continuar</h4>
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
                        <input type="password" name="ws_novsen" class="form-control" placeholder="&#xF023; Nova senha" style="font-family: FontAwesome, nunito" autofocus required>
                        <input type="password" name="ws_consen" class="form-control" placeholder="&#xF023; Confirmação da senha" style="font-family: FontAwesome, nunito" required>
                        <button type="submit" class="btn btn-primary btn-block btn-flat">CONTINUAR</button>
                    </div>
                    <!--<div class="login-infos">
                        <a href="#">Esqueceu a senha?</a>
                    </div>-->
                </form>
            </div>
        </div>
    </div>
</body>

</html>
