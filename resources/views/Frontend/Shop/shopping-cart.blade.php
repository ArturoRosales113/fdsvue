@extends('Layouts.Frontend.app')
@section('page_title')
 Carrito
@endsection
@section('content')
 <!-- Header -->
	 @if(Session::has('cart'))
   <div class="row d-flex justify-content-center mb-5 align-items-center pt-5">
 			<div class="col-11 col-md-10 col-lg-6">
     <div class="card">
        <h2 class="card-header font1 text-white bg-2 text-center py-5">SU PEDIDO</h2>
        <ul class="list-group list-group-flush">
           @foreach($products as $product)
           <li class="list-group-item p-3 p-lg-5 my-1 bg-2" id="line_product_{{ $product['item']['id'] }}" style="background-image:url('{{ Voyager::image($product['item']['img_path']) }}');background-position: center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;background-blend-mode: multiply;">
            <div class="row d-flex align-items-center">
             <div class="col pl-lg-4 text-right">
              <h3 class="font1 text-white">{{ $product['item']['name'] }}</h3>
              <small class="text-white font2">${{ $product['item']['price'] }}.00
              <!--  Cantidad -->
              <span class="text-center" id="cantidad_{{$product['item']['id'] }}">
               <i class="fa fa-times"></i>
               <span id="item_qty_{{ $product['item']['id'] }}" >{{ $product['qty'] }}</span>
               <i class="fa fa-equals"></i>&nbsp;
               <span id="item_price_{{ $product['item']['id'] }}">$ {{ $product['price'] }}</span>
              </small>
             </div>
             <div class="col-4 d-flex flex-column flex-lg-row justify-content-center">
              <!-- Agregar uno  -->
              <a href="#!"  class="btn d-flex justify-content-center align-items-center text-white text-center font2 addOne" data-url="{{ route('shoppingcart.addToCart' , $product['item']['id']) }}" data-qty="{{ $product['qty'] }}" id="add_one_{{$product['item']['id']}}">
                <span>+&nbsp;1</span>
              </a>

              <!-- Quitar uno -->
              <a href="#!" class="btn d-flex justify-content-center align-items-center text-white text-center reduceOne font2" data-url="{{ route('shoppingcart.reduceFromCart' , $product['item']['id']) }}" data-qty="{{ $product['qty'] }}" id="reduce_one_{{$product['item']['id']}}">
              <small><i class="fa fa-minus"></i></small><span>&nbsp;1</span>
              </a>
              <!-- Borrar -->
              <a href="#!" data-url="{{ route('shoppingcart.removeFromCart' , $product['item']['id']) }}" class="btn d-flex align-items-center justify-content-center text-white text-center eraseOne font2">
               <i class="fa fa-trash"></i><small></small>
              </a>


             </div>


            </div>
           </li>
          @endforeach
          <li class="list-group-item p-4 my-1 bg-2">
            <div class="row d-flex align-items-center">
              <div class="col text-right"><span class="font2 text-white" id="total_cart_qty">{{$totalQty}}</span><span class="font2 text-white">&nbsp;productos</span></div>
              <div class="col text-right">
               <h4 class="font1 text-white m-0">TOTAL&nbsp;<span id="total_cart_price">${{$totalPrice}}</span></h4>
              </div>
            </div>
          </li>
        </ul>
        <div class="card-footer d-flex justify-content-center justify-content-sm-end">
         <a class="btn bg-2 text-white mr-2" href="{{ route('front.carta') }}">
          <i class="fa fa-utensils"></i> &nbsp;
          Volver a la carta
         </a>
         <a href="{{ route('shoppingcart.checkout') }}" class="btn btn-success">Pagar  &nbsp;<i class="fas fa-money-check-alt"></i></a>
        </div>
      </div>
 			</div>
 		</div>
		@else
		<div class="row d-flex justify-content-center align-items-center one__vh">
			<div class="col-sm-6 col-md-6 text-center">
				<h2 class="font1 two__em">No hay platillos en el carrito</h2>
    <a href="{{ route('front.carta')}}" class="btn btn-lg bg-1 font2 text-white"> Ver Carta</a>
			</div>
		</div>
	 @endif
@endsection
@section('page_scripts')
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
 </script>
 {!! Html::script('js/cart_controllers.js') !!}
@endsection
