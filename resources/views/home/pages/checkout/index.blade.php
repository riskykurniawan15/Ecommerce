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

	<style>
		textarea{
			width: 100%;			
			/* line-height: 50px; */
			padding: 15px 20px;
			border-radius: 3px;
			border-radius: 0px;
			color: #333 !important;
			border: none;
			background: #F6F7FB;
		}
	</style>
@endsection

@section('content')
    <!-- Start Checkout -->
	<section class="shop checkout section">
		<div class="container">
			<div class="row"> 
				<div class="col-lg-8 col-12">
					<div class="checkout-form">
						<h2>Make Your Checkout Here</h2>
						<p>Please register in order to checkout more quickly</p>
						<!-- Form -->
						<form class="form" method="post" action="{{ url('checkout') }}" id="myform" autocomplete="off">
							@csrf
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Recipient Name<span>*</span></label>
										<input type="text" name="name" value="{{ Auth::guard('customer')->user()->name }}" placeholder="" required="required">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
										<label>Phone Number<span>*</span></label>
										<input type="number" name="contact" value="{{ Auth::guard('customer')->user()->contact }}" placeholder="" required="required">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Province<span>*</span></label>
										<input list="provinsi" id="provinsiSelect" name="provinsiSelect" placeholder="" autocomplete="none" required="required">
										<datalist id="provinsi">
											@foreach($provinsi as $data)
											<option data-value="{{ $data['province_id'] }}">{{ $data['province'] }}</option>
											@endforeach											
										</datalist>
										<input type="hidden" name="provinsi" id="provinsiSelect-hidden">											
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>County town<span>*</span></label>
										<input list="countytown" id="countytownSelect" name="countytownSelect" placeholder="" autocomplete="none" required="required" disabled>
										<datalist id="countytown">
											
										</datalist>
										<input type="hidden" name="countytown" id="countytownSelect-hidden">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Sub District<span>*</span></label>
										<input type="text" name="sub" placeholder="" required="required">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Postal Code<span>*</span></label>
										<input type="number" name="post" placeholder="" required="required">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Complete address<span>*</span></label>
										<textarea name="address" rows="5" placeholder="" required="required"></textarea>
									</div>										
								</div>								
								<div class="col-12">
									<div class="form-group">
										<label>Courier<span>*</span></label>
										<input list="courier" name="courierSelect" id="courierSelect" placeholder="" autocomplete="none" required="required" disabled>
										<datalist id="courier">
											
										</datalist>
										<input type="hidden" name="courier" id="courierSelect-hidden">																												
										<input type="hidden" name="namecourier" id="courierSelectName-hidden">																												
										<input type="hidden" name="servicecourier" id="courierSelectService-hidden">																												
									</div>										
								</div>								
							</div>
						</form>
						<!--/ End Form -->
					</div>
				</div>
				<div class="col-lg-4 col-12">
					<div class="order-details">
						<!-- Order Widget -->
						<div class="single-widget">
							<h2>Item Cart</h2>
							<div class="content">
								<div class="checkbox">
									@foreach (session('cart') as $id => $datacart)
									<label class="checkbox-inline" for="1">{{ $datacart['NAME_ITEMS'].' '.$datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS'].'x' }}</label>									
									@endforeach
								</div>
							</div>
						</div>
						<!--/ End Order Widget -->
						<!-- Order Widget -->

						<div class="single-widget">
							<h2>CART  TOTALS</h2>
							<div class="content">
								<ul>
									<li>Sub Total<span id="total"></span></li>
									<li>(+) Shipping<span id="harga"></span></li>
									<li class="last">Total<span id="subtotal"></span></li>
								</ul>
							</div>
						</div>
						<!--/ End Order Widget -->						
						<!-- Button Widget -->
						<div class="single-widget get-button">
							<div class="content">
								<div class="button">
									<button type="submit" class="btn" id="proceed" form="myform" disabled>proceed to checkout</button>
								</div>
							</div>
						</div>
						<!--/ End Button Widget -->						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ End Checkout -->
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
	<script>		
		function setdata(input){
			var list = input.getAttribute('list'),
				options = document.querySelectorAll('#' + list + ' option'),
				hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
				inputValue = input.value;
				
			
			hiddenInput.value = inputValue;

			for(var i = 0; i < options.length; i++) {
				var option = options[i];

				if(option.innerText === inputValue) {
					hiddenInput.value = option.getAttribute('data-value');
					if(list=="courier"){
						document.getElementById(input.getAttribute('id') + 'Name-hidden').value = option.getAttribute('data-name');
						document.getElementById(input.getAttribute('id') + 'Service-hidden').value = option.getAttribute('data-service');						
					}
					break;
				}
			}
		}

		function settown(idprov) {
			$.ajax({
				url	     : '{{ url('checkout/city') }}',
				type     : 'POST',
				dataType : 'html',
				data: {_token: '{{ csrf_token() }}', province: idprov},
				success  : function(response){
					$('#countytown').html(response);
					$('#countytownSelect').prop('disabled', false);
				},
			})
		}

		function setcourier(idcourier) {
			$.ajax({
				url	     : '{{ url('checkout/cost') }}',
				type     : 'POST',
				dataType : 'html',
				data: {_token: '{{ csrf_token() }}', destination: idcourier},
				success  : function(response){
					$('#courier').html(response);
					$('#courierSelect').prop('disabled', false);
				},
			})
		}
		
		function cost() {
			$.ajax({
				url	     : '{{ url('checkout/cost/get') }}',
				type     : 'POST',				
				dataType : 'html',
				data: {_token: '{{ csrf_token() }}'},
				success  : function(response){
					var result = $.parseJSON(response);
					$('#total').html(result.total);
					$('#harga').html(result.harga);
					$('#subtotal').html(result.subtotal);
				},
			})
		}

		function shippingcost(idnya, valdes, name) {
			$.ajax({
				url	     : '{{ url('checkout/cost') }}?id='+idnya,
				type     : 'POST',
				dataType : 'html',
				data: {_token: '{{ csrf_token() }}', destination: valdes, couriername: name},
				success  : function(response){
					var result = $.parseJSON(response);
					$('#total').html(result.total);
					$('#harga').html(result.harga);
					$('#subtotal').html(result.subtotal);
					$('#proceed').prop('disabled', false);
				},
			})
		}		

		$( document ).ready(function() {	
			cost();					
			$('#provinsiSelect').change(function(e){				
				setdata(e.target);
				$('#countytownSelect').prop('disabled', true);
				$('#courierSelect').prop('disabled', true);
				$('#proceed').prop('disabled', true);
				$('#countytown').html('');
				$('#courier').html('');
				cost();
				var province = $('#provinsiSelect-hidden').val();	
				$('#countytownSelect').val('');
				$('#courierSelect').val('');
				settown(province);			
			});
			
			$('#countytownSelect').change(function(e){				
				setdata(e.target);
				$('#courierSelect').prop('disabled', true);
				$('#proceed').prop('disabled', true);
				$('#courier').html('');
				cost();
				var town = $('#countytownSelect-hidden').val();	
				$('#courierSelect').val('');
				setcourier(town);					
			});

			$('#courierSelect').change(function(e){				
				setdata(e.target);				
				$('#proceed').prop('disabled', true);
				var town = $('#countytownSelect-hidden').val();	
				var name = $('#courierSelect').val();	
				var idnya = $('#courierSelect-hidden').val();	
				shippingcost(idnya, town, name);					
			});					
		});		
	</script>
@endsection