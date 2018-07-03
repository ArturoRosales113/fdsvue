@extends('Layouts.Frontend.app')
@section('page_title') Checkout @endsection
 @section('page_styles')
<style>
 #map {
  height: 90vh;
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
@endsection @section('content')
<div class="py5"></div>
<div class="row d-flex align-items-start align-items-lg-center justify-content-center py-0">

 <div class="col-12 text-center">

  <form class="" action="{{route('shoppingcart.createorder')}}" method="POST" autocomplete="false">
   <div class="row d-flex align-items-center justify-content-center pb-2 mb-5 mb-sm-0">
    <div class="col-12 col-lg-6 text-left">
     <input id="pac-input" class="controls" type="text" placeholder="Escribe tu dirección"autocomplete="off" />
     <div id="map"></div>
    </div>
    <div class="col-12 col-md-10 col-lg-6">

     <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <div class="form-group row d-flex py-4 justify-content-center">
    <div class="col-10 text-left">
     <div  id="output" class="text-center p-4 alert alert-secondary">
     </div>
     <a data-url="{{route('shoppingcart.getStores')}}" id="get_stores"></a>
      <label for="address">Dirección</label>
     <textarea id="address" type="text" class="form-control" name="addres_text" autocomplete="off"></textarea>
    </div>
    <div class="d-none">
     <input type="text" id="latitude" name="address_lat" placeholder="Latitude" />
     <input type="text" id="longitude" name="address_lng" placeholder="Longitude" />
     <input type="text" name="store_id" id="store_id" value="">
      <input type="text" name="status_id" id="store_id" value="">
    </div>
     </div>
     <div class="form-group row d-flex justify-content-center">
      <div class="col-10 text-left">
       <label for="name">Nombre</label>
       <input type="text" id="name" name="customer_name" class="form-control" aria-describedby="nameHB" autocomplete="off"/ value="{{ old('customer_name') }}">
       <small id="nameHB" class="form-text text-muted">
            Ej Arturo Rosales
            @if ($errors->has('customer_name'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('customer_name') }}</strong>
                </span>
            @endif
         </small>

      </div>
     </div>
     <div class="form-group row d-flex justify-content-center">
      <div class="col-10 col-md-5 text-left">
       <label for="email">Correo</label>
       <input type="text" id="email" name="customer_mail" class="form-control" aria-describedby="emailHB" value="{{ old('customer_mail') }}">
       <small id="emailHB" class="form-text text-muted">
            correo@correo.com
            @if ($errors->has('customer_mail'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('customer_mail') }}</strong>
                </span>
            @endif
         </small>

      </div>
      <div class="col-10 col-md-5 text-left">
       <label for="phone">Teléfono</label>
       <input type="text" name="customer_phone" id="phone" class="form-control" aria-describedby="phoneHB" value="{{ old('customer_phone') }}">
       <small id="phoneHB" class="form-text text-muted">
            10 dígitos xxx xxx xx xx
            @if ($errors->has('customer_phone'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('customer_phone') }}</strong>
                </span>
            @endif
         </small>

      </div>
     </div>
     <div class="form-group row justify-content-center my-5">
      <div class="form-check col-10 col-md-8 pl-4 pl-sm-2 mb-3 text-left">
       <input class="form-check-input" type="radio" name="radioPagos" id="pago_efectivo" value="efectivo" checked>
       <label class="form-check-label" for="radioPagos2">
        Pagar con efectivo al recibir tu pedido.
       </label>
      </div>
      <div class="form-check col-10 col-md-8 pl-4 pl-sm-2 mb-3 text-left">
       <input class="form-check-input" type="radio" name="radioPagos" id="pago_tarjeta" value="tarjeta_entrega">
       <label class="form-check-label" for="radioPagos2">
        Pagar con tarjeta Bancaria al recibir tu pedido.
       </label>
      </div>
   <!--    <div class="form-check col-10 col-md-8 pl-4 pl-sm-2 mb-3 text-left">
    <input class="form-check-input" type="radio" name="radioPagos" id="pago_payu" value="tarjeta">
    <label class="form-check-label" for="radioPagos2">
     Con Cargo a tajeta de crédito o débito a través de PayU
    </label>
   </div> -->
     </div>
     <div class="form-group row">
      <div class="col-sm-10">
       <button type="submit" class="btn btn-success"><i class="fa  fa-envelope-open"></i>&nbsp;Enviar pedido</button>
      </div>
     </div>
    </div>
   </div>
  </form>
 </div>
</div>
@endsection @section('page_scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script src="https://terrylinooo.github.io/jquery.disableAutoFill/assets/js/jquery.disableAutoFill.min.js"></script>
{!! Html::script('js/mapcheckout.js') !!}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeUYbUAo57Oi4JRj-ipXKkQxN8hN6K59g&libraries=places,geometry&callback=initMap" async defer></script>

@endsection
