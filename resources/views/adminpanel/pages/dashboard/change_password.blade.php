@extends('adminpanel')

@section('css')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets')}}/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password Page</h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- infobox -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5>Ini Adalah Menu Change Password!</h5>  
              <p>Menu ini digunakan untuk mengganti Password Pengguna. 
                
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end infobox -->

    <!-- notif -->
    @if (session('status'))                    
        <div class="content">
          <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-check"></i> Alert!</h5>
              {{ session('status') }}
            </div>
          </div>
        </div>
    @endif

    @if (session('error'))                    
        <div class="content">
          <div class="container-fluid">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              {{ session('error') }}
            </div>
          </div>
        </div>
    @endif    
    <!-- end notif -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">        
        
        <div class="row">          
          
          <div class="col-lg-12">          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <div class="card-body">                
                <form action="{{ url('adminpanel/change_password') }}" method="post">
                  @method('patch')
                  @csrf
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Password Lama</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="old_password" value="" placeholder="Password Lama" required>                      
                      @error('old_password')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="new_password" value="" placeholder="Password Baru" required>                      
                      @error('new_password')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="confirm_password" value="" placeholder="Konfirmasi Password" required>                      
                      @error('confirm_password')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>                                                                 

                  <div class="form-group row">
                    <div class="col-sm-8 offset-sm-3">
                      <input type="submit" class="btn btn-primary" value="Save Changes">
                    </div>                    
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->          
          </div>

          
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>  
  <!-- /.content-wrapper -->

@endsection

@section('js')
<!-- jQuery -->
<script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>
@endsection