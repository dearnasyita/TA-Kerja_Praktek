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
              <li class="breadcrumb-item active">Edit Laporan Harian</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Laporan Harian</h3>
          </div>
          <!-- /.card-header -->
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-8">
                <form id="editlaporanharian">
                  <input type="hidden" name="id_buku_harian" id="id_buku_harian" value="{{ $data->id_buku_harian }}">
                  <div class="card-body">
                    <div class="form-group row">
                    <label for="Tanggal" class="col-sm-3 col-form-label">Tanggal <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}">
                      </div>
                    </div>
                    </br>
                    <div class="form-group row">
                      <label for="waktu_mulai" class="col-sm-3 col-form-label">Waktu Mulai <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="{{ $data->waktu_mulai }}">
                      </div>
                    </div>
                    </br>
                    <div class="form-group row">
                      <label for="waktu_selesai" class="col-sm-3 col-form-label">Waktu Selesai <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="{{ $data->waktu_selesai}}">
                      </div>
                    </div>
                    </br>
                    <div class="form-group row">
                      <label for="kegiatan" class="col-sm-3 col-form-label">Kegiatan <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <textarea type="text" class="form-control" id="kegiatan" name="kegiatan">{{ $data->kegiatan}}</textarea>
                      </div>
                    </div>
                    </br>            
                    <input type="hidden" class="form-control" id="id_mahasiswa" name="id_mahasiswa" value="{{ $data->id_mahasiswa}}" >
                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <a href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a></span>
                        <span>
                          <button type="submit" class="btn btn-primary" id="submit" > Save </button>
                        </span>
                      </div>
                      </div> 
                    </div>
                  </div>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
@endsection


@section('scripts')

<!-- jQuery -->
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<script >
$(document).ready(function(){   
    $('#editlaporanharian').on('submit', function(e){
        e.preventDefault();
        var id = $('#id_buku_harian').val();
        var tanggal = $('#tanggal').val();
        var waktu_mulai = $('#waktu_mulai').val();
        var waktu_selesai = $('#waktu_selesai').val();
        var kegiatan = $('#kegiatan').val();

        $.ajax({
            type: "PUT",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/editlaporanharian/"+id+"/edit",
            cache:false,
            dataType: "json",
            data: $('#editlaporanharian').serialize(),
            success: function(data){
                window.location = "/mahasiswa/laporanharian";
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
                toastr.options.closeDuration = 200;
                toastr.error(item);
              });
            }
        });
    });
});
</script>

@endsection