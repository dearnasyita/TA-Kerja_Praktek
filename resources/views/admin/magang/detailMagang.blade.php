@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kelompok</li>
                <li class="breadcrumb-item active">Detail Magang</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <h4>Kelompok ASIK</h4><br>
                <div>
                    <b>Dosen Pembimbing &emsp; : </b> &emsp; <a href="">Imam Fakhrurrozi, M.Cs</a><br/>
                    <b>Tempat Magang &emsp; : </b> &emsp; PT. GMF AeroAsia Tbk<br/>
                    <b>Mentor &emsp; : </b> &emsp; <a href=""> Adji Bowo</a> <br/>
                    <b>Waktu Magang &emsp; : </b> &emsp; 24 Juni 2019 - 10 Agustus 2019<br/>
                    <b>Lokasi Magang &emsp; : </b> &emsp; <br/>
                    <b>Jobdesk &emsp; : </b> &emsp; 

                </div>
                <!-- <div class="row">
                    <div class="col-sm-2"><b>Tempat Magang&emsp;: </b></div>
                    <div class="col-sm-4"> PT. GMF AeroAsia Tbk</div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><b>Mentor&emsp; &emsp; &emsp;: </b></div>
                    <div class="col-sm-4"> PT. GMF AeroAsia Tbk</div>
                </div> -->
                <br>
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>No.HP</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0
                  </td>
                  <td>Win 95+</td>
                  <td>Ketua</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 5.0
                  </td>
                  <td>Win 95+</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 5.5
                  </td>
                  <td>Win 95+</td>
                  <td>Anggota</td> 
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                      </div>
                    </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection