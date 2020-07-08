@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Periode</li>
                <li class="breadcrumb-item active">Add</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <!-- form start -->
                            <form action="{{ route('periode.store') }}"  method="post" >
                            {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <p><h2>Periode PKL<br><strong>2019</strong></h2><br><i class="text-muted">4 December 2019</i></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                                <label for="fname">Tahun Periode *</label>
                                                <input type="number" class="form-control" id="tahun" name="tahun" >
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">                                
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Tanggal Mulai *</label>
                                                <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" name="tgl_mulai" class="form-control pull-right required" >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                        <div class="col-md-6">                                
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Tanggal Selesai *</label>
                                                <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" name="tgl_selesai" class="form-control pull-right required">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </span>
                                    <span>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </span>
                                   </div>
                                </div><!-- /.box-body -->
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
    <!-- /.content -->
@endsection

@section('scripts')
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>



@endsection