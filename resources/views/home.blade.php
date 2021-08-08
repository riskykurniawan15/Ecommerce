<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
  <title>{{ DB::table('configs')->where('NAME_CONFIG', 'BRAND_ECOMMERCE')->pluck('VALUE')->first() }}</title>
	<?php 
$icon = DB::table('configs')->where('NAME_CONFIG', 'ICON')->pluck('VALUE')->first();
if ($icon == "") {
	$icon = "default.png";
}
?>
	<!-- Favicon -->	
	<link rel="icon" type="image/png" href="{{asset('assets/img/icon/'.$icon)}}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	@yield('css')	
	
</head>
<body class="js">
		@if (session('status'))                    
			<script>	
					alert('{{ session('status') }}');		
			</script>
    @endif    

    @if (session('error'))                    
			<script>
					alert('{{ session('error') }}');		
			</script>            
    @endif        
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
		
		<!-- Header -->
		@yield('navbar', View::make('home.comp.navbar'))
		<!--/ End Header -->
		
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<!-- <li><a href="{{ url('/') }}">Home</a></li> -->
								<!-- <li class="active"><i class="ti-arrow-right"></i><a href="blog-single.html">Shop Grid</a></li> -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
    
    <!-- content -->
		@yield('content')
		<!-- end content -->		      
		
		<!-- Start Footer Area -->
		@yield('navbar', View::make('home.comp.footer'))
		<!-- /End Footer Area -->

		<!-- js -->
    @yield('js')
    <!-- end js -->

		<script>
				$(".remove-from-cart").click(function (e) {
						e.preventDefault();

						var value = $(this);

						if(confirm("Are you sure from delete data?")) {
								$.ajax({
										url: '{{ url('dropcart') }}',
										type     : 'POST',				
										dataType : 'html',
										data: {_token: '{{ csrf_token() }}', id: value.attr("data-id")},
										success: function (response) {
												window.location.reload();
										}
								});
						}
				});
		</script>    
    
</body>
</html>