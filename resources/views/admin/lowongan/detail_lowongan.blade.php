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
                <li class="breadcrumb-item active">Lowongan</li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Lowongan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                        <p class="badge badge-info">Nama Lowongan</p>
                        <p>Fullstack Web</p>
                        </li>
                        <li class="list-group-item">
                        <p class="badge badge-info">Detail Info</p>
                        <p>Membuat Website menggunakan framework Laravel</p>
                        </li>
                        <li class="list-group-item">
                        <p class="badge badge-info">Instansi</p>
                        <p>PT. KAI</p>
                        </li>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-6">
                  <div class="card-primary card-outline">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered ">
                                <tr>
                                    <th>No</th>
                                    <th>Kelompok</th>
                                    <th class="text-center py-0 align-middle">Detail</th>
                                    <th class="text-center py-0 align-middle">Terima</th>
                                </tr>
                                <tr>
                                  <td>1</td>
                                  <td>ICON+</td>
                                  <td class="text-center py-0 align-middle">
                                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                                  </td>
                                  <td class="text-center py-0 align-middle">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>ICON+</td>
                                  <td class="text-center py-0 align-middle">
                                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                                  </td>
                                  <td class="text-center py-0 align-middle">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
                                  </div>
                                  </td>
                                </tr>
                        </table><br/>
                        <div class="d-flex flex-row justify-content-end">
                              <span class="mr-2">
                              <input type="submit" class="btn btn-danger" value="Cancel" />
                              </span>
                              <span>
                              <input type="submit" class="btn btn-primary" value="Submit" />
                              </span>
                          </div>
                    </div>
                  </div>
                </div>  
              </div>
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