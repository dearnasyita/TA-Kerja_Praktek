@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
              <li class="breadcrumb-item active">Daftar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Profile Image -->
                        <!-- <form id="laporanakhirForm"> -->
                        <form id="lamar">
                            
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <div class="text-center">
                            <img  class="img" style="object-fit: cover;" width="100px" height="100px"  src="{{ asset('uploads/fotoprofile/'.$lowongan->instansi->foto) }}" onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';" >

                            </div>
                            </br>


                            <div class="proyek-title text-center"><h4><b>{{ $lowongan->instansi->nama }}</b></h4> 
                            <p class="text-center "><i class="fa fa-home" style="color: #000000"></i> {{ $lowongan->instansi->alamat }}</p>
                            </br>
                            </br>
                            <p class="text-left"><b>Posisi :</b>{{ $lowongan->pekerjaan}}</p>
                            <p class="text-left"><b>Persyaratan :</b> {{ $lowongan->persyaratan }}</p>
                            </br></br>
                            <h5><b>Kapasitas </b><span class="badge badge-info">{{ $lowongan->kapasitas }} Slot</span></h5>
                            <p><span class="breadcrumb-item active">{{ $lowongan->slot }} Slot Tersisa</span></p>
                            </div>
                            </br>
                            <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ $userId}}" >
                            <input type="hidden" class="form-control" id="id_kelompok" name="id_kelompok" value="{{ $idKelompok->id_kelompok}}" >
                            <input type="hidden" class="form-control" id="id_lowongan" name="id_lowongan" value="{{ $lowongan->id_lowongan}}" >
                            
                            @if ($statusKeanggotaan!=null && @$statusKeanggotaan->status_keanggotaan == 'Ketua' && ($statusUsulan==null || @$statusUsulan->status=="ditolak") && ($statusLamaran==null || @$statusLamaran->status=="ditolak"))
                            <div class="d-flex flex-row justify-content-center">
                              <span>
                              <button type="submit" class="btn btn-block btn-success btn-lg">Daftar</button>
                              </span>
                            </div>
                            @else
                            <div class="d-flex flex-row justify-content-center">
                              <span>
                              <a href="#" class="btn btn-block btn-success btn-lg disabled">Daftar</a>
                              </span>
                            </div>
                            @endif
                          </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    </form>
                        <!-- /.card -->
                  </div>
    </section>
@endsection

@section('scripts')
<!-- page script -->
<script>
  $(document).ready(function(){   
    $('#lamar').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/lowongan/applylowongan",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                window.location = "/mahasiswa/lamaran/";
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