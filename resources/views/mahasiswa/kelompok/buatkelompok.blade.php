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
            <!-- <form id="anggotaForm" > -->
            <form id="kelompokForm" >             
              <div class="col-sm-12">
                <div class="form-group row">
                  <label for="nama_kelompok" class="col-sm-2 col-form-label ">Nama Kelompok : </label>
                  <div class="col-sm-8">
                  <label class="col-sm-5 col-form-label">
                  <font color="#4287f5">
                      <h4> {{$idKelompok->nama_kelompok}}</h4>
                  </font>
                  </label>
                 </div>
              </div>
            </form>
          </div>
        </div>
      </div>


     
			<div class="card">
				<div class="card-body">
					<div class="card-primary">
						<div class="row">
							<div class="col-12">
                <div class="col-sm-12">
                  <div class="form-group row">
                    <div class="col-sm-9">
                      <label for="anggota" class="col-sm-3 col-form-label">Anggota Kelompok </label>
                    </div>

                    <div class="col-sm-12">
                      <a href="javascript:void(0)" class="btn btn-success float-right btn-sm" data-toggle="modal" data-target="#openAnggota"><i class="fas fa-plus"></i> Tambah Anggota </a> <br><br>
                    </div>
                  </div>

             
                  <div class="row">
                    <div class="col-12">
                      <div class="col-sm-12">
                        <div class="form-group row">
                          <table class="table table-bordered table-striped text-center" id="anggota">
                            <thead>
                              <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
              
                      <!-- tabel daftar mahasiswa -->
                      <div class="card-body">
                        <div class="modal fade show" id="openAnggota">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Daftar Mahasiswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <table id="daftarmahasiswa" class="table table-bordered table-striped text-center ">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Pilih</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    
                                    @foreach($mahasiswa_tersedia as $row)
                                    
                                      <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->nim}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>
                                        <button type="button" data-id="{{$row->id_mahasiswa}}" data-nama="{{$row->nama}}" data-nim="{{$row->nim}}" class="btn btn-warning add-anggota" ><i class="fas fa-plus"></i></button>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                    <input type="hidden" class="form-control" id="id_kelompok" name="id_kelompok" value="{{$idKelompok->id_kelompok}}">
                                    <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{$userId}}">
                                  </table>
                              </div>
                              <!-- /.modal-body-->
                              <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal-fadeshow -->
                      </div>
                      <!-- /.card-body -->

                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <a href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>                                      
                        </span>
                        
                        <span>
                          <button type="button" class="btn btn-primary tambahAnggota">Save</button>
                        </span>
                      </div>
                      <br><br>

                      <div class="d-flex flex-row justify-content-end">
                        <span>
                          <a href="/indexkelompok/" class="btn btn-warning float-right btn-sm"><i class="fas fa-arrow-right"> </i> Lewati / Tidak menambah anggota</a>
                        </span>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>     
          <!-- </form> -->
        </div>
        <!-- /card -->
      </div>
      <!-- /.row -->        
    </section>
  </div>
    <!-- /.row -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#daftarmahasiswa").DataTable();
  });

  function deleteRow(r, id) {
      // console.log("hi")
      let i = r.parentNode.parentNode.rowIndex;
      document.getElementById("anggota").deleteRow(i);

      $('table#daftarmahasiswa tbody button[data-id="'+id+'"]').removeAttr("disabled");
    }

  $(".add-anggota").click(function () {

    $(this).attr("disabled", true);

    let no = $(this).data("no");
    let nim = $(this).data("nim");
    let nama = $(this).data("nama");
    let id = $(this).data("id");

    console.log(nim);
    console.log(nama);

    let markup = 

    "<tr>"
    + "<td>" + nim + "</td>"
    + "<td>" + nama + "</td>"
    + "<td><button class='btn btn-danger' onclick='deleteRow(this, "+id+")' >Delete</button> <input type='hidden' name='list_anggota[]' value='"+ id +"' ></td>"
    + "</tr>";

    tableBody = $("table#anggota tbody"); 
    tableBody.append(markup);
  });

  $(".tambahAnggota").click(function () {
        var id_kelompok = $('#id_kelompok').val();
        created_by = $('#created_by').val();
        
        $("input[name='list_anggota[]']").map(function()
        {
          let id = $(this).val();

          $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/mahasiswa/kelompok/addanggota",
            cache:false,
            dataType: "json",
            data: {'id_mahasiswa': id,'id_kelompok': id_kelompok,'created_by': created_by},
            success: function(data){
                console.log(data);
                $("#openModal").modal('hide');
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
                window.location = "/mahasiswa/indexkelompok/";
            },
            error: function(error){
              console.log(error);
            }
          });
        }).get();


      });

</script>
@endsection