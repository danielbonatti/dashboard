<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    <!-- Styles -->
    <link rel="icon" href="{{ asset('public/images/favicon-16x16.ico') }}" type="image/x-icon">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <!-- jQuery 3.6.0 -->
    <script src="{{ asset('public/plugins/jquery-3.6.0.min.js') }}"></script>

    <style>
      form {
        color:#666;
      };
    </style>

    <title>Dashboard</title>
  </head>
  <body class="pb-2">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <a href="{{route('home')}}" class="my-0 mr-md-auto" title="início"><img src="{{ asset('public/images/logo.png') }}" height="36" alt="HSist"></a>
      <nav class="my-2 my-md-0 mr-md-3">
        <a href="{{route('user.out')}}" class="p-2 text-dark" href="#">Sair</a>
      </nav>
    </div>

    @yield('content')

    <!-- JavaScript -->
    <script>
      
      // Adicione um evento para atualizar a tag quando necessário
      $(document).ready(function() {
          // Exemplo de evento de clique para atualizar a tag
          $('#atualiza').click(function() {
            var dados = {
                array: [1, 2, 3], // Exemplo de array que será enviado para a rota
                outroDado: 'Valor',

                compe: $('#compe').val(),
                setor: $('#setor').val(),
                conve: $('#convenio').val(),
                anali: $('#analise').val()
            };

            // Envie uma solicitação AJAX para atualizar a tag
            $.ajax({
                url: '{{ route('atualizar.tag') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    dados: dados
                },
                success: function(response) {
                    if (response.success) {
                        // Atualize a tag com o novo conteúdo
                        $('#qtd_ate').text(response.retorno);
                    }
                }
            });
          });
      });

    </script>
  </body>
</html>