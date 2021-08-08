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
            <h1 class="m-0 text-dark">Users Page</h1>
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
              <h5>Ini Adalah Menu Kelola Users!</h5>  
              <p>Menu ini digunakan untuk Mengelola Users Pengguna.</p>
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
              
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Users</h3>
                    <div class="card-tools">                  
                        <a href="{{ url('adminpanel/users/create') }}" class="btn btn-primary btn-sm">Tambah Data +</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:50px !important;">No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th style="width:200px !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $data->name }}
                            </td>
                            <td>
                                {{ $data->email }}
                            </td>
                            <td>
                                {{ $data->contact }}
                            </td>
                            <td>
                            <div class="btn-group btn-group-sm">
                              <a href="{{ url('adminpanel/users/'.$data->id.'/edit') }}" class="btn btn-warning"><i class="fas fa-edit"></i> Ubah</a>
                              <a href="{{ url('adminpanel/users/'.$data->id.'/change_password') }}" class="btn btn-primary"><i class="fas fa-key"></i> Chage Pass</a>                              
                            </div>
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
@endsection