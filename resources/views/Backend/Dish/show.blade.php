@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Dish.Show.header')
 <div class="content">
   @include('Backend.Dish.Show.dish')
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
