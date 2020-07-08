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
              <li class="breadcrumb-item active">Edit Nilai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">

<div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Nilai</h3>
            </div>
            <div class="card-body">
                <form role="form">
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
						<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
										<label for="fname">Nama Mahasiswa</label>
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Skill</label>
										<!-- <input type="number"  class="form-control required" id="kebersamaan" name="kebersamaan" value="3"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Kerapihan</label>
										<!-- <input type="number"  class="form-control required" id="sikap" name="sikap" value="4"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Sikap</label>
										<!-- <input type="number"  class="form-control required" id="sikap" name="sikap" value="4"> -->
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Keaktifan</label>
										<!-- <input type="number"  class="form-control required" id="keaktifan" name="keaktifan" value="5"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Perhatian</label>
										<!-- <input type="number"  class="form-control required" id="skill" name="skill" value="5"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Kehadiran</label>
										<!-- <input type="number"  class="form-control required" id="sikap" name="sikap" value="4"> -->
									</div>
								</div>
								
							</div>
							
							<!-- isi nilai -->
							<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
									<input type="text" class="form-control required" id="nama_mahasiswa" value="Nofa Dwi Adelia">
								</div>
							</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="skill" name="skill" value="">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="kerapihan" name="kerapihan" value="">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="">
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="keaktifan" name="keaktifan" value="">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="perhatian" name="perhatian" value="">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="kehadiran" name="kehadiran" value="">
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
						</div><!-- /.box-body -->
						
						<div class="box-footer float-right">
							<a href="/editnilai" class="btn btn-danger" >Batal</a>
							<a  href="/indexpenilaian" type="button" class="btn btn-info" value="Simpan">Simpan</a>
						</div>

					</form>
                </div>
            </div>
        </div>    
    </section>
@endsection