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
				<form id="editprofil" method="POST" enctype="multipart/form-data">
        			<input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="{{ $mahasiswa->id_mahasiswa }}">

				{{ csrf_field() }}
				{{ method_field('PUT') }}
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">         
							<label>CV</label>                       
								<div class="input-group input-group">
									<input type="file" class="form-control"  id="cv" name="cv">
								</div>
								<p class="text-muted"><small><i>*Dalam bentuk PDF, max ukuran 10 MB</i></small></p>
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
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="nim">NIM </label>
											<input type="text" class="form-control" id="nim" required name="nim" placeholder="NIM" value="{{ $mahasiswa->nim }}" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="nama">Nama Lengkap</label>
											<input type="text" class="form-control" id="nama" required name="nama" placeholder="Nama" value="{{ $mahasiswa->nama }}" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="no_hp">No.HP </label>
											<input type="number" class="form-control" id="no_hp" required name="no_hp" placeholder="No.HP" value="{{ $mahasiswa->no_hp }}" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="email">Email </label>
											<input type="email" class="form-control" id="email" required name="email" placeholder="Email" value="{{ $mahasiswa->email }}" >
										</div>
									</div>
								</div>
							</div>
						</div>
						
					
						</table><br/>

						<strong><i class="fas fa-pencil-alt mr-1"></i> Alamat</strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="alamat" required name="alamat" rows="2" maxlength="1000" placeholder="Alamat tempat tinggal anda sekarang" >{{ $mahasiswa->alamat }}</textarea>
									<p class="text-muted"><small><i>*Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>

						<strong><i class="fas fa-pencil-alt mr-1"></i> Kemampuan</strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="kemampuan" required name="kemampuan" rows="5" maxlength="1000" placeholder="Contoh : Menguasai Bahasa pemrograman HTML, CSS, PHP, ..." >{{ $mahasiswa->kemampuan }}</textarea>
									<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>

						<strong><i class="far fa-file-alt mr-1"></i> Pengalaman </strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="pengalaman" required name="pengalaman" rows="5" maxlength="1000" placeholder="Contoh : Project Penilaian PKL (Full-Stack Developer), ..."  >{{ $mahasiswa->pengalaman }}</textarea>
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





