@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Kelompok</h4>
          </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Buat Kelompok</li>
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
            <h3 class="card-title">Buat Kelompok</h3>
          </div>

          <div class="card-body">
            <form id="kelompokForm" >             
              <div class="col-sm-12">
                <div class="form-group row justify-content-center">
                  <div class="col-sm-12">
                    <a  href="/indexkelompok/" class="btn btn-info float-right btn-sm" ><i class="fas fa-arrow-right"> </i> Cek Riwayat Kelompok </a> <br><br>
                  </div>
                  @if(@$status->tahap!="diproses" && @$status->tahap!="diterima" || $idKelompok->isDeleted == 1)
                  <label for="nama_kelompok" class="col-sm-2 col-form-label">Nama Kelompok <font color="red">*</font> </label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" >
                  <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{$userId}}">
                  <input type="hidden" class="form-control" id="id_mahasiswa" name="id_mahasiswa" value="{{$idMahasiswa->id_mahasiswa}}">
                  @else
                  <label class="col-sm-12 col-form-label row justify-content-center"><i class="text-muted">Anda sudah punya Kelompok</i></label>
                  @endif
                  </div>
                </div>
              </div>
            @if(@$status->tahap!="diproses" && @$status->tahap!="diterima" || $idKelompok->isDeleted == 1)
              <div class="col-sm-12">
                <div class="d-flex flex-row justify-content-end">
                  <button type="submit" class="btn btn-primary float-right">Create</button>
                </div> 
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>     
    </section>
  </div>
    <!-- /.row -->
@endsection

@section('scripts')
<!-- page script -->
<script>

  $('#kelompokForm').on('submit', function(e){
      e.preventDefault();
      nama_kelompok = $('#nama_kelompok').val();
      id_mahasiswa = $('#id_mahasiswa').val();
      created_by = $('#created_by').val();

      $.ajax({
          type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/mahasiswa/kelompok/namakelompok",
          cache:false,
          dataType: "json",
          data: {'nama_kelompok': nama_kelompok, 'id_mahasiswa': id_mahasiswa, 'created_by': created_by},
          success: function(data){
              console.log(data);
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              window.location = "/mahasiswa/buatkelompok/";
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


</script>
@endsection