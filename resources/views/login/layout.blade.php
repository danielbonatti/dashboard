<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <!-- Styles -->
    <link rel="icon" href="{{ asset('public/images/favicon-16x16.ico') }}" type="image/x-icon">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <style>
      form {
        color:#666;
      };
    </style>

    <title>Login Dashboard</title>
  </head>
  <body>

    @yield('content')

  </body>
</html>