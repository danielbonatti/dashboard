@extends('login.layout')
@section('content')

<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
            
                        <form class="form-signin" method="post" action=" {{route('auth.user')}} ">
                            <!--importar csrf, proteção do laravel, para requisição do formulário-->
                            @csrf 
                            <img class="img-responsive mb-4" src="{{ asset('public/images/logo.png') }}" height="70" alt="Hsist">
                            <h5 class="mb-3 font-weight-normal">Bem-vindo de volta</h5>

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

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Usuário" aria-describedby="basic-addon1" name="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Senha" aria-label="Usuário" aria-describedby="basic-addon1" name="password">
                                </div>
                            </div>
                        
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                            <p class="mt-5 mb-3 text-muted" style="font-size:10px;">HSIST INFORMÁTICA HOSPITALAR<br>TODOS OS DIREITOS RESERVADOS</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

