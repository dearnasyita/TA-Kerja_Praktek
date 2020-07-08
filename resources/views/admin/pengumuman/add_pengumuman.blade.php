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
                <li class="breadcrumb-item active">Pengumuman</li>
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
            @if (session('error'))
                @alert(['type' => 'danger'])
                    {!! session('error') !!}
                @endalert
            @endif
                <form action="{{ route('pengumuman.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul *</label>
                            <input type="text" name="judul" id="judul" required  class="form-control {{ $errors->has('judul') ? 'is-invalid':'' }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Detail *</label>
                            <textarea name="deskripsi" id="deskripsi" required class="form-control {{ $errors->has('detail') ? 'is-invalid':'' }}"></textarea>
                            <p class="text-danger">{{ $errors->first('detail') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                            <div class="input-group">
                            <div class="custom-file">
                            <input type="file" name="lampiran" id="lampiran" class="form-control" >
                            <!-- <input type="file" class="custom-file-input" id="exampleInputFile"> -->
                            <label class="custom-file-label" for="lampiran">Choose file</label>
                            <p class="text-danger">{{ $errors->first('lampiran') }}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="submit" class="btn btn-danger">Cancel</button>
                          </span>
                          <span>
                          <button type="submit" class="btn btn-primary">Submit</button>
                          </span>
                      </div>
                    </div>
                </form>
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
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<!-- Summernote -->

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection