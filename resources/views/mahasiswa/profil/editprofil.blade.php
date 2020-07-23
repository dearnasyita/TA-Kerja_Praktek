@extends('mahasiswa.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Edit Profil Mahasiswa</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Edit Profil Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">

	<div class="col-12">
        <div class="card">
            <div class="card-body">
				<form id="editprofil" enctype="multipart/form-data">
				{{ csrf_field() }}
        			<input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="{{ $mahasiswa->id_mahasiswa }}">

				
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">         
							<label>CV</label>                       
								<div class="input-group input-group">
									<input type="file" class="form-control"  id="cv" name="cv" value="{{$mahasiswa->cv}}">
								</div>
								<p class="text-muted"><small><i>*Dalam bentuk PDF, max ukuran 3 MB</i></small></p>
							</div>
						</div>
					</div>	
				</div>  
			</div>
		</div>


		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="card-body card-primary  table-responsive p-0"></br>
						<div class="row ">
							<!-- <div class="col-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group text-center">
											<label for="nim">NIM </label>
											<input style="text-align:center" type="text" class="form-control" id="nim"  name="nim" placeholder="NIM" value="{{ $mahasiswa->nim }}" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group text-center">
											<label for="nama">Nama Lengkap</label>
											<input style="text-align:center" type="text" class="form-control" id="nama"  name="nama" placeholder="Nama" value="{{ $mahasiswa->nama }}" >
										</div>
									</div>
								</div>
							</div> -->
							
							<div class="col-12">
								<div class="row">
								<div class="col-md-4">
										<div class="form-group text-center">
											<label for="angkatan">Angkatan </label>
											<input style="text-align:center" type="text" class="form-control" id="angkatan"  name="angkatan" placeholder="Angkatan" value="{{ $mahasiswa->angkatan }}" >
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group text-center">
											<label for="no_hp">No.HP </label>
											<input style="text-align:center" type="number" class="form-control" id="no_hp"  name="no_hp" placeholder="No.HP" value="{{ $mahasiswa->no_hp }}" >
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group text-center">
											<label for="email">Email </label>
											<input style="text-align:center" type="email" class="form-control" id="email"  name="email" placeholder="Email" value="{{ $mahasiswa->email }}" >
										</div>
									</div>
								</div>
							</div>
						</div>
						
					
						</table><br/>

						<strong><i class="fas fa-home mr-1"></i> Alamat</strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="alamat"  name="alamat" rows="2" maxlength="1000" placeholder="Alamat tempat tinggal anda sekarang" >{{ $mahasiswa->alamat }}</textarea>
									<p class="text-muted"><small><i>*Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>

						<strong><i class="fas fa-pencil-alt mr-1"></i> Kemampuan</strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="kemampuan"  name="kemampuan" rows="5" maxlength="1000" placeholder="Contoh : Menguasai Bahasa pemrograman HTML, CSS, PHP, ..." >{{ $mahasiswa->kemampuan }}</textarea>
									<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>

						<strong><i class="far fa-file-alt mr-1"></i> Pengalaman </strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="pengalaman"  name="pengalaman" rows="5" maxlength="1000" placeholder="Contoh : Project Penilaian PKL (Full-Stack Developer), ..."  >{{ $mahasiswa->pengalaman }}</textarea>
									<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>	
					</div>
					</br>
					<div class="box-footer float-right">
						<a href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>
						<button type="submit" id="submit" class="btn btn-info"> Save </button>
					</div>
				</div>                     
          	</form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
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
    $('#editprofil').on('submit', function(e){
        e.preventDefault();
		var id = $('#id_mahasiswa').val();
        // var nama = $('#nama').val();
		// var nim = $('#nim').val();
		// var alamat = $('#alamat').val();
        // var email = $('#email').val();
        // var no_hp = $('#no_hp').val();
        // var kemampuan = $('#kemampuan').val();
        // var pengalaman = $('#pengalaman').val();
        // var cv = $('#cv').val();

        

        $.ajax({
			type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/editprofil/"+id+"/edit",
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                window.location = "/mahasiswa/profile";
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




