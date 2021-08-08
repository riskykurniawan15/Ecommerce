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
            <h1 class="m-0 text-dark">Transaction Page</h1>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Show Data Transaksi</h3>
              </div>
              <div class="card-body">                
                <form action="{{ url('adminpanel/transactions/'.$transaction->ID_TRANSACTIONS).'/show' }}" method="post">                  
                  @csrf                
                  <input type="hidden" name="kode" value="{{ md5(crypt($transaction->CODE_TRANSACTIONS,$transaction->created_at)) }}">
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Kode Transaksi</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="{{ $transaction->CODE_TRANSACTIONS }}" placeholder="Kode Transaksi" readonly>                                            
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Penerima</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="{{ $transaction->RECIPIENT_TRANSACTIONS.' ('.$transaction->CONTACT_RECIPIENT_TRANSACTIONS.')' }}" placeholder="Penerima" readonly>                                            
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Kurir Pengiriman</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="{{ $transaction->COURIER_TRANSACTIONS }}" placeholder="Kurir" readonly>                                            
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Alamat Pengiriman</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="4" placeholder="Deskripsi Barang" readonly>{{ $transaction->SHIPPING_ADDRESS_TRANSACTIONS }}</textarea>                      
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Rincian Biaya</label>
                    <div class="col-sm-8">
                      <table class="table table-bordered">
                        <thead>                  
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $total = 0; ?>
                          @foreach(DB::table('detail_transactions')->where('ID_TRANSACTIONS', $transaction->ID_TRANSACTIONS)->get() as $dt)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ DB::table('items')->where('ID_ITEMS', $dt->ID_ITEMS)->pluck('NAME_ITEMS')->first() }}</td>
                            <td>@currency($dt->PRICE_ITEMS_TRANSACTIONS)</td>                            
                            <td>{{ $dt->QUANTITY_ITEM_DETAIL_TRANSACTIONS }}</td>                            
                            <td>@currency($dt->PRICE_ITEMS_TRANSACTIONS*$dt->QUANTITY_ITEM_DETAIL_TRANSACTIONS)</td>                            
                          </tr>  
                          <?php $total += $dt->PRICE_ITEMS_TRANSACTIONS * $dt->QUANTITY_ITEM_DETAIL_TRANSACTIONS; ?> 
                          <?php $no = $loop->last; ?>
                          @endforeach                
                          <tr>
                            <td>{{ $no+1 }}</td>
                            <td colspan="3">{{ $transaction->COURIER_TRANSACTIONS }}</td>
                            <td>@currency($transaction->SHIPPING_COSTS_TRANSACTIONS)</td>
                            <?php $total += $transaction->SHIPPING_COSTS_TRANSACTIONS; ?>
                          </tr>
                          <tr>
                            <td colspan="4">Total</td>
                            <td>@currency($total)</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Bukti transaksi</label>
                    <label class="col-sm-8 col-form-label">
                      untuk lihat bukti transaksi klik <a href="{{ url('assets/img/payment/'.$transaction->PROOF_OF_PAYMENT_TRANSACTIONS) }}" target="_blank">disini</a>.
                    </label>
                  </div>

                  @if($transaction->STATUS_TRANSACTIONS=="Waiting for confirmation")
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Konfirmasi</label>
                    <div class="col-sm-8">
                      <select class="form-control select2" name="confirm" style="width: 100%;">
                        <option value="1" selected="selected">Konfirmasi Pesanan dan masukan ke daftar pengemasan</option>
                        <option value="0" >Minta Konfirmasi Ulang</option>                
                      </select>                      
                    </div>                    
                  </div>
                  @elseif($transaction->STATUS_TRANSACTIONS=="Confirmed and is being packed" || $transaction->STATUS_TRANSACTIONS == "Item Shipped")
                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Dikonfirmasi oleh</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="{{ DB::table('users')->where('id', $transaction->ID_USERS)->pluck('name')->first() }}" readonly>                                            
                    </div>                    
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 offset-sm-1 col-form-label">Kode Resi Pengiriman</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="resi" value="{{ $transaction->RECEIPT_CODE_TRANSACTIONS }}" placeholder="Resi Pengiriman" required>
                    </div>                    
                  </div>
                  @endif

                  <div class="form-group row">
                    <div class="col-sm-8 offset-sm-3">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin untuk menyimpan data?');">Save Changes</button>
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