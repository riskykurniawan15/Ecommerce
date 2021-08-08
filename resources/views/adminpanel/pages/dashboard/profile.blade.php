@extends('adminpanel')

@section('css')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
            <h1 class="m-0 text-dark">Profile Page</h1>
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
              <h5>Ini Adalah Menu Profile!</h5>  
              <p>Menu ini digunakan untuk mengelola Profile Pengguna.</p>
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
    <!-- end notif -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">        
        
        <div class="row">          
          
          <div class="col-lg-12">          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile</h3>
              </div>
              <div class="card-body">                
                <form action="{{ url('adminpanel/profile') }}" method="post">
                  @method('patch')
                  @csrf
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Email Aktif</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email Aktif" required>                      
                      @error('email')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap" required>
                      @error('name')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>
                
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Kontak</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="contact" value="{{ Auth::user()->contact }}" required>                             
                      @error('contact')
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>         

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                      <select class="form-control select2" name="gender" style="width: 100%;">
                        <option {{ Auth::user()->gender == 'Laki - Laki' ? 'selected="selected"' : null }}>Laki - Laki</option>
                        <option {{ Auth::user()->gender == 'Perempuan' ? 'selected="selected"' : null }}>Perempuan</option>                
                      </select>                      
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
<!-- Select2 -->
<script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>
<script>
  $(function () {    
    $('.select2').select2()
    $('[data-mask]').inputmask()
  });
</script>
@endsection