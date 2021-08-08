
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <?php 
  $icon = DB::table('configs')->where('NAME_CONFIG', 'ICON')->pluck('VALUE')->first();
  if ($icon == "") {
    $icon = "default.png";
  }
  ?>
  <link rel="icon" type="image/png" href="{{asset('assets/img/icon/'.$icon)}}">

  <title>Adminpanel | {{ DB::table('configs')->where('NAME_CONFIG', 'BRAND_ECOMMERCE')->pluck('VALUE')->first() }}</title>

  @yield('css')  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @yield('navbar', View::make('adminpanel.comp.navbar'))      

  @yield('sidebar', View::make('adminpanel.comp.sidebar'))

  @yield('content')  

  @yield('footer', View::make('adminpanel.comp.footer'))
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@yield('js')
</body>
</html>
