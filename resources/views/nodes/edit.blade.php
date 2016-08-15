@extends('master')

@section('content')
<?php
  if(Session::has('model')) {
    $model = Session::get('model');
  }
?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>Información del Nodo</h1>
    <form method="post" accept-charset="utf-8" class="form" id="node-form">
      {{csrf_field()}}
      {{method_field($method)}}
      <div class="form-group" >
        <label data-validator="required">Nombre del Nodo</label>
        <input class="form-control" name="name" type="text" placeholder="Nodo Patito" autocomplete="off" value="{{$model->name}}" />
      </div>
      <div class="form-group">
        <label data-validator="required">Descripción</label>
        <textarea name="description" class="form-control" rows="4">{{$model->description}}</textarea>
      </div>
      <div class="form-group">
        <label>Zona/Barrio</label>
        <input type="text" name="physical_description" class="form-control" placeholder="Ej. Zona Bolivar en la avenida principal" autocomplete="off" value="{{$model->physical_description}}" />
      </div>
      <div class="form-group">
        <label data-validator="required">Red Libre</label>
        <select class="form-control" name="network_id">
        @foreach($networks as $network)
          <option value="{{$network->id}}" {{$network->id == $model->network_id ? 'selected' : ''}}>{{$network->name}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Ubicación</label>
        <input type="hidden" name="latitude" value="{{$model->latitude}}" />
        <input type="hidden" name="longitude" value="{{$model->longitude}}" />
        <div id="mapid" class="map"></div>
      </div>
      <div class="form-group">
        <label><input type="checkbox" name="privacy_mode" value="true" {{ $model->privacy_mode ? 'checked' : '' }} /> Modo Privacidad Extendida</label>
        <span><i>Se guardará la ubicación original exacta, pero en los mapas públicos y generales aparecerá desviada de forma aleatoria en un radio de 50 metros. Ideal para nodos privados.</i></span>
      </div>
      <div class="form-group">
        <button type="submit" onclick="javascript:console.log('fff')" class="btn btn-success">
          Guardar Cambios
        </button>
        &nbsp;
        <a href="/panel">Volver</a>
      </div>
    </form>
  </div>
</div>
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
