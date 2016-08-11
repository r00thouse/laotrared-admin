@extends('master')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div id="network-map" class="map"></div>
  </div>
  <div class="col-md-4">
    <h3>Información de nodo</h3>
    <div id="info">
    <p><i>Esta es la lista de nodos actuales, presione alguno para ver información más detallada.</i></p>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
function escapeXSS(content) {
  return content.replace(new RegExp('<', 'g'), '&lt;').replace(new RegExp('>', 'g'), '&gt;');
}
$(document).ready(function() {
  var accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
  var tileServer = 'https://api.tiles.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=' + accessToken;
  var position = {
    lat: -16.80454107638344,
    lng: -66.368408203125,
  };
  var routerIcon = L.icon({
      iconUrl: '/assets/img/router.png',
      iconSize:     [45, 78], // size of the icon
      shadowSize:   [45, 78], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
  });

  var mymap = L.map('network-map').setView([position.lat, position.lng], 5);
  L.tileLayer(tileServer, {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18
  }).addTo(mymap);

  $.ajax('/nodos').then(function(res) {
    res.forEach(function(item, index) {
      var marker = L.marker([item.latitude, item.longitude]);
      marker.data = item;
      marker.on('click', function() {
        var infoEl = document.getElementById('info');
        var tpl = '';
        tpl += '<b>Nombre:</b><br/>' + this.data.name;
        tpl += '<br/><b>Descripción:</b> <br/><p>';
        tpl += escapeXSS(this.data.description);
        tpl += '</p><b>Ubicación</b>: <br /><p>';
        tpl += escapeXSS(this.data.physical_description);
        tpl += '</p><b>Segmento de Red</b>:'
        tpl += '<br/>IPv4: ' + (this.data.ipv4_range || 'Sin Asignar');
        tpl += '<br/>IPv6: ' + (this.data.ipv4_range || 'Sin Asignar');

        infoEl.innerHTML = tpl;
      });
      marker.addTo(mymap);
    });
  });
});
</script>
@endsection
