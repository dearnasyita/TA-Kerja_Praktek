@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Dashboard</h4>
          </div>
            
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
    <div class="col-md-12 text-center">
      @if (!empty($periode))
        <p><h2>Periode Kerja Praktek Komsi <strong>{{$periode->tahun_periode}}</strong></h2><i class="text-muted">{{$date}}</i></p>
      @else
        <p><h2>Periode KP <strong>tidak aktif</strong></h2></p>
      @endif
          <div class="row justify-content-center">
              <div class="col-md-6 col-md-offset-3 text-center">
                  <div class="alert alert-success alert-dismissible">
                  @if (!empty($periode))
                    <i class="icon fas fa-calendar"></i> Saat ini adalah periode Kerja Praktek.
                    <h3><b>{{Carbon\Carbon::parse($periode->tgl_mulai)->translatedFormat('d F Y')}}</b> - <b>{{Carbon\Carbon::parse($periode->tgl_selesai)->translatedFormat('d F Y')}}</b></h3>
                  @else
                  <i class="icon fas fa-calendar"></i> Saat ini tidak ada periode Kerja Praktek yang aktif .
                  @endif
                  </div>
              </div>
          </div>
          <br>
      </div>
		</div>


    <div class="row justify-content-center">
      <div class="col-md-4 col-md-offset-4">
        <div class="small-box bg-info">
          <div class="inner" id="kelompokcount">
            <!-- <h3>3<sup style="font-size: 20px"> Mahasiswa</sup></h3>
            <p>Dalam kelompok <b>Anda</b></p> -->
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/mahasiswa/detailkelompok" class="small-box-footer">Cek List Kelompok PKL <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Buku Harian</h3>
            <p> Isi <b>Buku Harian</b></p>
          </div>
          <div class="icon">
            <i class="ion ion-clipboard"></i>
          </div>
          <a href="/mahasiswa/laporanharian" class="small-box-footer">Isi Buku Harian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  
  $(document).ready(function(){
    $.ajax({
      type: 'GET',
      url: '/api/mahasiswa/jumlahmahasiswa',
      dataType: 'JSON',
      headers: {
          Authorization : 'Bearer {{Auth::user()->api_token}}',
      },
      success: function (response) {
        
        var kel = "<h3>"+response.jumlah+"<sup style='font-size: 20px'>Mahasiswa</sup></h3>"+
        "<p>Dalam kelompok <b>Anda</b></p>";
        $("#kelompokcount").append(kel);
      }
    });
  });
</script>
@endsection