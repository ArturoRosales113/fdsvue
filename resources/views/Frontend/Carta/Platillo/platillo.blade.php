@extends('Layouts.Frontend.app')
@section('page_title')
 {{$dish -> name}}
@endsection
@section('content')

 <div class="row d-flex justify-content-center align-items-center py-0 mt-0 mt-sm-2 py-sm-5">
  <!-- Texto -->
  <div class="col-10 col-md-4 mt-5 mt-md-0 text-right order-2 order-md-1 dish_row">
   <h1 class="font1">{{ $dish -> name }}</h1>
   <hr>
   <p class="px-2 py-5">
    {{ $dish -> description }}
   </p>
   <div class="row d-flex align-items-center mt-3">
    <div class="col-6">
     <span class="font2 two__em">$ {{ $dish -> price }}</span>
    </div>
    <div class="col-6">
     <a href="{{ route('shoppingcart.addToCart', $dish->id) }}" class="btn bg-2 text-white">Agregar al carrito  <i class="fa fa-shopping-bag"></i> </a>
    </div>
   </div>
  </div>
  <!-- Foto -->
  <div class="col-12 col-md-4 order-1 order-md-2 dish_row" style="background-image:url('{{Voyager::image($dish->img_path)}}');background-position:center;background-size:cover;">

  </div>


 </div>
@endsection
