@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Persetujuan Usulan</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Persetujuan</li>
              <li class="breadcrumb-item active">Usulan</li>
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
              <div class="col-sm-12">
                  <a href="/add_form_pengumuman" class="btn btn-primary float-right btn-sm"><i class="fas fa-download"></i> &nbsp; Export to Excel</a> <br><br>
                </div>
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Nama Kelompok</th>
                  <th>Dosen Pembimbing</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_usulan" class="btn-sm btn-info"><i class="fa fa-arrow-right"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fa fa-arrow-right"></i></a>
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