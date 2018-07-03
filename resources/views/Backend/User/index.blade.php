@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.User.Index.header')
 <div class="content">
  <div class="row">
   @include('Backend.User.Index.users_table')
  </div>
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
