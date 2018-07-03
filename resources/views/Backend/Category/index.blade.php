@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
  <!-- Header -->
  @include('Backend.Category.Index.header')
 <div class="content">
  @include('Backend.Category.Index.categories_table')
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
