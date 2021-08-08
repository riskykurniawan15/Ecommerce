<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php 
    $icon = DB::table('configs')->where('NAME_CONFIG', 'ICON')->pluck('VALUE')->first();
    if ($icon == "") {
      $icon = "default.png";
    }
    ?>
    <!-- Brand Logo -->
    <a href="{{ url('adminpanel') }}" class="brand-link">
      <img src="{{asset('assets/img/icon/'.$icon)}}" alt="Risoft Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ DB::table('configs')->where('NAME_CONFIG', 'BRAND_ECOMMERCE')->pluck('VALUE')->first() }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets')}}/dist/img/avatar/{{ Auth::user()->gender == 'Laki - Laki' ? 'cowo' : 'cewe' }}.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('adminpanel') }}" class="nav-link {{ Request::segment(2) === null ? 'active' : null }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard                                
              </p>
            </a>
          </li>          
          
          <li class="nav-item has-treeview {{ Request::segment(2) === 'items' ? 'menu-open' : null }}">
            <a href="#" class="nav-link {{ Request::segment(2) === 'items' ? 'active' : null }}">
              <i class="nav-icon fas fa-dolly-flatbed"></i>
              <p>
                Kelola Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('adminpanel/items') }}" class="nav-link {{ Request::segment(2) === 'items' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>              
            </ul>
          </li>

          <li class="nav-item has-treeview {{ Request::segment(2) === 'transactions' ? 'menu-open' : null }}">
            <a href="#" class="nav-link {{ Request::segment(2) === 'transactions' ? 'active' : null }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Kelola Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('adminpanel/transactions') }}" class="nav-link {{ Request::segment(2) === 'transactions' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Transaksi</p>
                </a>
              </li>              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('adminpanel/customers') }}" class="nav-link {{ Request::segment(2) === 'customers' ? 'active' : null }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Kelola Customers                                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('adminpanel/users') }}" class="nav-link {{ Request::segment(2) === 'users' ? 'active' : null }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Kelola Users                                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('adminpanel/configs') }}" class="nav-link {{ Request::segment(2) === 'configs' ? 'active' : null }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configurasi Aplikasi
              </p>
            </a>
          </li>
                    
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>