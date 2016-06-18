@extends('master')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div id="network-map"></div>
  </div>
</div>
@endsection

@section('styles')
<style type="text/css" media="screen">
  #network-map {
    height: 400px;
  }
</style>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  var accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
  var tileServer = 'https://api.tiles.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=' + accessToken;
  var position = {
    lat: -16.80454107638344,
    lng: -66.368408203125,
  };

  var mymap = L.map('network-map').setView([position.lat, position.lng], 5);
  L.tileLayer(tileServer, {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18
  }).addTo(mymap);

  $.ajax('/nodos').then(function(res) {
    res.forEach(function(item, index) {
      var marker = L.marker([item.latitude, item.longitude]);
      marker.addTo(mymap);
    });
  });
});
</script>
@endsection
