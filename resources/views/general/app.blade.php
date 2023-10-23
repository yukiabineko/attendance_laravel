<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/general/main.css')}}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
  @yield('css')
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/main.js')}}"></script>
  @yield('js')
</head>

<body>
  @include('header')
  @yield('contents')
  @include('footer')
</body>
</html>