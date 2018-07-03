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

//Distance Matrix
function get_distance(service, origins, marker, map, storeArray) {

 var markerPos = {
  lat: marker.getPosition().lat(),
  lng: marker.getPosition().lng()
 };
 var arreglo = storeArray;
 service.getDistanceMatrix({
  origins: origins,
  destinations: [markerPos],
  travelMode: 'BICYCLING',
  unitSystem: google.maps.UnitSystem.METRIC,
  avoidHighways: false,
  avoidTolls: false
 }, function(response, status) {
  if (status !== 'OK') {
   alert('Error was: ' + status);
  } else {
   var originList = response.originAddresses;
   var destinationList = response.destinationAddresses;
   var outputDiv = document.getElementById('output');
   var nearest_store_name = arreglo[0].display_name;
   var nearest_store_id = arreglo[0].id;
   var nearest_store = response.rows[0].elements[0].distance.value;
   var nearest_store_index = 0;
   var nearest_store_time = response.rows[0].elements[0].duration.value;
   var nearest_store_pos = origins[0];
   // acomodarlas de menor a mayor
   for (var i = 1; i < originList.length; i++) {
    if (response.rows[i].elements[0].distance.value < nearest_store) {
     nearest_store = response.rows[i].elements[0].distance.value;
     nearest_store_time = response.rows[i].elements[0].duration.value;
     nearest_store_index = i;
     nearest_store_name = arreglo[i].display_name;
     nearest_store_id = arreglo[i].id;
     nearest_store_pos = origins[i];
    }
   }
   var total_time_arrival = nearest_store_time + 900;
   var time_arrival = sec2time(total_time_arrival);
   var store_bounds = new google.maps.LatLngBounds();
   store_bounds.extend(markerPos);
   store_bounds.extend(nearest_store_pos);
   outputDiv.innerHTML = ' Tu pedido será atendido en ' + nearest_store_name + '</br> y tardará aproximadamente ' + time_arrival + ' en llegar.';
   $('#store_id').val(nearest_store_id);
   map.fitBounds(store_bounds);
   var infoWindow = new google.maps.InfoWindow({
    map: map
   });
  }
 });
}
//Distance Matrix

function initMap() {
 //Variables
 var pos = {
  lat: 19.542036100000015,
  lng: -96.90808484409183
 };
 var map = new google.maps.Map(document.getElementById('map'), {
  center: pos,
  zoom: 12
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
 var markerArray = [];
 var storeArray = [];
 //\Variables

 //Generar los marcadores de las suscursales
 var markers_url = document.getElementById('get_stores').dataset.url;
 $.get(markers_url, function(result) {
  var stores = result.stores;
  stores.forEach(function(element) {
   var elementPos = {
    lat: element.lat,
    lng: element.long
   };
   markerArray.push(elementPos);
   storeArray.push(element);
   bounds.extend(elementPos);
   var marker = new google.maps.Marker({
    map: map,
    position: elementPos,
    icon: {
     url: "../img/pin_google.png",
     scaledSize: new google.maps.Size(40, 40)
    }
   });
  });
  map.fitBounds(bounds);
 });

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
  get_distance(service, markerArray, marker, map, storeArray);
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
     get_distance(service, markerArray, marker, map, storeArray);
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
     get_distance(service, markerArray, marker, map, storeArray);
    }
   }
  });
 });
 // \Listener para cuando damos click en el mapa


 // Try HTML5 geolocation.
 if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
   var pos = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
   };
   map.setCenter(pos);
   bounds.extend(pos);
   map.fitBounds(bounds);
   marker.setPosition(pos);
  get_distance(service, markerArray, marker, map, storeArray);
  }, function() {
   handleLocationError(true, infoWindow, map.getCenter(), map);
  });
 } else {
  // Browser doesn't support Geolocation
  handleLocationError(false, infoWindow, map.getCenter(), map);
 }
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
