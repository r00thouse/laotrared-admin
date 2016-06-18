<!DOCTYPE html>
<html>
<head>
  <title>La Otra Red | Maestro de las Redes</title>
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/leaflet.css" />
  <style type="text/css" media="screen">
    #wrapper {
      margin-left: 16px;
      margin-right: 16px;
    }
  </style>
  @yield('styles')
</head>
<body>

<div id="wrapper">
@if(Auth::check())
  @include('widgets.navbar')
@endif
@yield('content')
</div>
<script src="/assets/js/jquery-2.2.4.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/leaflet.js"></script>
@yield('scripts')
</body>
</html>
