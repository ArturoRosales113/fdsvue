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
 @include('Backend.Store.Create.header')
  <div class="content">
   <div class="row">
    @include('Backend.Store.Create.form')
   </div>
  </div>
  @include('Backend.Layouts.Footers.footer')
@endsection
@section('page_scripts')
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
 </script>
 <script src="https://terrylinooo.github.io/jquery.disableAutoFill/assets/js/jquery.disableAutoFill.min.js"></script>
 {!! Html::script('js/map_store_create.js') !!}
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeUYbUAo57Oi4JRj-ipXKkQxN8hN6K59g&libraries=places,geometry&callback=initMap" async defer></script>

@endsection
