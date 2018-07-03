@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
@include('Backend.Category.Create.header')
 <div class="content">
  @include('Backend.Category.Create.form')
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
