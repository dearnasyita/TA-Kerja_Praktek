@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Buku Harian</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Buku Harian</li>
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
            <h3 class="card-title">List Buku Harian</h3>
          </div>
          
          <div class="card-body">
          @if (@$status->status=="magang")
            <div class="col-sm-12">
              <button  class="btn btn-success float-right btn-sm tambahbtn" ><i class="fas fa-plus"></i> Tambah </button> <br><br>
            </div>
          @else
              <a href="javascript:void(0);" class="btn btn-success float-right btn-sm disabled"><i
                      class="fas fa-plus"></i> Tambah </a> <br><br>
          @endif
            <div class="form-group table-responsive p-0" >
              <table id="databukuharian" class="table table-bordered table-striped text-center">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Datang</th>
                    <th>Pulang</th>
                    <th>Kegiatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              
            </table>
          </div>
              
        <!-- tambah -->
        <div class="card-body">
          <div class="modal fade show" id="modal-lg">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah List Kegiatan Harian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="buku_harian">
                    <div class="modal-body ">
                      <div class="row">
                        <div class="col-12">  
                          <div class="card-body  ">                               
                            <div class="form-group row">
                              <label for="Tanggal" class="col-sm-3 col-form-label">Tanggal <font color="red">*</font></label>
                              <div class="col-sm-9">
                                <input type="date" class="form-control datepicker" id="tanggal" name="tanggal"  data-date-start-date="d" value = "{{date('Y-m-d', strtotime('now'))}}">
                              </div>
                            </div>
                            </br>
                            <div class="form-group row">
                              <label for="waktu_mulai" class="col-sm-3 col-form-label">Waktu Mulai <font color="red">*</font></label>
                              <div class="col-sm-9">
                                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai">
                              </div>
                            </div>
                            </br>
                            <div class="form-group row">
                              <label for="waktu_selesai" class="col-sm-3 col-form-label">Waktu Selesai <font color="red">*</font></label>
                              <div class="col-sm-9">
                              <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"   value = "{{Carbon\carbon::parse(strtotime('now'))->setTimezone('Asia/Jakarta')->translatedFormat('H:i')}}">  
                            </div>
                          </div>
                          </br>
                          <div class="form-group row">
                            <label for="kegiatan" class="col-sm-3 col-form-label">Kegiatan <font color="red">*</font></label>
                            <div class="col-sm-9">
                              <textarea type="text" class="form-control" id="kegiatan" name="kegiatan" ></textarea>
                            </div>
                          </div>
                          </br>     
                          <input type="hidden" class="form-control" id="id_periode" name="id_periode" value="{{ $periode->id_periode }}" >                          
                          <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{$userId}}">
                          <input type="hidden" class="form-control" id="id_mahasiswa" name="id_mahasiswa" value="{{ $idMahasiswa->id_mahasiswa }}" >                          
                          <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                              <button  data-dismiss="modal" type="button" value="Cancel" class="btn btn-danger" > Cancel</button>
                            </span>
                            <span>
                              <button type="submit" class="btn btn-primary" id="submit"> Save </button>
                            </span>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- modal konfirm -->
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
            </div>
        </div> 
      </div>
    </section>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->

<script>
$(document).ready(function(){    
    $(".tambahbtn").on('click', function(){
      $('#modal-lg').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();
      console.log(data);
    });

    
    $('#buku_harian').on('submit', function(e){
      e.preventDefault();
      var tanggal = $('#tanggal').val();
      var waktu_mulai = $('#waktu_mulai').val();
      var waktu_selesai = $('#waktu_selesai').val();
      var kegiatan = $('#kegiatan').val();
      var id_mahasiswa =$('#id_mahasiswa').val();


    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        url: "/api/mahasiswa/laporanharian",
        cache:false,
        dataType: "json",
        data: $('#buku_harian').serialize(),
        success: function(data){
          console.log(data);
          $("#modal-lg").modal('hide');
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
              // $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 200;
              toastr.error(item);
            });
          }
    });
  });

    fill_datatable();
    function fill_datatable(){
      var dataTable = $('#databukuharian').DataTable({
        language: {
            emptyTable: "Tidak ada laporan harian yang ditambahkan"
          },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax:{
          url: "/mahasiswa/laporanharian",
         
        },
        
        columns:[
         
          { data: 'DT_RowIndex', 
          name:'DT_RowIndex'
          },
          {
            data:'tanggal',
            name:'tanggal',
                        
          },
          {
            data:'waktu_mulai',
            name:'waktu_mulai'
          },
          {
           data:'waktu_selesai',
            name:'waktu_selesai'
          },
          {
          data:'kegiatan',
          name:'kegiatan'
          },
          {
          data:'status',
          name:'status',
          render: function(data, type, full, meta){
      
              if (data == 'diproses'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }else if(data == 'diperiksa'){
                return "<span class='badge bg-success'>"+ data + "</span>";
              }
            },
          },
          {data: 'action', 
          name: 'action', 
          orderable: false, 
          searchable: false
          },
        ]
      });
    }
  });


  $(document).on('click', '.deletebukuharian', function(){
    id_buku_harian = $(this).attr('id');
    $('#confirmModal').modal('show');
  });


  $('#ok_button').click(function(){
    $.ajax({
        type: "DELETE",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/mahasiswa/laporanharian/'+id_buku_harian,
        beforeSend:function(){
          $('#ok_button').text('Deleting...');
        },
        success: function (data) {
          $('#confirmModal').modal('hide');
            $('#databukuharian').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
            location.reload();
        }
    });
  });
</script>
@endsection