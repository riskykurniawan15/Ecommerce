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

		.inputfile {
			width: 100%;
			line-height: 40px;
			padding: 0x;
			margin-bottom:10px;
			border-radius: 2px;
			border-radius: 2px;
			color: #333 !important;
			border: none;
			background: #F6F7FB;
		}

		.code{
			color: #ff2c18;
			top: 4px;
			font-size: 16px;
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
						<h2>Detail Transaction</h2>
						<p>Code Transaction {{ $transaction->CODE_TRANSACTIONS }}</p>
						<!-- Form -->
						@if($transaction->STATUS_TRANSACTIONS != 'Orders accepted')
						<form class="form" method="post" enctype="multipart/form-data" action="{{ url('transaction/'.$transaction->ID_TRANSACTIONS.'/'.$transaction->CODE_TRANSACTIONS) }}" id="myform" autocomplete="off">
							@csrf
							<input type="hidden" name="kode" value="{{ md5(crypt($transaction->CODE_TRANSACTIONS,$transaction->created_at)) }}">
						@endif
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Recipient Name<span>*</span></label>
										<input type="text" name="name" value="{{ $transaction->RECIPIENT_TRANSACTIONS }}" placeholder="" readonly>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<div class="form-group">
										<label>Phone Number<span>*</span></label>
										<input type="number" name="contact" value="{{ $transaction->CONTACT_RECIPIENT_TRANSACTIONS }}" placeholder="" readonly>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Courier<span>*</span></label>
										<input type="text" name="name" value="{{ $transaction->COURIER_TRANSACTIONS }}" placeholder="" readonly>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Complete address<span>*</span></label>
										<textarea name="address" rows="5" placeholder="" readonly>{{ $transaction->SHIPPING_ADDRESS_TRANSACTIONS }}</textarea>
									</div>
								</div>

								@if($transaction->STATUS_TRANSACTIONS == 'Not yet paid'||$transaction->STATUS_TRANSACTIONS == 'Resend proof of payment')
								<div class="col-12" style="margin-bottom:20px;">									
									<label>Transfer to ({{ DB::table('configs')->where('NAME_CONFIG', 'NOREK')->pluck('VALUE')->first() }} a.n {{ DB::table('configs')->where('NAME_CONFIG', 'NAME_NOREK')->pluck('VALUE')->first() }} [{{ DB::table('configs')->where('NAME_CONFIG', 'BANK')->pluck('VALUE')->first() }}]) and upload your prof of payment</label>										
									<label>Upload Proof of Payment<span class="code"> *</span></label>
									<input type="file" name="UPLOAD_FILE" accept="image/png, image/jpeg, image/jpg" class="inputfile" required>
								</div>
								<div class="col-12">
									<div class="form-group create-account">										
										<div class="button">
											<button type="submit" class="btn">save change</button>
										</div>
									</div>
								</div>
								@elseif($transaction->STATUS_TRANSACTIONS == 'Item Shipped')
								<div class="col-12">
									<div class="form-group">
										<label>Receipt Code</label>
										<input type="text" value="{{ $transaction->RECEIPT_CODE_TRANSACTIONS }}" placeholder="" readonly>
									</div>
								</div>
								@endif

								@if($transaction->STATUS_TRANSACTIONS == 'Item Shipped')
								<input type="hidden" name="orders" value="accepted">
								<div class="col-12">
									<div class="form-group create-account">										
										<div class="button">
											<button type="submit" class="btn" onclick="return confirm('Are you sure the order has been received?');">Orders accepted</button>
										</div>
									</div>
								</div>
								@endif
							</div>
						@if($transaction->STATUS_TRANSACTIONS != 'Orders accepted')
						</form>
						@endif
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
									@foreach(DB::table('detail_transactions')->where('ID_TRANSACTIONS', $transaction->ID_TRANSACTIONS)->get() as $dt)
									<label class="checkbox-inline" for="1">{{DB::table('items')->where('ID_ITEMS', $dt->ID_ITEMS)->pluck('NAME_ITEMS')->first() }} {{$dt->QUANTITY_ITEM_DETAIL_TRANSACTIONS}}x <br></label>
									@endforeach																											
								</div>
							</div>
						</div>
						<!--/ End Order Widget -->
						<!-- Order Widget -->

						<?php $jml = DB::table('detail_transactions')
						->select(DB::raw('sum(PRICE_ITEMS_TRANSACTIONS*QUANTITY_ITEM_DETAIL_TRANSACTIONS) as jml'))
						->where('ID_TRANSACTIONS', $transaction->ID_TRANSACTIONS)
						->pluck('jml')->first(); ?>											

						<div class="single-widget">
							<h2>CART  TOTALS</h2>
							<div class="content">
								<ul>
									<li>Sub Total<span id="total">@currency($jml)</span></li>
									<li>(+) Shipping<span id="harga">@currency($transaction->SHIPPING_COSTS_TRANSACTIONS)</span></li>
									<li class="last">Total<span id="subtotal">@currency($jml+$transaction->SHIPPING_COSTS_TRANSACTIONS)</span></li>
								</ul>
							</div>
						</div>
						<!--/ End Order Widget -->												
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
@endsection