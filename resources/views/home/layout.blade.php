<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    <!-- Styles -->
    <link rel="icon" href="{{ asset('public/images/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/home.css') }}" rel="stylesheet">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- jQuery 3.6.0 -->
    <script src="{{ asset('public/plugins/jquery-3.6.0.min.js') }}"></script>

    <!-- Chart.js -->
    <script src="{{ asset('public/js/chart.js') }}"></script>

    <title>Home</title>
</head>

<body>
    <div class="navbar">
        <div class="container">
            <div class="row navbar-home">
                <div class="col-md-3 logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('public/images/logo.png') }}" alt="Logo Hsist" width="244" height="80">
                    </a>
                </div>
                <div class="col-md-7 nav-itens">
                    <ul>
                        <li class="nav-li">
                            <a href="{{ route('home') }}"
                                class="{{ Request::routeIs('home') ? 'active' : '' }}">Home</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 logout">
                    <a href="{{ route('user.out') }}" class="">Desconectar</a>
                </div>

                <div class="chama-menu" id="menu-button">
                    <div class="menu-chamado"></div>
                </div>
            </div>
            <div class="menu-responsivo" id="menu-responsivo">
                <a href=""><img src="{{ asset('public/images/logo.png') }}" width="280" class="img-fluid"
                        alt="Hsist"></a>

                <div class="menu-header-container">
                    <ul id="menu-header" class="menu">
                        <li><a href="">Home</a></li>

                        <li class="personalizacao">Análises
                            <ul class="sub-menu">
                                <li><a href="{{ route('dash') }}">Pronto Socorro</a></li>
                                <li><a href="#">Internação</a></li>
                                <li><a href="#">Ambulatório</a></li>
                                <li><a href="#">SADT</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('user.out') }}">Desconectar</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @yield('content')    
    <footer class="bg-light text-center text-lg-start">
        <!-- Conteúdo do rodapé -->
        <div class="text-center p-3" style="background-color: #fff">
          <a href="http://www.hsist.com.br" target="_blank">
            <img src="{{ asset('public/images/logo.png') }}" width="180" class="img-fluid" alt="Hsist">
          </a>
        </div>
      </footer>

    <script>
        $(document).ready(function() {

            /* Menu Mobile */
            var menuResponsivoAberto = false;

            //Quando clicar no menu, ele irá abrir, e quando clicar novamente, ele irá fechar.
            $('.chama-menu').click(function() {
                if (menuResponsivoAberto) {
                    $('#menu-responsivo').css('left', '-70%');
                } else {
                    $('#menu-responsivo').css('left', '0');
                }
                menuResponsivoAberto = !menuResponsivoAberto;
            });

            //Ao clicar, irá dar para ele a classe active.
            $('#menu-button').click(function() {
                $(this).toggleClass('active');
            });

            //Esconder todos os submenus ao carregar a página
            $(".menu-header-container ul ul").hide();

            //Quando clicar no submenu, irá aparecer o conteúdo dele.            
            $("li:contains('Análises')").on("click", function() {
                var submenu = $(this).children("ul");

                //Setando a classe open ao submenu
                submenu.slideToggle(500);
                if (submenu) {
                    $(this).toggleClass("open");
                }
            });
            /* Fim Menu Mobile */

            /* Horario Atual */

            function preenche_data() {
                //Usando a biblioteca moment
                moment.locale('pt-br');

                //Data atual
                var dataAtual = moment();

                //Formatando a data
                var dataFormatada = dataAtual.format('dddd, MMM. DD');

                //Deixando a primeira letra maiuscula
                function primeiraMaiuscula(string) {
                    return string.replace(/\b\w/g, function(l) {
                        return l.toUpperCase()
                    })
                }
                dataFormatada = primeiraMaiuscula(dataFormatada);

                $('#data_hora').html(dataFormatada);
            }

            preenche_data();

            /* Fim Funcao Horario */

            //======================================================

            /* API de tempo - WeatherAPI */
            var apiKey = 'cb05f8f4ee914989be4122017232911';

            // URL da API WeatherAPI
            var apiUrl = 'https://api.weatherapi.com/v1/current.json?key=' + apiKey + '&q=auto:ip&lang=pt';

            // Requisição AJAX
            $.ajax({
                url: apiUrl,
                method: 'GET',
                success: function(data) {
                    //Puxar todos os dados para teste
                    console.log(data);

                    //Puxando os dados do tempo
                    var cidade = data.location.name.toUpperCase();
                    var temperatura = data.current.temp_c;
                    var imagemTempo = data.current.condition.icon;
                    var descricaoTempo = data.current.condition.text;
                    var maxTemperatura = data.current.temp_c + 5;
                    var minTemperatura = data.current.temp_c - 5;

                    //Adicionando o conteúdo ao site.
                    $('#conteudo-clima').html(
                        '<img src="' + imagemTempo + '" alt="' + descricaoTempo +
                        '" width="100px" height="100px">' +
                        '<h2>' + cidade + '</h2>' +
                        '<h3>' + temperatura + '°</h3>' +
                        '<p>' + descricaoTempo + '</p>' +
                        '<p>Máx.: ' + maxTemperatura + 'º   Mín.: ' + minTemperatura + 'º</p>'
                    );
                },
                error: function(error) {
                    console.error('Erro na requisição:', error);
                }
            });
            //Fim API TEMPO
            //======================================================

        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>

</body>

</html>
