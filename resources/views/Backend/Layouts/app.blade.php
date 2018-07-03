<html lang="en" class="perfect-scrollbar-off">
 <head>
     <meta charset="utf-8">
     <link rel="icon" type="image/png" href="../assets/img/favicon.png">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <title>FDS</title>
     <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">
     <!--     Fonts and icons     -->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
     <!-- CSS Files -->
     @include('Backend.Layouts.styles')
     @yield('page_styles')
 </head>
 <body class="sidebar-mini">
  <div class="wrapper">
   @include('Backend.Layouts.sidebar')
   <div class="main-panel">
    @yield('content')
   </div>
  </div>
  @include('Backend.Layouts.scripts')
  @yield('page_scripts')
 </body>
</html>
