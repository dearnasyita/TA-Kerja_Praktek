@extends('admin.base')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Perusahaan</li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="../../dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">ICON+</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">Perusahaan</a>
                            </li>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bimbingan" data-toggle="tab">Bimbingan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#lowongan" data-toggle="tab">Lowongan</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 style="font-weight: 600;">ICON+</h2>
                                        </div>
                                    </div></br>
                                    <div class="card-body card-primary card-outline table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                <th>Nama Instansi</th>
                                                <th>Website</th>
                                                <th>No.Telp</th>
                                                </tr>
                                                <tr>
                                                <td>ICON+</td>
                                                <td>Imam Fakhrurrozi</td>
                                                <td>0899622372883</td>
                                                </tr>
                                        </table><br/>
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                        </div>
                                </div>
                                <div class="tab-pane" id="bimbingan">
                                    <form role="form">
                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <select class="form-control form-control-sm">
                                                    <option>Periode 2019</option>
                                                    <option>Periode 2018</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-default">Filter</button> <br><br>
                                        </div>
                                    </form>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kelompok</th>
                                                    <th>Periode</th>
                                                    <th>Tempat Magang</th>
                                                    <th>Nama Ketua</th>
                                                    <th>Detail Kelompok</th>
                                                </tr>
                                                <tr>
                                                <td>1</td>
                                                <td>Trident</td>
                                                <td>2018</td>
                                                <td>ICON+</td>
                                                <td>Marsekal Rama</td>
                                                <td class="text-center py-0 align-middle">
                                                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                                                </td>
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="lowongan">
                                    <form role="form">
                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <select class="form-control form-control-sm">
                                                    <option>Periode 2019</option>
                                                    <option>Periode 2018</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-default">Filter</button> <br><br>
                                        </div>
                                    </form>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lowongan</th>
                                                    <th>Detail Info</th>
                                                    <th class="text-center py-0 align-middle">Detail</th>
                                                    <th class="text-center py-0 align-middle">Aksi</th>
                                                </tr>
                                                <tr>
                                                <td>1</td>
                                                <td>Trident</td>
                                                <td>gerh</td>
                                                <td class="text-center py-0 align-middle">
                                                    <a href="detail_lowongan" class="btn-sm btn-warning"><i class="fas fa-arrow-right"></i></a>
                                                </td>
                                                <td class="text-center py-0 align-middle">
                                                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection