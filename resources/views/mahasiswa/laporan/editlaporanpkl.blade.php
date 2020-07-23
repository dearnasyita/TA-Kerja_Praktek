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
              <li class="breadcrumb-item active">Edit Laporan PKL</li>
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
              <h3 class="card-title">Edit Laporan PKL</h3>
            </div>
            <!-- /.card-header -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form id="editlaporanpkl" enctype="multipart/form-datta">
                            {{ csrf_field() }}
                            <!-- <input type="hidden" name="id_laporan" id="id_laporan" value="{{ $data->id_laporan }}"> -->

                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label for="judul" class="col-sm-3 col-form-label">Judul Laporan</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $data->judul }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="berkas" class="col-sm-3 col-form-label">Pilih Berkas</label>
                                        <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6">     
                                            <div class="form-group">
    					                    <input type="file" class="form-control required" id="berkas" name="berkas">
                                            <p class="text-muted"><small><i>*Dalam bentuk PDF, max ukuran 10 MB</i></small></p>
					                        </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" class="form-control" id="id_laporan" name="id_laporan" value="{{ $data->id_laporan }}" >
                                    <input type="hidden" class="form-control" id="id_kelompok" name="id_kelompok" value="{{ $idKelompok->id_kelompok}}" >                          

                                  <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                      <a href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>                                      
                                    </span>
                                    <span>
                                      <button type="submit" class="btn btn-primary" id="submit" > Save </button>
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

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<script >
$(document).ready(function(){   
    $('#editlaporanpkl').on('submit', function(e){
        e.preventDefault();
        var id = $('#id_laporan').val();
        // var judul = $('#judul').val();
        // var berkas = $('#berkas').val();
        
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/editlaporanpkl/"+id+"/edit",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                window.location = "/mahasiswa/laporanpkl";
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
            },
            error: function(xhr, status, error) 
            {
              $.each(xhr.responseJSON.errors, function (key, item) 
              {
                // $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 200;
                toastr.error(item);
              });
            }
        });
    });
});
</script>

@endsection