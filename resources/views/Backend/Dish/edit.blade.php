@extends('Backend.Layouts.app')

@section('content')
 <!-- Navbar -->
 @include('Backend.Layouts.Navbars.nav_expand')
 @include('Backend.Dish.Edit.header')
 <div class="content">
  <div class="row">
   @include('Backend.Dish.Edit.form')
  </div>
 </div>
 @include('Backend.Layouts.Footers.footer')
@endsection
@section('page_scripts')
 <script type="text/javascript">
  $(document).ready(function(){
    $('.')
  });
 </script>
@endsection
