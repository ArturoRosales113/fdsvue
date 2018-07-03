@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Store.Index.header')
 <div class="content">
  <div class="row">
   @include('Backend.Store.Index.stores')
  </div>
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
