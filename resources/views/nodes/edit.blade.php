@extends('master')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>Información del Nodo</h1>
    <form method="post" accept-charset="utf-8" class="form" id="node-form">
      {{csrf_field()}}
      {{method_field($method)}}
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control" name="name" type="text" placeholder="Nombre del nodo..." autocomplete="off" value="{{$model->name}}" />
      </div>
      <div class="form-group">
        <label>Descripción</label>
        <textarea name="description" class="form-control" rows="4">{{$model->description}}</textarea>
      </div>
      <div clasS="form-group">
        <label>Red</label>
        <select class="form-control">
        @foreach($networks as $network)
          <option value="{{$network->id}}" {{$network->id === $model->network_id ? 'selected' : ''}}>{{$network->name}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Ubicación</label>
        <input type="hidden" name="latitude" />
        <input type="hidden" name="longitude" />
        <div id="mapid"></div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Guardar Cambios
        </button>
        &nbsp;
        <a href="/panel">Volver</a>
      </div>
    </form>
  </div>
</div>
@endsection

@section('styles')
<style type="text/css" media="screen">
  #mapid { height: 400px;}
</style>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  var marker = null;
  var accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
  var tileServer = 'https://api.tiles.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=' + accessToken;
  var position = {
    lat: -16.80454107638344,
    lng: -66.368408203125,
  };
  var zoom = 5;
  if (document.forms[0]['_method'].value === 'put') {
    zoom = 18;
    position.lat = document.forms[0]['latitude'].value;
    position.lng = document.forms[0]['longitude'].value;
  }
  var mymap = L.map('mapid').setView([position.lat, position.lng], zoom);
  L.tileLayer(tileServer, {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18
  }).addTo(mymap);

  if (document.forms[0]['_method'].value === 'put') {
    marker = L.marker([position.lat, position.lng]);
    marker.addTo(mymap);
  }

  mymap.on('click', function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    document.forms[0]['latitude'].value = lat;
    document.forms[0]['longitude'].value = lng;

    if (marker) {
      mymap.removeLayer(marker);
    }

    marker = L.marker([lat, lng])
    marker.addTo(mymap);
  })
});
</script>
@endsection
