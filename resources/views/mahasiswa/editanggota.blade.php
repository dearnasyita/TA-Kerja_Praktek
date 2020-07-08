@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Edit Data</h1>
          </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Edit Data Anggota</li>
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
            <h3 class="card-title">Edit Data Anggota</h3>
          </div>
          <!-- /.card-header -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form role="form">
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nim" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="A" class="col-sm-3 col-form-label">Angkatan</label>
                                        <div class="col-sm-9">
                                        <input type="number" class="form-control" id="angkatan" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nohp" class="col-sm-3 col-form-label">No HP</label>
                                        <div class="col-sm-9">
                                        <input type="number" class="form-control" id="nohp" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="status" placeholder="">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Cancel" />
                                        </span>
                                        <span>
                                        <input type="submit" class="btn btn-primary" value="Submit" />
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