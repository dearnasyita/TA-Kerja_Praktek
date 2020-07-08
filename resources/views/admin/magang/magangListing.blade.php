@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Daftar Kelompok</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kelompok</li>
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
                </form>
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Nama Kelompok</th>
                  <th>Periode</th>
                  <th>Dosen Pembimbing</th>
                  <th>Instansi</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>2019
                  </td>
                  <td>Win 95+</td>
                  <td>PT. GMF AeroAsia Tbk</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2019
                  </td>
                  <td>Win 95+</td>
                  <td>PT. KAI</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2019
                  </td>
                  <td>Win 95+</td>
                  <td>PT. Sabre</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2019
                  </td>
                  <td>Win 98+</td>
                  <td>PT. Asyst</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2019</td>
                  <td>Win XP SP2+</td>
                  <td>Gamatechno</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2019</td>
                  <td>Win XP</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2018</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2018</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2018</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Magang</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2018</td>
                  <td>Win 2k+ / OSX.3+</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Selesai</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2018</td>
                  <td>OSX.2+</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Selesai</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2018</td>
                  <td>OSX.2+</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
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