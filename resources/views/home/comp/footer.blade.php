		<!-- Start Shop Services Area  -->
		<section class="shop-services section home">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-time"></i>
							<h4>Fast Response</h4>
							<p>24 Hours</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-reload"></i>
							<h4>Free Return</h4>
							<p>Within 30 days returns</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-lock"></i>
							<h4>Sucure Payment</h4>
							<p>100% secure payment</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-tag"></i>
							<h4>Best Peice</h4>
							<p>Guaranteed price</p>
						</div>
						<!-- End Single Service -->
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Services -->

			<?php 
		$logo = DB::table('configs')->where('NAME_CONFIG', 'LOGO')->pluck('VALUE')->first();
		if ($logo == "") {
			$logo = "default.png";
		}
		?>
		<footer class="footer">
			<!-- Footer Top -->
			<div class="footer-top section">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-12">
							<!-- Single Widget -->
							<div class="single-footer about">
								<div class="logo">
									<a href="index.html"><img src="{{asset('assets/img/logo/'.$logo)}}" width="200px" alt="#"></a>
								</div>
								<p class="text">{{ DB::table('configs')->where('NAME_CONFIG', 'DESCRIPTION')->pluck('VALUE')->first() }}</p>
								<p class="call">Got Question? Call us 24/7<span><a href="tel:{{ DB::table('configs')->where('NAME_CONFIG', 'CONTACT')->pluck('VALUE')->first() }}">{{ DB::table('configs')->where('NAME_CONFIG', 'CONTACT')->pluck('VALUE')->first() }}</a></span></p>
							</div>
							<!-- End Single Widget -->
						</div>
						<div class="col-lg-2 col-md-6 col-12">
							<!-- Single Widget -->
							<div class="single-footer links">
								<h4>Link Apps</h4>
								<ul>
									<li><a href="{{ url('/') }}">Home</a></li>
									@auth('customer')
									@else
									<li><a href="{{ url('auth') }}">Login</a></li>
									@endauth									
									<li><a href="{{ url('/cart') }}">Cart</a></li>									
								</ul>
							</div>
							<!-- End Single Widget -->
						</div>
						<div class="col-lg-2 col-md-6 col-12">
							<!-- Single Widget -->
							<div class="single-footer links">
								<h4>Service</h4>
								<ul>
									<li><a href="{{ url('/') }}">Ecommerce</a></li>
									<li><a href="{{ url('adminpanel') }}">Adminpanel</a></li>
									<li><a href="http://risoftinc.epizy.com" target="_blank">Risoftinc</a></li>
									<li><a href="http://ars.ac.id" target="_blank">ARS University</a></li>
								</ul>
							</div>
							<!-- End Single Widget -->
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Single Widget -->
							<div class="single-footer social">
								<h4>Get In Tuch</h4>
								<!-- Single Widget -->
								<div class="contact">
									<ul>
										<li>Dsn Purwasari - 04/08 Ds Parigi. Kec Parigi. Kab Pangandaran 46393</li>										
										<li>ig:{{ '@'.DB::table('configs')->where('NAME_CONFIG', 'INSTAGRAM')->pluck('VALUE')->first() }}</li>
										<li>{{ DB::table('configs')->where('NAME_CONFIG', 'CONTACT')->pluck('VALUE')->first() }}</li>
									</ul>
								</div>
								<!-- End Single Widget -->
								<ul>
									<li><a href="http://facebook.com/{{ DB::table('configs')->where('NAME_CONFIG', 'FACEBOOK')->pluck('VALUE')->first() }}" target="_blank"><i class="ti-facebook"></i></a></li>
									<!-- <li><a href="#"><i class="ti-twitter"></i></a></li> -->
									<!-- <li><a href="#"><i class="ti-flickr"></i></a></li> -->
									<li><a href="http://instagram.com/{{ DB::table('configs')->where('NAME_CONFIG', 'INSTAGRAM')->pluck('VALUE')->first() }}" target="_blank"><i class="ti-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Single Widget -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Footer Top -->

			<?php 
		$icon = DB::table('configs')->where('NAME_CONFIG', 'ICON')->pluck('VALUE')->first();
		if ($icon == "") {
			$icon = "default.png";
		}
		?>
			<div class="copyright">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="left">
									<p>Copyright © 2020 <a href="http://risoftinc.epizy.com" target="_blank">Risoftinc</a>  -  All Rights Reserved. theme <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a></p>
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<div class="right">
									<img src="{{asset('assets/img/icon/'.$icon)}}" width="25px" alt="#">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>