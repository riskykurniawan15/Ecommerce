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
            <h1 class="m-0 text-dark">Configs Page</h1>
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
              <h5>Ini Adalah Menu Kelola Data Configurasi!</h5>  
              <p>Menu ini digunakan untuk Mengelola Configurasi.</p>
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
                <h3 class="card-title">Configurasi Aplikasi</h3>
              </div>
              <div class="card-body">                
                  
                  <form action="{{ url('adminpanel/configs') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Brand Perusahaan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="BRAND_ECOMMERCE" value="{{ DB::table('configs')->where('NAME_CONFIG', 'BRAND_ECOMMERCE')->pluck('VALUE')->first() }}" required>
                      @error('BRAND_ECOMMERCE')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <?php
                  $logo = DB::table('configs')->where('NAME_CONFIG', 'LOGO')->pluck('VALUE')->first();
                  if ($logo == "") {
                    $logo = "default.png";
                  }
                  ?>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Logo</label>
                    <div class="col-sm-8">                      
                      <input type="file" accept="image/png, image/jpeg, image/jpg" name="LOGO" value="{{ $logo }}">
                      <code>
                        untuk lihat gambar klik <a href="{{ url('assets/img/logo/'.$logo) }}" target="_blank">disini</a>.
                      </code>
                      @error('LOGO')
                        <br>
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror                      
                    </div>                    
                  </div>

                  <?php 
                  $icon = DB::table('configs')->where('NAME_CONFIG', 'ICON')->pluck('VALUE')->first();
                  if ($icon == "") {
                    $icon = "default.png";
                  }
                  ?>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Icon</label>
                    <div class="col-sm-8">                      
                      <input type="file" accept="image/png, image/jpeg, image/jpg" name="ICON" value="{{ $icon }}">
                      <code>
                        untuk lihat gambar klik <a href="{{ url('assets/img/icon/'.$icon) }}" target="_blank">disini</a>.
                      </code>
                      @error('ICON')
                        <br>
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror                      
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Deskripsi Aplikasi</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" name="DESCRIPTION" rows="4">{{ DB::table('configs')->where('NAME_CONFIG', 'DESCRIPTION')->pluck('VALUE')->first() }}</textarea>
                      @error('DESCRIPTION')
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Email Aplikasi</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" name="EMAIL" value="{{ DB::table('configs')->where('NAME_CONFIG', 'EMAIL')->pluck('VALUE')->first() }}" required>                      
                      @error('EMAIL')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Wilayah</label>
                    <div class="col-sm-8">
                      <select class="form-control select2" name="ORIGIN" style="width: 100%;">                       
                        @foreach ($city['results'] as $value) 
                          @if($value['city_id'] == DB::table('configs')->where('NAME_CONFIG', 'ORIGIN')->pluck('VALUE')->first())                          
                          <option value="{{ $value['city_id'] }}" selected>{{ $value['type'] . ' ' . $value['city_name'] . ' (' . $value['province'] . ')' }}</option>
                          @else
                          <option value="{{ $value['city_id'] }}">{{ $value['type'] . ' ' . $value['city_name'] . ' (' . $value['province'] . ')' }}</option>
                          @endif
                        @endforeach      
                      </select>                      
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" name="ADDRESS" rows="4">{{ DB::table('configs')->where('NAME_CONFIG', 'ADDRESS')->pluck('VALUE')->first() }}</textarea>
                      @error('ADDRESS')
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Kontak Aplikasi</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="CONTACT" value="{{ DB::table('configs')->where('NAME_CONFIG', 'CONTACT')->pluck('VALUE')->first() }}" required>                      
                      @error('CONTACT')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Instagram</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="INSTAGRAM" value="{{ DB::table('configs')->where('NAME_CONFIG', 'INSTAGRAM')->pluck('VALUE')->first() }}" required>                      
                      @error('INSTAGRAM')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Facebook</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="FACEBOOK" value="{{ DB::table('configs')->where('NAME_CONFIG', 'FACEBOOK')->pluck('VALUE')->first() }}" required>                      
                      @error('FACEBOOK')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">No Rekening</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="NOREK" value="{{ DB::table('configs')->where('NAME_CONFIG', 'NOREK')->pluck('VALUE')->first() }}" required>                      
                      @error('NOREK')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Atas Nama</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="NAME_NOREK" value="{{ DB::table('configs')->where('NAME_CONFIG', 'NAME_NOREK')->pluck('VALUE')->first() }}" required>                      
                      @error('NAME_NOREK')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Bank</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="BANK" value="{{ DB::table('configs')->where('NAME_CONFIG', 'BANK')->pluck('VALUE')->first() }}" required>                      
                      @error('BANK')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Api Raja Ongkir</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="API_RAJA_ONGKIR" value="{{ DB::table('configs')->where('NAME_CONFIG', 'API_RAJA_ONGKIR')->pluck('VALUE')->first() }}" required>                      
                      @error('API_RAJA_ONGKIR')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>                  

                  <div class="form-group row">
                    <div class="col-sm-8 offset-sm-3">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
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