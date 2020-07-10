@extends('mahasiswa.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Penilaian Kelompok</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Penilaian Kelompok</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">

<div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penilaian Anggota Kelompok</h3>
            </div>
            <div class="card-body">
				<div class="box-body">
					<div class="col-md-12 text-center">
					<div class="col-md-1"> </div>
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <span class="badge badge-success"> 5 </span>
                                <br>Sangat Baik
                            </div>
							
                            <div class="col-md-2"> 
                                <span class="badge badge-primary"> 4 </span>
                                <br>Baik
                            </div>

                            <div class="col-md-2">
                                <span class="badge badge-warning"> 3 </span>
                                <br>Cukup
                            </div>
							<div class="col-md-2">
                                <span class="badge badge-danger"> 2 </span>
                                <br>Kurang
                            </div>
							
                            <div class="col-md-2">
                                <span class="badge badge-secondary"> 1 </span>
                                <br>Sangat Kurang
                            </div>
						</div>
                    </div>
                    <!-- form start -->
                    <br>
					<br>
					<form role="form" id="Penilaian" method="post">
					@csrf
					<input  type="hidden" name="id_kelompok_penilai" value="1">
					<input  type="hidden" name="id_mahasiswa" value="{{$anggota->id_mahasiswa}}"> 
					<input  type="hidden" name="created_by" value="{{$userId}}"> 

						<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
										<label for="fname">Nama Mahasiswa</label>
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Skill</label>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Kerapihan</label>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Sikap</label>
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Keaktifan</label>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Perhatian</label>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Kehadiran</label>
									</div>
								</div>
								
							</div>
							
							<!-- isi nilai -->
							<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
										<input style="text-align:center; background: transparent" type="text" class="form-control " id="nama" value="{{$anggota->nama}}" disabled  >
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input style="text-align:center" type="number" min="1" max="5" class="form-control " id="skill"  name="nilai[]" value="" required>
										<input style="text-align:center" type="hidden" name="id_aspek_penilaian[]" value="1" >
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input style="text-align:center" type="number" min="1" max="5" class="form-control required" id="kerapihan"  name="nilai[]" value="" required>
										<input style="text-align:center" type="hidden" name="id_aspek_penilaian[]" value="5">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input style="text-align:center" type="number" min="1" max="5" class="form-control required" id="sikap"  name="nilai[]" value="" required>
										<input style="text-align:center" type="hidden" name="id_aspek_penilaian[]" value="3">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input style="text-align:center" type="number" min="1" max="5" class="form-control required" id="keaktifan"  name="nilai[]" value=""required>
										<input style="text-align:center" type="hidden" name="id_aspek_penilaian[]" value="2">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input style="text-align:center" type="number" min="1" max="5" class="form-control required" id="perhatian" name="nilai[]" value=""required>
										<input style="text-align:center" type="hidden" name="id_aspek_penilaian[]" value="6">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input style="text-align:center" type="number" min="1" max="5" class="form-control required" id="kehadiran"  name="nilai[]" value="" required>
										<input style="text-align:center" type="hidden" name="id_aspek_penilaian[]" value="7">
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">                                
									<div class="form-group">
										<label for="fname">Keterangan</label>
										<ol>
											<li><b>Skill</b> : Kemampuan dalam menyelesaikan tugas</li>
											<li><b>Kerapihan</b> : Berpakaian, cara kerja, penampilan</li>
											<li><b>Sikap</b> : Kesopanan, menghormati, menghargai orang lain</li>
											<li><b>Keaktifan</b> : Bertanya, mengeluarkan pendapat, tidak malas-malasan</li>
											<li><b>Perhatian</b> :  Keingintahuan, kepatuhan dalam bimbingan</li>
											<li><b>Kehadiran</b> : Kehadiran PKL, efisien waktu</li>
										</ol>
									</div>
								</div>
							</div>
							<div id="confirmModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Confirmation</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<h6 align="center" style="margin:0;">Anda yakin ingin menghapus data ini?</h6>
								</div>
								<div class="modal-footer">
									<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
									<button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
								</div>
								</div>
							</div>
						</div>
						</div><!-- /.box-body -->
						
						<div class="box-footer float-right">
							<a href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>
							<button type="submit" id="submit" class="btn btn-info "> Save </button>
						</div>

					</form>
                </div>
            </div>
        </div>    
    </section>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).on('click', '.inputNilai', function(){
  id_kelompok_detail = $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#Penilaian').on('submit', function(e){
	e.preventDefault();
	
    $.ajax({
      type: "POST",
        url: "/api/mahasiswa/nilai",
        cache:false,
        dataType: "json",
        data: $(this).serialize(),
        success: function(data){
            console.log(data);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
            window.location = "/mahasiswa/indexpenilaian/";
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
</script>

@endsection