@extends('mahasiswa.base')
@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Profil Mahasiswa</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Profil Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <div class="image ">
                        <img  class="img-circle" style="object-fit: cover; object-position: top;" width="100px" height="100px"  src="{{ asset('uploads/fotoprofile/'.$mahasiswa->foto) }}" onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';" >
                        </div>
                    </div>        
                    <form action="/mahasiswa/profile/{{$mahasiswa->id_mahasiswa}}" method="POST" enctype="multipart/form-data">                                            
                        @csrf
                        <div class="box-body ">
                            <div class="row justify-content-center">
                                <div class="col-md-9">     
                                    </br>                          
                                    <div class="row justify-content-center">
                                        <a href="javascript:void(0)" data-id="{{  $mahasiswa->id_mahasiswa }}" class="text editAvatar"><i class="fas fa-pencil-alt"></i> &nbsp; Ubah Foto</a>
                                    </div> 									
                                    <div class="row justify-content-center">
                                        <p class="text-muted"><small><i>*Max ukuran 1 MB, JPG|PNG</i></small></p>	
                                    </div>				
                                </div>
                            </div>    
                        </div>
                    </form>
                                        
                    <form role="form" method="post" id="editFoto" enctype="multipart/form-data">                                            
                        <div class="box-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">     
                                </br>                    
                                <h3 class="profile-username text-center"><b>{{ $mahasiswa->nama }}</b></h3>
                                    <div class="row justify-content-center">
                                        <div class="col-md-9">
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>NIM </b> <a class="float-right">{{ $mahasiswa->nim }}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Angkatan </b> <a class="float-right">{{ $mahasiswa->angkatan }}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="nav-icon fas fa-users"></i> <a class="float-right">{{ $mahasiswa->nama }}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>CV  </b> 
                                                    <a data-toggle="modal" data-target="#modal-default" class="btn btn-warning float-right text-center py-0 align-middle show_cv" ><i class="nav-icon fas fa-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    
                    <div class="modal fade" id="modal-cv">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                    @if($mahasiswa->cv == null)
                                    <iframe src='about:blank' style="width:700px; height:10px;" frameborder="0"></iframe>
                                    @else
                                    <iframe src="{{ asset('uploads/cv/'.$mahasiswa->cv) }}"
                                            style="width:700px; height:700px;" frameborder="0">
                                    </iframe>
                                    @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <form>
                <div class="box-body">
                    <div class="card card-primary card-outline">
                        <div class="card-body ">
                            <div class="tab-content">
                                <div class="card-body card-primary table-responsive p-0">
                                    <table class="table no-border text-center">
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>No.HP</th>
                                            <th>Email</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $mahasiswa->nim }}</td>
                                            <td>{{ $mahasiswa->nama }}</td>
                                            <td>{{ $mahasiswa->no_hp }}</td>
                                            <td>{{ $mahasiswa->email }}</td>
                                        </tr>
                                    </table><br/>
                                    <strong><i class="fas fa-home mr-1"></i> Alamat</strong>
                                    <p class="text-muted">{{ $mahasiswa->alamat }}</p><br/>
                                    <strong><i class="fas fa-pencil-alt mr-1"></i> Kemampuan</strong>
                                    <p class="text-muted">{{ $mahasiswa->kemampuan }}</p><br/>
                                    <strong><i class="far fa-file-alt mr-1"></i> Pengalaman</strong>
                                    <p class="text-muted">{{ $mahasiswa->pengalaman }}</p>
                                </div>
                                </br>
                                <div class="box-footer float-right">
                                    <a href="/mahasiswa/editprofil/{{$mahasiswa->id_mahasiswa}}" class="btn btn-info">Edit</a>                                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="modal fade" id="modal-editAvatar">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form id="updateAvatar" enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                        <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="form-group">
                        <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="{{$mahasiswa->id_mahasiswa}}"><br>
                            <label for="exampleInputFile">Foto</label>

                            <div class="input-group input-group-sm"> 
                                <input type="file" name="foto" id="foto" class="form-control" value="{{ $mahasiswa->foto }}">                         
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="submit" type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();

    $(document).on('click', '.show_cv', function(){
      $('#modal-cv').modal('show');
    });

    $(document).on('click', '.editAvatar', function(){
      $('#modal-editAvatar').modal('show');
    });

    $('#updateAvatar').on('submit', function(e){
        e.preventDefault();
        var id = $('#id_mahasiswa').val();
        
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/profile/"+id+"/edit",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
              $('#modal-editAvatar').modal('hide');
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
                location.reload();
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