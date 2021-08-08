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
    <!-- Product Style -->
    <section class="product-area shop-sidebar shop section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
							<?php 
						if (isset($_GET['s'])) {
							$s = $_GET['s'];
						} else {
							$s = "";
						}
						?>
								<!-- Single Widget -->
								<div class="single-widget category">
									<h3 class="title">Ordering</h3>
									<ul class="categor-list">
										<li><a href="{{ url('/?o=ascending&s='.$s) }}">Name A-Z</a></li>
										<li><a href="{{ url('/?o=descending&s='.$s) }}">Name Z-A</a></li>
										<li><a href="{{ url('/?o=expensive&s='.$s) }}">Expensive</a></li>
										<li><a href="{{ url('/?o=cheap&s='.$s) }}">Cheap</a></li>
										<li><a href="{{ url('/?o=newest&s='.$s) }}">Newest</a></li>
										<li><a href="{{ url('/?o=longest&s='.$s) }}">Longest</a></li>
										<li><a href="{{ url('/?o=heaviest&s='.$s) }}">Heaviest</a></li>
										<li><a href="{{ url('/?o=lightest&s='.$s) }}">Lightest</a></li>
									</ul>
								</div>
								<!--/ End Single Widget -->															
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
									<div class="shop-shorter">
										<div class="single-shorter">
										@if($items->count()==0) 
											<label>Show : No Items Result</label> 
										@else
											<label>Show : All Data</label>
										@endif
											<!-- <select>
												<option selected="selected">09</option>
												<option>15</option>
												<option>25</option>
												<option>30</option>
											</select> -->
										</div>
										<!-- <div class="single-shorter">
											<label>Sort By :</label>
											<select>
												<option selected="selected">Name</option>
												<option>Price</option>
												<option>Size</option>
											</select>
										</div> -->
									</div>
									<ul class="view-mode">
										<li class="active"><a href="javascript:void(0)"><i class="fa fa-th-large"></i></a></li>										
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
						<div class="row">
              <!-- item -->
                @foreach($items as $data)
                <div class="col-lg-4 col-md-6 col-12">
                  <div class="single-product">
                    <div class="product-img">
                      <a href="javascript:void(0)">
                        @if( $data->HEAD_PICTURE_ITEMS=="" )
                          <img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
                          <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
                        @else
                          <img class="default-img" src="{{ url('assets/img/items/'.$data->HEAD_PICTURE_ITEMS) }}" alt="#">
                          <img class="hover-img" src="{{ url('assets/img/items/'.$data->HEAD_PICTURE_ITEMS) }}" alt="#">
                        @endif
                      </a>
                      <div class="button-head">
                        <div class="product-action">
                          <a data-toggle="modal" data-target="#{{ $data->CODE_ITEMS }}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                          <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                          <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                        </div>
                        <div class="product-action-2">
                          <a title="Add to cart" href="{{ url('addcart/'.$data->ID_ITEMS) }}">Add to cart</a>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <h3><a href="javascript:void(0)">{{ $data->NAME_ITEMS }}</a></h3>
                      <div class="product-price">
                        <span>@currency($data->SELLING_PRICE_ITEMS)</span>
                      </div>
                    </div>
                  </div>
                </div>		
                @endforeach					
              <!-- end item -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Style 1  -->	

		<!-- Modal -->
    @foreach($items as $data)
			<div class="modal fade" id="{{ $data->CODE_ITEMS }}" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
						</div>
						<div class="modal-body">
							<div class="row no-gutters">
								<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									<!-- Product Slider -->
										<div class="product-gallery">
											<div class="quickview-slider-active">
												@foreach($dataimg = DB::table('item_images')->where('ID_ITEMS', '=', $data->ID_ITEMS)->get() as $img)												
												<div class="single-slider">
													<img src="{{ url('assets/img/items/images/'.$img->NAME_ITEM_IMAGES) }}" alt="#">
												</div>
												@endforeach
												@if ($dataimg->count() == 1)
												<div class="single-slider">
													<img src="{{ url('assets/img/items/images/'.$img->NAME_ITEM_IMAGES) }}" alt="#">
												</div>					
												@endif
												@if ($dataimg->count() == 0)
												<div class="single-slider">
													<img src="https://via.placeholder.com/569x528" alt="#">
												</div>					
												<div class="single-slider">
													<img src="https://via.placeholder.com/569x528" alt="#">
												</div>					
												@endif																			
											</div>
										</div>
									<!-- End Product slider -->
								</div>
								<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									<div class="quickview-content">
										<h2>{{ $data->NAME_ITEMS }}</h2>
										<div class="quickview-ratting-review">
											<!-- <div class="quickview-ratting-wrap">
												<div class="quickview-ratting">
													<i class="yellow fa fa-star"></i>
													<i class="yellow fa fa-star"></i>
													<i class="yellow fa fa-star"></i>
													<i class="yellow fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<a href="#"> (1 customer review)</a>
											</div> -->
											<div class="quickview-stock-wrap">
												<span><i class="fa fa-check-circle-o"></i> in stock</span>
											</div>
										</div>
										<h3>@currency($data->SELLING_PRICE_ITEMS)</h3>
										<div class="quickview-peragraph">
											<p>{{ $data->DESCRIPTION_ITEMS }}</p>
										</div>
										<!-- <div class="size">
											<div class="row">
												<div class="col-lg-6 col-12">
													<h5 class="title">Size</h5>
													<select>
														<option selected="selected">s</option>
														<option>m</option>
														<option>l</option>
														<option>xl</option>
													</select>
												</div>
												<div class="col-lg-6 col-12">
													<h5 class="title">Color</h5>
													<select>
														<option selected="selected">orange</option>
														<option>purple</option>
														<option>black</option>
														<option>pink</option>
													</select>
												</div>
											</div>
                    </div> -->
                    <br><br>
										<form action="{{ url('addcart/'.$data->ID_ITEMS) }}" method="post">
											@csrf
											<div class="quantity">
												<!-- Input Order -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="jml[{{ $data->ID_ITEMS }}]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="jml[{{ $data->ID_ITEMS }}]" class="input-number"  data-min="1" data-max="1000" value="1">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="jml[{{ $data->ID_ITEMS }}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</div>
											<div class="add-to-cart">
												<button type="submit" href="#" class="btn">Add to cart</button>
												<!-- <a href="#" class="btn min"><i class="ti-heart"></i></a>
												<a href="#" class="btn min"><i class="fa fa-compress"></i></a> -->
											</div>
										</form>
										<!-- <div class="default-social">
											<h4 class="share-now">Share:</h4>
											<ul>
												<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
												<li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
      </div>
    @endforeach
    <!-- Modal end -->
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