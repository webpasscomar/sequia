<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Monitor de Sequía">
  <meta name="author" content="webpass.com.ar">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- .ico -->
  <link rel="shortcut icon" href="{{ asset('favicons/favico.ico') }}" type="image/x-icon">
  <title>{{ config('app.name') }} - @yield('title')</title>

  <!-- CSS - bs - custom -->
  <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <!-- fontawesome iconos -->
  <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-layers-tree/dist/L.Control.Layers.Tree.css" />
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://unpkg.com/leaflet-control-layers-tree/dist/L.Control.Layers.Tree.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

  @include('layouts.partials.header')

  <div class="min-vh-100">
    @yield('content')
  </div>

  @include('layouts.partials.footer')

</body>

</html>
