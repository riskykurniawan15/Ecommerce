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
	<?php $cart = session()->get('cart'); ?>
    <!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			@if(!empty($cart))
			<form action=" {{ url('cart/update') }}" method="post">
			@csrf
			@endif

			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
						<?php $total = 0; ?>
						@if(session('cart'))                                              
                            @foreach(session('cart') as $id => $datacart )
							<?php $total += $datacart['PRICE_ITEMS_TRANSACTIONS'] * $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS']; ?>
							<tr>
								<td class="image" data-title="No"><img src="{{ url('assets/img/items/'.$datacart['HEAD_PICTURE_ITEMS']) }}" alt="#"></td>
								<td class="product-des" data-title="Description">
									<p class="product-name"><a href="#">{{ $datacart['NAME_ITEMS'] }}</a></p>
									<p class="product-des">{{ $datacart['DESCRIPTION_ITEMS'] }}</p>
								</td>
								<td class="price" data-title="Price"><span>@currency($datacart['PRICE_ITEMS_TRANSACTIONS']) </span></td>
								<td class="qty" data-title="Qty"><!-- Input Order -->
									<div class="input-group">
										<div class="button minus">
											<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{ $datacart['ID_ITEMS'] }}]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="hidden" name="id[]" value="{{ $datacart['ID_ITEMS'] }}">
										<input type="text" name="quant[{{ $datacart['ID_ITEMS'] }}]" class="input-number"  data-min="1" data-max="100" value="{{ $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS'] }}">
										<div class="button plus">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $datacart['ID_ITEMS'] }}]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
									<!--/ End Input Order -->
								</td>
								<td class="total-amount" data-title="Total"><span>@currency($datacart['PRICE_ITEMS_TRANSACTIONS']*$datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS'])</span></td>
								<td class="action" data-title="Remove"><a class="remove-from-cart" href="javascript:void(0)" data-id="{{ $datacart['ID_ITEMS'] }}"><i class="ti-trash remove-icon"></i></a></td>
							</tr>
							@endforeach
						@endif
						
						@if(empty($cart))
						<tr>
							<td colspan="6" align="center">
								No Items in you cart
							</td>
						</tr>
						@endif
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									<div class="coupon">
										<!-- <form action="#" target="_blank"> -->
											<!-- <input name="Coupon" placeholder="Enter Your Coupon"> -->
											<a href="{{ url('/') }}"><button type="button" class="btn">Continue shopping</button></a>
											@if(!empty($cart))
											<button type="submit" class="btn">Update Cart</button>
											@endif
										<!-- </form> -->
									</div>									
								</div>
							</div>
							@if(!empty($cart))
							</form>
							@endif
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li>Cart Subtotal<span>@currency($total)</span></li>
										<li class="last">You Pay<span>@currency($total)</span></li>
									</ul>
									<div class="button5">
										@if(!empty($cart))
										<a href="{{ url('checkout') }}" class="btn">Checkout</a>										
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
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