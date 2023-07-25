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
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      form {
        color:#666;
      }

      #chart-container {
        max-height: 400px; 
        width: 100%;
      }
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

          // Função para criar o gráfico inicialmente
          criarGrafico();

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
                      $('#qtd_ate').text(response.totate);
                      $('#med_ate').text(response.medate);
                      $('#int_ate').text(response.inapco);
                      $('#tax_con').text(response.taxcon);
                  }
              }
            });

            // =============================================

            $.ajax({
              url: '{{ route('atualizar.gra') }}',
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}',
                  dados: dados
              },
              success: function(response) {
                if (response.success) {
                  atualizarGrafico(response.labels,response.data);
                  atualizarGraficoBar('myChart1',response.comp1,response.quan1,response.quan2);
                  atualizarGraficoBar('myChart2',response.conv1,response.qtdc1,response.qtdc2);
                  atualizarGraficoBar('myChart3',response.medi1,response.qtdm1,response.qtdm2);
                  atualizarGraficoBar('myChart4',response.diag1,response.qtdd1,response.qtdd2);
                }
              }
            });
          });

          // Ao carregar a página
          $('#atualiza').click();
      });

      function criarGrafico() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: [],
            datasets: [{
              data: []
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: true,
                position: 'bottom'
              },
              tooltip: {
                enabled: true
              }
            }
          }
        });
        // ======================

        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx1, {
          type: 'bar',
          data: {
            labels: [],
            datasets: [{
              label: 'pacote',
              data: [],
              backgroundColor: 'rgba(255, 99, 132)'
            },{
              label: 'aberto',
              data: [],
              backgroundColor: 'rgba(255, 162, 235)'
            }]
          },
          options: {
            responsive: true
          }
        });
        // ======================

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx2, {
          type: 'bar',
          data: {
            labels: [],
            datasets: [{
              label: 'pacote',
              data: [],
              backgroundColor: 'rgba(0,128,0)'
            },{
              label: 'aberto',
              data: [],
              backgroundColor: 'rgba(0,255,0)'
            }]
          },
          options: {
            responsive: true,
            indexAxis: 'y'
          }
        });

        // ======================

        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var myChart = new Chart(ctx3, {
          type: 'bar',
          data: {
            labels: [],
            datasets: [{
              label: 'pacote',
              data: [],
              backgroundColor: 'rgba(75, 192, 192)'
            },{
              label: 'aberto',
              data: [],
              backgroundColor: 'rgba(54, 162, 235)'
            }]
          },
          options: {
            responsive: true,
            indexAxis: 'y'
          }
        });

        // ======================

        var ctx4 = document.getElementById('myChart4').getContext('2d');
        var myChart = new Chart(ctx4, {
          type: 'bar',
          data: {
            labels: [],
            datasets: [{
              label: 'pacote',
              data: [],
              backgroundColor: 'rgba(0, 0, 255)'
            },{
              label: 'aberto',
              data: [],
              backgroundColor: 'rgba(0,191,255)'
            }]
          },
          options: {
            responsive: true,
            indexAxis: 'y'
          }
        });
      }

      function atualizarGrafico(newLabel,newDados) {
        // Obtenha a referência do gráfico
        var chart = Chart.getChart('myChart');
        // Atualize os dados do gráfico
        chart.data.datasets[0].data = newDados;
        chart.data.labels = newLabel;
        // Gere novas cores aleatórias
        chart.data.datasets[0].backgroundColor = gerarCoresAleatorias(newDados.length);
        // Atualize o gráfico
        chart.update();
      }

      // Atualiza graf. barras
      function atualizarGraficoBar(idCanvas,newsCom,newsQu1,newsQu2) {
        var chart = Chart.getChart(idCanvas);
        chart.data.datasets[0].data = newsQu1;
        chart.data.datasets[1].data = newsQu2;
        chart.data.labels = newsCom;
        chart.update();
      }

      function gerarCoresAleatorias(quantidade) {
        var cores = [];
        for (var i = 0; i < quantidade; i++) {
          var cor = '#' + Math.floor(Math.random() * 16777215).toString(16);
          cores.push(cor);
        }
        return cores;
      }

      document.addEventListener("DOMContentLoaded", function() {
        var chartContainer = document.getElementById('chart-container');

        // Redimensionar o gráfico sempre que o tamanho do contêiner mudar
        function resizeChart() {
          var containerWidth = chartContainer.offsetWidth;
          var containerHeight = chartContainer.offsetHeight;
          
          chart.canvas.parentNode.style.height = containerHeight + 'px';
          chart.canvas.parentNode.style.width = containerWidth + 'px';
          chart.resize();
        }

        // Redimensionar o gráfico inicialmente e sempre que a janela for redimensionada
        resizeChart();
        window.addEventListener('resize', resizeChart);
      });

    </script>
  </body>
</html>