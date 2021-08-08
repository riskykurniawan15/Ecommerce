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
            <h1 class="m-0 text-dark">Transaction Page</h1>
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
              <h5>Ini Adalah Menu Kelola Data Transaksi!</h5>  
              <p>Menu ini digunakan untuk Mengelola Data Transaksi.</p>
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
                    <h3 class="card-title">Data Transaksi</h3>
                    <div class="card-tools">                  
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn bg-olive active">
                                <a href="{{ url('adminpanel/transactions') }}">
                                    <input type="radio" name="options" id="option1" autocomplete="off"> Semua Data
                                </a>
                            </label>
                            <label class="btn bg-olive">
                                <a href="{{ url('adminpanel/transactions/Waiting for confirmation') }}">
                                    <input type="radio" name="options" id="option2" autocomplete="off"> Menunggu Konfirmasi
                                </a>
                            </label>
                            <label class="btn bg-olive">
                                <a href="{{ url('adminpanel/transactions/Confirmed and is being packed') }}">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> Daftar Pengemasan
                                </a>
                            </label>
                            <label class="btn bg-olive">
                                <a href="{{ url('adminpanel/transactions/Item Shipped') }}">
                                    <input type="radio" name="options" id="option4" autocomplete="off"> Barang Dikirim
                                </a>
                            </label>
                            <label class="btn bg-olive">
                                <a href="{{ url('adminpanel/transactions/Orders accepted') }}">
                                    <input type="radio" name="options" id="option5" autocomplete="off"> Barang Diterima
                                </a>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:50px !important;">No</th>
                            <th>Kode Transaksi</th>
                            <th>Pembeli</th>
                            <th>Pesanan</th>
                            <th>Status</th>
                            <th style="width:50px !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $data->CODE_TRANSACTIONS }}
                            </td>
                            <td>
                                {{ DB::table('customers')->where('id', $data->ID_CUSTOMERS)->pluck('name')->first() }}
                            </td>
                            <td>
                                @foreach(DB::table('detail_transactions')->where('ID_TRANSACTIONS', $data->ID_TRANSACTIONS)->get() as $dt)
                                {{ DB::table('items')->where('ID_ITEMS', $dt->ID_ITEMS)->pluck('NAME_ITEMS')->first() }} {{$dt->QUANTITY_ITEM_DETAIL_TRANSACTIONS}}x <br> 
                                @endforeach
                            </td>
                            <td>
                                {{ $data->STATUS_TRANSACTIONS }}
                            </td>
                            <td>                                
                                <a href="{{ url('adminpanel/transactions/'.$data->ID_TRANSACTIONS.'/show') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> view</a>
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