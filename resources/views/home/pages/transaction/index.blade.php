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
		.shopping-cart{
			background:white;
		}		
	</style>
@endsection

@section('content')
    <!-- Start Checkout -->
	<section class="shop checkout section">
		<div class="container">
			<div class="row"> 
				<div class="col-lg-3 col-12" style="padding-top:20px;">

					<div class="order-details">
						<!-- Order Widget -->						
						<div class="single-widget">
							<h2>Filter</h2>							
						</div>
						<!--/ End Order Widget -->						
						<!-- Button Widget -->
						<div class="single-widget get-button">
							<div class="content">
								<div class="button">
									<a href="{{ url('transaction') }}" class="btn" id="proceed">All Transaction</a>
								</div>
								<div class="button mt-1">
									<a href="{{ url('transaction/Not yet paid') }}" class="btn" id="proceed">Not yet paid</a>
								</div>
								<div class="button mt-1">
									<a href="{{ url('transaction/Resend proof of payment') }}" class="btn" id="proceed">Resend payment</a>
								</div>
								<div class="button mt-1">
									<a href="{{ url('transaction/Confirmed and is being packed') }}" class="btn" id="proceed">is being packed</a>
								</div>
								<div class="button mt-1">
									<a href="{{ url('transaction/Item Shipped') }}" class="btn" id="proceed">Item Shipped</a>
								</div>
								<div class="button mt-1">
									<a href="{{ url('transaction/Orders accepted') }}" class="btn" id="proceed">Order accepted</a>
								</div>
							</div>
						</div>
						<!--/ End Button Widget -->						
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<!-- Shopping Cart -->
					<div class="shopping-cart section">
						<div class="container">							
							<div class="row">
								<div class="col-12">
									<!-- Shopping Summery -->
									<table class="table shopping-summery">
										<thead>
											<tr class="main-hading">
												<th>Transaction Code</th>
												<th>Items</th>
												<th class="text-center">Status</th>
												<th class="text-center"><i class="ti-new-window remove-icon"></i></th>
											</tr>
										</thead>
										<tbody>																				                                  
											@foreach($transactions as $transaction )
											<?php $jml = DB::table('detail_transactions')
											->select(DB::raw('sum(PRICE_ITEMS_TRANSACTIONS*QUANTITY_ITEM_DETAIL_TRANSACTIONS) as jml'))
											->where('ID_TRANSACTIONS', $transaction->ID_TRANSACTIONS)
											->pluck('jml')->first(); ?>
											<tr>
												<td class="product-des" data-title="Transaction Code">
													<p class="product-name"><a href="{{ url('transaction/'.$transaction->ID_TRANSACTIONS.'/'.$transaction->CODE_TRANSACTIONS) }}">{{ $transaction->CODE_TRANSACTIONS }}</a></p>
													<p class="product-des">@currency($jml+$transaction->SHIPPING_COSTS_TRANSACTIONS)</p>
												</td>
												<td class="product-des" data-title="Items">													
													@foreach(DB::table('detail_transactions')->where('ID_TRANSACTIONS', $transaction->ID_TRANSACTIONS)->get() as $dt)
													{{ DB::table('items')->where('ID_ITEMS', $dt->ID_ITEMS)->pluck('NAME_ITEMS')->first() }} {{$dt->QUANTITY_ITEM_DETAIL_TRANSACTIONS}}x <br> 
													@endforeach
												</td>
												<td class="qty" data-title="Status">
													{{ $transaction->STATUS_TRANSACTIONS }}
												</td>
												<td class="action" data-title="Detail"><a href="{{ url('transaction/'.$transaction->ID_TRANSACTIONS.'/'.$transaction->CODE_TRANSACTIONS) }}"><i class="ti-new-window remove-icon"></i></a></td>
											</tr>
											@endforeach		
											@if($transactions->count()==0)
											<tr>
												<td colspan="4" class="product-des text-center" data-title="Description">
													<p class="product-name">No data transaction</p>
												</td>
											</tr>
											@endif																	
										</tbody>
									</table>
									<!--/ End Shopping Summery -->
								</div>
							</div>
						</div>
					</div>
					<!--/ End Shopping Cart -->
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
	</script>
@endsection