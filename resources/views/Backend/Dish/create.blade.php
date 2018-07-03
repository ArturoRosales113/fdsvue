@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
@include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Dish.Create.header')
  <div class="content">
   <div class="row">
    @include('Backend.Dish.Create.form')
   </div>
  </div>
  @include('Backend.Layouts.Footers.footer')
@endsection
