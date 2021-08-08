@extends('home')

@section('css')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/magnific-popup.min.css">
	  <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/jquery.fancybox.min.css">
	  <!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/themify-icons.css">
	  <!-- Jquery Ui -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/jquery-ui.css">
	  <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/niceselect.css">
	  <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/animate.css">
	  <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/flex-slider.min.css">
	  <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/owl-carousel.css">
	  <!-- Slicknav -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/slicknav.min.css">
	
    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/reset.css">
    <link rel="stylesheet" href="{{asset('assets/home')}}/style.css">
    <link rel="stylesheet" href="{{asset('assets/home')}}/css/responsive.css">
@endsection

@section('content')
    <!-- Start Register -->
	<section class="shop checkout section">
		<div class="container">
			<div class="row"> 				
				<div class="col-12">
					<div class="checkout-form">
						<h2>Update profile account?</h2>
						<p>Please fill in the form below</p>
						<!-- Form -->
						<form class="form" method="post" action="{{ url('account') }}">
							@csrf
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Your Name<span>*</span></label>
										<input type="text" name="name" value="{{ Auth::guard('customer')->user()->name }}" placeholder="" required="required">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Gender<span>*</span></label>
										<select name="gender" id="gender">
											<option value="Laki - Laki" {{ Auth::guard('customer')->user()->gender == 'Laki - Laki' ? 'selected="selected"' : null }}>Male</option>
											<option value="Perempuan" {{ Auth::guard('customer')->user()->gender == 'Perempuan' ? 'selected="selected"' : null }}>Female</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Email Address<span>*</span></label>
										<input type="email" name="email" value="{{ Auth::guard('customer')->user()->email }}" placeholder="" required="required">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Phone Number<span>*</span></label>
										<input type="number" name="contact" value="{{ Auth::guard('customer')->user()->contact }}" placeholder="" required="required">
									</div>
								</div>
								
								<div class="col-12">
									<div class="form-group create-account">
										<div class="button">
											<button type="submit" class="btn">update profile</button>
										</div>
									</div>
								</div>
								
							</div>
						</form>
						<!--/ End Form -->
					</div>
				</div>				
			</div>
		</div>
	</section>
	<!--/ End Register -->
@endsection

@section('js')
    <!-- Jquery -->
    <script src="{{asset('assets/home')}}/js/jquery.min.js"></script>
    <script src="{{asset('assets/home')}}/js/jquery-migrate-3.0.0.js"></script>
    <script src="{{asset('assets/home')}}/js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="{{asset('assets/home')}}/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('assets/home')}}/js/bootstrap.min.js"></script>
    <!-- Color JS -->
    <script src="{{asset('assets/home')}}/js/colors.js"></script>
    <!-- Slicknav JS -->
    <script src="{{asset('assets/home')}}/js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="{{asset('assets/home')}}/js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="{{asset('assets/home')}}/js/magnific-popup.js"></script>
    <!-- Fancybox JS -->
    <script src="{{asset('assets/home')}}/js/facnybox.min.js"></script>
    <!-- Waypoints JS -->
    <script src="{{asset('assets/home')}}/js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="{{asset('assets/home')}}/js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="{{asset('assets/home')}}/js/nicesellect.js"></script>
    <!-- Ytplayer JS -->
    <script src="{{asset('assets/home')}}/js/ytplayer.min.js"></script>
    <!-- Flex Slider JS -->
    <script src="{{asset('assets/home')}}/js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="{{asset('assets/home')}}/js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="{{asset('assets/home')}}/js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="{{asset('assets/home')}}/js/easing.js"></script>
    <!-- Active JS -->
	<script src="{{asset('assets/home')}}/js/active.js"></script>	
@endsection