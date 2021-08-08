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
            <h1 class="m-0 text-dark">Dashboard Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">            
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Selamat Datang dan kebijakan privasi</h3>

                      <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>                        
                      </div>
                  </div>
                  <div class="card-body">
                  Aplikasi ini dibuat oleh Risky Kurniawan (16180001) <br>
                  Aplikasi ini ditujukan untuk memenuhi tugas WEB Programming 3 <br>                  
                  Hubungi saya melalui instagram di <a target="_blank" href="http://instagram.com/risky_kurniawanz">risky_kurniawanz</a>
                  </div>
                  <!-- /.card-body -->                
              </div>
              <!-- /.card -->
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">Thanks to</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title">Special For</h6>

                  <p class="card-text">
                    Allah SWT <br>
                    Nabi Muhammad SAW <br>
                    Kedua Orang Tua <br>
                    ARS University <br>
                    Dosen Pembimbing Bapak Rangga Sanjaya, M.Kom<br>
                    Admin LTE Template <br>
                    Laravel <br>
                    XAMPP <br>
                    Dan semuanya yang ikut membantu pembuatan aplikasi
                  </p>
                  <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->            
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
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>
@endsection