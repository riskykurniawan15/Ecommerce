        <header class="header shop">
            <!-- Topbar -->
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Top Left -->
                            <div class="top-left">
                                <ul class="list-main">
                                    <li><i class="ti-email"></i> <a href="mailto:{{ DB::table('configs')->where('NAME_CONFIG', 'EMAIL')->pluck('VALUE')->first() }}">{{ DB::table('configs')->where('NAME_CONFIG', 'EMAIL')->pluck('VALUE')->first() }}</a></li>
                                </ul>
                            </div>
                            <!--/ End Top Left -->
                        </div>
                        <?php 
                        $origin = DB::table('configs')->where('NAME_CONFIG', 'ORIGIN')->pluck('VALUE')->first();
                        $city = app('App\Http\Controllers\Home\RajaOngkirController')->city('', $origin);
                        ?>
                        <div class="col-lg-8 col-md-12 col-12">
                            <!-- Top Right -->
                            <div class="right-content">
                                <ul class="list-main">
                                    <li><i class="ti-location-pin"></i> {{ $city['results']['city_name'] }}</li>
                                    <li><i class="ti-headphone-alt"></i> <a href="tel:{{ DB::table('configs')->where('NAME_CONFIG', 'CONTACT')->pluck('VALUE')->first() }}">{{ DB::table('configs')->where('NAME_CONFIG', 'CONTACT')->pluck('VALUE')->first() }}</a></li>
                                    <!-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> -->
                                    @auth('customer')
                                    <li><i class="ti-user"></i> <a href="{{ url('account') }}">{{ Auth::guard('customer')->user()->name }}</a></li>
                                    <li><i class="ti-power-off"></i><a href="{{ url('auth/logout') }}">Logout</a></li>
                                    @else
                                    <li><i class="ti-user"></i> <a href="{{ url('auth') }}">Guest Account</a></li>
                                    <li><i class="ti-power-off"></i><a href="{{ url('auth') }}">Login</a></li>                                    
                                    @endauth
                                </ul>
                            </div>
                            <!-- End Top Right -->
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            $logo = DB::table('configs')->where('NAME_CONFIG', 'LOGO')->pluck('VALUE')->first();
            if ($logo == "") {
                $logo = "default.png";
            }
            ?>
        
            <!-- End Topbar -->
            <div class="middle-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-12">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="{{ url('/') }}"><img src="{{asset('assets/img/logo/'.$logo)}}" width="150px"  alt="logo"></a>
                            </div>
                            <!--/ End Logo -->
                            <!-- Search Form -->
                            <div class="search-top">
                                <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                                <!-- Search Form -->
                                <?php
                                if (isset($_GET['o'])) {
                                    $order = $_GET['o'];
                                } else {
                                    $order = "ascending";
                                }

                                if (isset($_GET['s'])) {
                                    $s = $_GET['s'];
                                } else {
                                    $s = "";
                                }
                                ?>
                                <div class="search-top">
                                    <form class="search-form" action="{{ url('/') }}" method="get">
                                        <input type="hidden" name="o" value="{{ $order }}">
                                        <input type="text" placeholder="Search here..." name="s" value="{{ $s }}">
                                        <button value="search" type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                                <!--/ End Search Form -->
                            </div>
                            <!--/ End Search Form -->
                            <div class="mobile-nav"></div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-12">
                            <div class="search-bar-top">
                                <div class="search-bar">
                                    <!-- <select>
                                        <option selected="selected">All Category</option>
                                        <option>watch</option>
                                        <option>mobile</option>
                                        <option>kid’s item</option>
                                    </select> -->
                                    <form action="{{ url('/') }}" method="get">
                                        <input type="hidden" name="o" value="{{ $order }}">
                                        <input type="text" style="width:200%;" placeholder="Search here..." name="s" value="{{ $s }}">
                                        <button class="btnn"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-12">
                            <div class="right-bar">
                                <!-- Search Form -->
                                <div class="sinlge-bar">
                                    <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="sinlge-bar">
                                    <a href="{{ url('account') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="sinlge-bar shopping">
                                    <a href="#" class="single-icon"><i class="ti-bag"></i> 
                                    @if(session('cart'))
                                        <span class="total-count">{{ count(session('cart')) }}</span>
                                    @else
                                        <span class="total-count">0</span>
                                    @endif                                        
                                    </a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                        @if(session('cart'))                                            
                                            <span>{{ count(session('cart')) }}</span>
                                        @else
                                            <span>0</span>
                                        @endif
                                            <a href="{{ url('cart') }}">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                        <?php $total = 0; ?>
                                        @if(session('cart'))                                              
                                            @foreach(session('cart') as $id => $datacart )
                                            <?php $total += $datacart['PRICE_ITEMS_TRANSACTIONS'] * $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS']; ?>
                                            <li>
                                                <button class="remove remove-from-cart" data-id="{{ $datacart['ID_ITEMS'] }}" title="Remove this item"><i class="fa fa-remove"></i></button>
                                                <a class="cart-img" href="javasript:void(0)"><img src="{{ url('assets/img/items/'.$datacart['HEAD_PICTURE_ITEMS']) }}" alt="#"></a>
                                                <h4><a href="javasript:void(0)">{{ $datacart['NAME_ITEMS'] }}</a></h4>
                                                <p class="quantity">{{ $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS'] }}x - <span class="amount">@currency($datacart['PRICE_ITEMS_TRANSACTIONS'])</span></p>
                                            </li>
                                            @endforeach
                                        @endif                                            
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">@currency($total)</span>
                                            </div>
                                            <a href="{{ url('checkout') }}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                    <!--/ End Shopping Item -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Inner -->
            <div class="header-inner">
                <div class="container">
                    <div class="cat-nav-head">
                        <div class="row">
                            <div class="col-12">
                                <div class="menu-area">
                                    <!-- Main Menu -->
                                    <nav class="navbar navbar-expand-lg">
                                        <div class="navbar-collapse">	
                                            <div class="nav-inner">	
                                                <ul class="nav main-menu menu navbar-nav">
                                                    <li class="{{ Request::segment(1) === null ? "active" : null }}"><a href="{{ url('/') }}">Home</a></li>
                                                    <li class="{{ Request::segment(1) === 'cart' || Request::segment(1) === 'checkout' || Request::segment(1) === 'transaction' ? "active" : null }}"><a href="#">Shop<i class="ti-angle-down"></i></a>
                                                        <ul class="dropdown">
                                                            <li><a href="{{ url('cart') }}">Cart</a></li>
                                                            @auth('customer')
                                                            <li><a href="{{ url('checkout') }}">Checkout</a></li>
                                                            <li><a href="{{ url('transaction') }}">Transaction</a></li>
                                                            @endauth
                                                        </ul>
                                                    </li>                                                    
                                                    @auth('customer')
                                                    <li class="{{ Request::segment(1) === 'account' ? "active" : null }}"><a href="#">Acount<i class="ti-angle-down"></i></a>
                                                        <ul class="dropdown">
                                                            <li><a href="{{ url('account') }}">Profile</a></li>
                                                            <li><a href="{{ url('account/password') }}">Change Password</a></li>                                                            
                                                        </ul>
                                                    </li>
                                                    @else
                                                    <li class="{{ Request::segment(1) === 'auth' ? "active" : null }}"><a href="{{ url('auth') }}">Login</a></li>
                                                    @endauth
                                                    <!-- <li><a href="#">Contact Us</a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>
                                    <!--/ End Main Menu -->	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Header Inner -->
        </header>


        