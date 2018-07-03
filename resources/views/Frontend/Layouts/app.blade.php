<!DOCTYPE html>
<html lang="es" dir="ltr">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="shortcut icon" type="image/png" href=""/>
  <title>Shintai | @yield('page_title') </title>
  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <!-- Styles -->
  @include('Frontend.Layouts.styles')
  @yield('page_styles')
 </head>
   @include('Frontend.Layouts.Navbars.nav_expand')
 <body>
  <!-- Content -->
  @yield('content')
  <!-- Scripts -->
  @include('Frontend.Layouts.scripts')
  <!-- PageScripts -->
  @yield('page_scripts')
 </body>
</html>
