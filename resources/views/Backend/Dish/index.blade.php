@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Dish.Index.header')
 <div class="content">
  <div class="row">
   @include('Backend.Dish.Index.dishes_table')
  </div>
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
