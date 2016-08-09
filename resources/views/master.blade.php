<!DOCTYPE html>
<html>
<head>
  <title>La Otra Red | Maestro de las Redes</title>
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/leaflet.css" />
  <link rel="stylesheet" href="/assets/css/notie.css" />
  <style type="text/css" media="screen">
    #wrapper {
      margin-left: 16px;
      margin-right: 16px;
    }
  </style>
  @yield('styles')
</head>
<body>
<input id="global_crsf_token" type="hidden" value="{{csrf_token()}}" />
<div id="wrapper">
@include('widgets.navbar')
@yield('content')
</div>
@if(Session::has('message'))
<span class="hidden" id="message" data-type="success">{{Session::get('message')}}</span>
@endif
@if(Session::has('error'))
<span class="hidden" id="message" data-type="error">{{Session::get('error')}}</span>
@endif
<script src="/assets/js/jquery-2.2.4.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/leaflet.js"></script>
<script src="/assets/js/notie.min.js"></script>
<script src="/assets/js/notifications.js"></script>
@yield('scripts')
</body>
</html>
