@extends('Backend.Layouts.app')
@section('page_styles')
<style>
#map {
 height: 400px;
 width: 100%;
 padding-bottom: 2em;
}

.controls {
 margin-top: 10px;
 border: 1px solid transparent;
 border-radius: 2px 0 0 2px;
 box-sizing: border-box;
 -moz-box-sizing: border-box;
 height: 32px;
 outline: none;
 box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
 position: absolute;
 bottom:0;
}

#pac-input {
 background-color: #fff;
 font-family: Roboto;
 font-size: 15px;
 font-weight: 300;
 margin-left: 12px;
 padding: 0 11px 0 13px;
 text-overflow: ellipsis;
 width: 300px;
}

#pac-input:focus {
 border-color: #4d90fe;
}

.pac-container {
 font-family: Roboto;
}

@media only screen and (max-width:1024px) {

 #map {
  height: 100vh;
  width: 100%;
 }
}

@media only screen and (max-width:768px) {
 #map {
  height: 300px;
  width: 100%;
 }
 #pac-input {
  width: calc(50%);

 }
  .controls{
   display:block;
  }
}
</style>
@endsection
@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Store.Edit.header')
 <div class="content">
  <div class="row">
   @include('Backend.Store.Edit.form')
  </div>
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
@section('page_scripts')
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
 </script>
 <script src="https://terrylinooo.github.io/jquery.disableAutoFill/assets/js/jquery.disableAutoFill.min.js"></script>
<script type="text/javascript">
function handleLocationError(browserHasGeolocation, infoWindow, pos, map) {
 infoWindow.setPosition(pos);
 infoWindow.setContent(browserHasGeolocation ?
  'Error: The Geolocation service failed.' :
  'Error: Your browser doesn\'t support geolocation.');
 map.setZoom(14);
}
// Cambiar segundos a texto de tiempo
function sec2time(timeInSeconds) {
 var pad = function(num, size) {
   return ('000' + num).slice(size * -1);
  },
  time = parseFloat(timeInSeconds).toFixed(3),
  hours = Math.floor(time / 60 / 60),
  minutes = Math.floor(time / 60) % 60,
  seconds = Math.floor(time - minutes * 60),
  milliseconds = time.slice(-3);

 if (pad(hours) > 0) {
  return pad(hours, 2) + ' h ' + pad(minutes, 2) + ' min';
 }
 else{
  return pad(minutes, 2) + ' min';
 }
}

function initMap() {
 //Variables
 var pos = {
  lat: {{$store->lat}},
  lng: {{$store->lng}}
 };
 var map = new google.maps.Map(document.getElementById('map'), {
  center: pos,
  zoom: 17
 });
 var infoWindow = new google.maps.InfoWindow({
  map: map
 });
// var trafficLayer = new google.maps.TrafficLayer();
 //trafficLayer.setMap(map);
 var marker = new google.maps.Marker({
  map: map,
  position: pos,
  draggable: true
 });
 var geocoder = new google.maps.Geocoder();
 var input = /** @type {!HTMLInputElement} */ (
  document.getElementById('pac-input'));
 map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
 var autocomplete = new google.maps.places.Autocomplete(input);
 autocomplete.bindTo('bounds', map);
 var bounds = new google.maps.LatLngBounds();
 var service = new google.maps.DistanceMatrixService;
 //\Variables



 // Para cambiar coordenadas por direcciones
 geocoder.geocode({
  'latLng': pos
 }, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
   if (results[0]) {
    $('#address').val(results[0].formatted_address);
    $('#latitude').val(marker.getPosition().lat());
    $('#longitude').val(marker.getPosition().lng());
    infoWindow.setContent('Arrasta el marcador para darnos tu ubicación exacta');
    infoWindow.open(map, marker);
   }
  }
 });
 //\ Para cambiar coordenadas por direcciones

 //Listener para la barra de busqueda con texto(places)
 autocomplete.addListener('place_changed', function() {
  marker.setVisible(false);
  var place = autocomplete.getPlace();
  if (!place.geometry) {
   // User entered the name of a Place that was not suggested and
   // pressed the Enter key, or the Place Details request failed.
   window.alert("No details available for input: '" + place.name + "'");
   return;
  }
  // If the place has a geometry, then present it on a map.
  if (place.geometry.viewport) {
   map.fitBounds(place.geometry.viewport);
  } else {
   map.setCenter(place.geometry.location);
   map.setZoom(17); // Why 17? Because it looks good.
  }

  marker.setPosition(place.geometry.location);
  marker.setVisible(true);
  var address = '';
  if (place.address_components) {
   address = [
    (place.address_components[0] && place.address_components[0].short_name || ''),
    (place.address_components[1] && place.address_components[1].short_name || ''),
    (place.address_components[2] && place.address_components[2].short_name || '')
   ].join(' ');
  }
  infoWindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
  infoWindow.open(map, marker);
  $('#address').val(address);
  $('#latitude').val(marker.getPosition().lat());
  $('#longitude').val(marker.getPosition().lng());
 });
 //\Listener para la barra de busqueda con texto(places)

 //Listener para cuando arrastran un marcador
 google.maps.event.addListener(marker, 'dragend', function() {
  geocoder.geocode({
   'latLng': marker.getPosition()
  }, function(results, status) {
   if (status == google.maps.GeocoderStatus.OK) {
    if (results[0]) {
     infoWindow.close();
     $('#address').val(results[0].formatted_address);
     $('#latitude').val(marker.getPosition().lat());
     $('#longitude').val(marker.getPosition().lng());
     var markerPos = {
      lat: marker.getPosition().lat(),
      lng: marker.getPosition().lng()
     };
     map.setCenter(markerPos);
     map.setZoom(17);
    }
   }
  });
 });
 //\Listener para cuando arrastran un marcador

 //Listener para cuando damos click en el mapa
 google.maps.event.addListener(map, 'click', function(event) {
  marker.setPosition(event.latLng);
  geocoder.geocode({
   'latLng': marker.getPosition()
  }, function(results, status) {
   if (status == google.maps.GeocoderStatus.OK) {
    if (results[0]) {
     infoWindow.close();
     $('#address').val(results[0].formatted_address);
     $('#latitude').val(marker.getPosition().lat());
     $('#longitude').val(marker.getPosition().lng());
     var markerPos = {
      lat: marker.getPosition().lat(),
      lng: marker.getPosition().lng()
     };
     //infoWindow.setContent(results[0].formatted_address);
     //infoWindow.open(map, marker);
     map.setCenter(markerPos);
     map.setZoom(17);

    }
   }
  });
 });
 // \Listener para cuando damos click en el mapa
}

$(document).ready(function() {
 $(window).keydown(function(event) {
  if (event.keyCode == 13) {
   event.preventDefault();
   return false;
  }
 });
 $('#pac-input').disableAutoFill();
});

</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeUYbUAo57Oi4JRj-ipXKkQxN8hN6K59g&libraries=places,geometry&callback=initMap" async defer></script>

@endsection
