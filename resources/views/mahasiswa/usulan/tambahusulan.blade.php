@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Tambah Usulan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Usulan</h3>
            </div>
            <!-- /.card-header -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-10">
                          <form id="usulanForm" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Instansi <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="website_instansi" class="col-sm-3 col-form-label">Website  <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="website_instansi" name="website_instansi" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="alamat_instansi" class="col-sm-3 col-form-label">Alamat  <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat_instansi" name="alamat_instansi" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="jobdesk" class="col-sm-3 col-form-label">Jobdesk  <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <textarea type="text" class="form-control" id="jobdesk" name="jobdesk" rows="5" maxlength="1000" placeholder="Penjelasan singkat jobdesk saat kerja praktik " ></textarea>
                                          <p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="deskripsi_instansi" class="col-sm-3 col-form-label">Deskripsi  <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                          <textarea type="text" class="form-control" id="deskripsi_instansi" name="deskripsi_instansi" rows="5" maxlength="1000" placeholder="Penjelasan singkat tentang instansi"></textarea>
                                          <p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="surat" class="col-sm-3 col-form-label">Surat Pemberitahuan  <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                        <input type="file" class="form-control" id="surat" name="surat">
                                          <p class="text-muted"><small><i>*Dalam format PDF. Max ukuran 3 MB</i></small></p>
                                        </div>
                                    </div>

                                    
                                    <input type="hidden" class="form-control" id="id_kelompok" name="id_kelompok" value="{{ $idKelompok->id_kelompok}}" >
                                    <input type="hidden" class="form-control" id="id_periode" name="id_periode" value="{{ $periode->id_periode }}" >                          
                                    <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{$userId}}">                          
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                          <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
                                        </span>
                                        <span>
                                          <button type="submit" class="btn btn-primary" id="submit">Save</button>
                                        </span>
                                    </div>
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
    
@endsection

@section('scripts')

<!-- page script -->
<script>
  $(document).ready(function(){   
    $('#usulanForm').on('submit', function(e){
        e.preventDefault();
        // var judul = $('#judul').val();
        // var berkas = $('#berkas').val();
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/usulan/tambahusulan",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            // data: $('#laporanakhirForm').serialize(),
            success: function(data){
                window.location = "/mahasiswa/indexusulan/";
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
            },
            error: function(xhr, status, error) 
            {
              $.each(xhr.responseJSON.errors, function (key, item) 
              {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.error(item);
              });
            }
        });
    });
  });
</script>

@endsection