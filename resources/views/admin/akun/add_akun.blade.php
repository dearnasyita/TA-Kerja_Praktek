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
                <li class="breadcrumb-item active">Daftar Akun</li>
                <li class="breadcrumb-item active">Add</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                          <div class="card-body">
                              <form action="{{ route('users.store') }}" method="post">
                              {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="nama_lengkap" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="teusernamext" class="col-sm-3 col-form-label">Username*</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="username" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password *</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Confirm Password *</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" required name="password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="roles_id" class="col-sm-3 col-form-label">Role *</label>
                                        <div class="col-sm-9">
                                          <select name="roles_id" class="form-control select2" style="width: 100%;">
                                              <option selected disabled>Pilih Role</option>
                                              @foreach($roles as $role)
                                              <option value="{{ $role->id_roles }}">{{ $role->nama }}</option>
                                              @endforeach
                                          </select >
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Cancel" />
                                        </span>
                                        <span>
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        </span>
                                   </div><br>
                                </form>
                                <div class="row justify-content-center">
                                  <p class="text-center">-- ATAU --</p>
                                  <img src="{{ asset('images/contohisian.png') }}">
                                </div><br>
                                <div class="row justify-content-center">
                                  <div class="col-md-6">
                                    <a style="display: block;" href="" class="btn btn-sm btn-primary">Download Format Excel Disini</a>
                                  </div>
                                </div><br>
                                  <p>
                                    <span class="badge badge-danger">1</span> Setelah dowload format Excel diatas, pastikan Anda telah mengisikan data dengan benar.
                                  </p>
                                  <p>
                                    <span class="badge badge-danger">2</span> Unggah file Excel yang berisi data user yang akan ditambahkan, pada form input file dibawah ini.
                                  </p>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <input type="file" class="form-control required" id="excel" name="excel">
                                      </div>
                                      <input type="submit" class="btn btn-primary" value="Import dari Excel">
                                    </div>
                                  </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
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
<!-- Summernote -->

@endsection