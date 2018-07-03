@extends('Layouts.Frontend.app')
@section('page_title')
 Carta
@endsection
@section('page_styles')
 {!! Html::style('iconos_japon/flaticon.css') !!}
@endsection
@section('content')
 <!-- Platillos -->
 @include('Frontend.Carta.platillos')
@endsection
@section('page_scripts')
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
 </script>
{!! Html::script('js/cart_controllers.js') !!}
@endsection
