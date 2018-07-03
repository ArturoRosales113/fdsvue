@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Category.Edit.header')
 <div class="content">
  @include('Backend.Category.Edit.form')
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
