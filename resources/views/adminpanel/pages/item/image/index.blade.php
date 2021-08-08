@extends('adminpanel')

@section('css')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
            <h1 class="m-0 text-dark">Item Images Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">            
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
              <h5>Ini Adalah Menu Kelola Gambar Barang!</h5>  
              <p>Menu ini digunakan untuk Mengelola Gambar Barang.</p>
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
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title">Upload Gambar</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">                
                      <form action="{{ url('adminpanel/items/'.$item->ID_ITEMS.'/upload') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                          <label class="col-sm-2 offset-sm-1 col-form-label">Gambar (569 X 528)</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="NAME_ITEM_IMAGES" accept="image/png, image/jpeg, image/jpg" id="exampleInputFile" required>
                                <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                              </div>
                              <div class="input-group-append">
                                <input type="submit" class="input-group-text" value="Upload">                                
                              </div>
                            </div>
                          </div>                    
                        </div>                            

                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">              
              
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Gambar Barang [{{ $item->NAME_ITEMS.' - '.$item->CODE_ITEMS }}]</h3>
                    <div class="card-tools">                  
                        <a href="{{ url('adminpanel/items') }}" class="btn btn-default btn-sm"> << Kembali</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:50px !important;">No</th>
                            <th>Nama File</th>
                            <th style="width:350px !important;">Gambar File</th>
                            <th style="width:100px !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item_images as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a target="_blank" href="{{ url('assets/img/items/images/'.$data->NAME_ITEM_IMAGES) }}">{{ $data->NAME_ITEM_IMAGES }}</a>                                
                            </td>
                            <td>
                                <img src="{{ url('assets/img/items/images/'.$data->NAME_ITEM_IMAGES) }}" width="300px">
                            </td>
                            <td>
                              <form action="{{ url('adminpanel/items/'.$data->ID_ITEM_IMAGES.'/drop') }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah anda yakin untuk menghapus data?');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                              </form>                            
                            </td>
                        </tr>  
                        @endforeach                  
                    </tfoot>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
              
            </div>
            <!-- /.col-md-12 -->            
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
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
<!-- bs-custom-file-input -->
<script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
@endsection