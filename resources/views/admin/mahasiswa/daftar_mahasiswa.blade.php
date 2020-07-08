@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Mahasiswa</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa</li>
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
                <form role="form">
                  <div class="col-sm-4">
                    <p>Saring berdasarkan</p>
                      <!-- select -->
                      <div class="form-group">
                          <select class="form-control form-control-sm">
                            <option>Semua Periode</option>
                            <option>Periode 2019</option>
                            <option>option 2018</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-default">Filter</button> <br><br>
                  </div>
                </form>
                <div class="col-sm-12">
                  <a href="/add_form_pengumuman" class="btn btn-primary float-right btn-sm"><i class="fas fa-download"></i> &nbsp; Export to Excel</a> <br><br>
                </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>No.HP</th>
                  <th>Periode</th>
                  <th>Kelompok</th>
                  <th>Status</th>
                  <th>Status Magang</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $mahasiswa)
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>{{ $mahasiswa->nama_lengkap }}</td>
                  <td>08123456789</td>
                  <td>2019</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
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