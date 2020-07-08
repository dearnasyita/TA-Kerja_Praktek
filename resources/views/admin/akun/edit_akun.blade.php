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
                <li class="breadcrumb-item active">Edit</li>
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
                            <form action="{{ route('users.update', $data->id_users) }}" method="post" >
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="nama_lengkap" value="{{ $data->nama_lengkap }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="teusernamext" class="col-sm-3 col-form-label">Username *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="username" value="{{ $data->username }}">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password *</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" value="{{ $data->password }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Confirm Password *</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" value="{{ $data->password }}">
                                        </div>
                                    </div> -->
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
                                    <div class="row justify-content-center">
                                      <a  data-toggle="modal" data-target="#modal-default">
                                        Change Password
                                      </a>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Cancel" />
                                        </span>
                                        <span>
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        </span>
                                   </div>
                                   <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Change Password</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password *</label>
                                            <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" value="{{ $data->password }}">
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                              <label for="password" class="col-sm-3 col-form-label">Confirm Password *</label>
                                              <div class="col-sm-9">
                                              <input type="password" class="form-control" name="password" value="{{ $data->password }}">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                  <!-- /.modal -->
                                </div>
                                <!-- /.card-body -->

                            </form>
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