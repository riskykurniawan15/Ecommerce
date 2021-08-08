<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block {{ Request::segment(2) === null ? 'active' : null }}">
        <a href="{{ url('adminpanel') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block {{ Request::segment(2) === 'profile' ? 'active' : null }}">
        <a href="{{ url('adminpanel/profile') }}" class="nav-link">Profile</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block {{ Request::segment(2) === 'change_password' ? 'active' : null }}">
        <a href="{{ url('adminpanel/change_password') }}" class="nav-link">Change Password</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('adminpanel/logout') }}" class="nav-link">Logout</a>            
        </li>              
    </ul>
  </nav>
  <!-- /.navbar -->