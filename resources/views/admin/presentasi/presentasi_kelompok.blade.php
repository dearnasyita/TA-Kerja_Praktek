@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Jadwal Presentasi</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kelompok</li>
              <li class="breadcrumb-item active">Presentasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body ">
                <form role="form">
                  <div class="col-sm-4">
                    <p>Pilih Periode</p>
                      <!-- select -->
                      <div class="form-group">
                          <select class="form-control form-control-sm">
                            <option>2019</option>
                            <option>2018</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-default">Filter</button> <br><br>
                  </div>
                  <div class="col-sm-12">
                  <a href="/add_presentasi" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Jadwal</a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Nama Kelompok</th>
                  <th>Periode</th>
                  <th>Dosen Pembimbing</th>
                  <th>Dosen Penguji</th>
                  <th>Waktu</th>
                  <th>Ruang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>2019</td>
                  <td>Imam Fakhrurrozi, M.Cs</td>
                  <td>Irkham Huda, M.Cs</td>
                  <td>Senin, 2 September 2019 12:00</td>
                  <td>Lab Techno</td>
                  <td class="text-center py-0 align-middle">
                      <a href="/edit_presentasi" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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