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
            <h1 class="m-0 text-dark">Items Page</h1>
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
              <h5>Ini Adalah Menu Kelola Barang!</h5>  
              <p>Menu ini digunakan untuk Mengelola Barang.</p>
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
                <h3 class="card-title">Create Items</h3>
              </div>
              <div class="card-body">                
                <form action="{{ url('adminpanel/items') }}" method="post" enctype="multipart/form-data">                  
                  @csrf
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="NAME_ITEMS" value="{{ old('NAME_ITEMS') }}" placeholder="Nama Barang" required>                      
                      @error('NAME_ITEMS')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Gambar Utama (550X750)</label>
                    <div class="col-sm-8">                      
                      <input type="file" name="HEAD_PICTURE_ITEMS" accept="image/png, image/jpeg, image/jpg" value="{{ old('HEAD_PICTURE_ITEMS') }}" required>                                            
                      @error('HEAD_PICTURE_ITEMS')
                        <br>
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror  
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Harga Beli</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="PURCHASE_PRICE_ITEMS" value="{{ old('PURCHASE_PRICE_ITEMS') }}" placeholder="Harga Beli" required>
                      @error('PURCHASE_PRICE_ITEMS')
                        <code>
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>
                
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Harga Jual</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="SELLING_PRICE_ITEMS" value="{{ old('SELLING_PRICE_ITEMS') }}" placeholder="Harga Jual" required>                             
                      @error('SELLING_PRICE_ITEMS')
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>         

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Berat (gram)</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="WEIGHT_ITEMS" value="{{ old('WEIGHT_ITEMS') }}" placeholder="Berat (gram)" required>                             
                      @error('WEIGHT_ITEMS')
                        <code>  
                            {{ $message }}
                        </code>
                      @enderror
                    </div>                    
                  </div>         

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Deskripsi Barang</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" name="DESCRIPTION_ITEMS" rows="4" placeholder="Deskripsi Barang"></textarea>
                      @error('DESCRIPTION_ITEMS')
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