@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
@include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.User.Create.header')
  <div class="content">
   <div class="row">
    @include('Backend.User.Create.form')
   </div>
  </div>
  @include('Backend.Layouts.Footers.footer')
@endsection
