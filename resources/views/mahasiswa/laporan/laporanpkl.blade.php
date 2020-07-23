@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Laporan Akhir</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Laporan Akhir</li>
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
              <h3 class="card-title">Laporan Akhir</h3>
            </div>
              <div class="card-body">
                <div class="col-sm-12">
                  
                @if ($status!=null && $status->status_keanggotaan == 'Ketua' && $statusLaporan==null )
                      <a href="{{route('laporan.create')}}" class="btn btn-success float-right btn-sm"><i
                              class="fas fa-plus"></i> Tambah </a> <br><br>
                  @endif
                </div>

                <div class="form-group">
                  <table id="datalaporanakhir" class="table table-bordered table-striped text-center">
                    <thead>
                      <tr class="text-center">
                        
                        <th>Judul</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>  
                  </table>
                </div>
        
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
          <div class="modal fade" id="detailLaporanakhir">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center" id="lampiran">
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>

  $(function () {

  fill_datatable();
    function fill_datatable(){
      var dataTable = $('#datalaporanakhir').DataTable({
        language: {
            emptyTable: "Belum ada laporan akhir yang ditambahkan"
          },
        lengthChange: false,
        searching: false,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        info: false,
        ordering: false,
        paging: false,
        ajax:{
          url: "/mahasiswa/laporanpkl",
         
        },
        
        columns:[
          
          {
            data:'judul',
            name:'judul',
                        
          },
          {
            data:'created_at',
            name:'created_at'
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


  $(document).on('click', '.deletelaporanakhir', function(){
    id_laporan= $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  
  $('#ok_button').click(function(){
    $.ajax({
        type: "DELETE",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/mahasiswa/laporanpkl/'+id_laporan,
        beforeSend:function(){
          $('#ok_button').text('Deleting...');
        },
        success: function (data) {
          $('#confirmModal').modal('hide');
            $('#datalaporanakhir').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
            location.reload();
        }
    });
  });

  $('body').on('click', '.detaillaporanakhir', function () {
    id = $(this).attr('id');
    $('#detailLaporanakhir').modal('show');

  
    $.ajax({
        url:'/api/mahasiswa/showlaporan/',
        method: 'GET',
        dataType: 'JSON',
        data: { id_laporan : id },
        success: function(response){
          var laporan = "<iframe src={{ URL::to('/') }}/uploads/laporanakhir/" + response.berkas + " width='700px' height='700px' frameborder='0'></iframe>";
          
          $("#lampiran").html(laporan);
          $('#detaillaporanakhir').modal({
            backdrop:  'static',
            keyboard: true,
            show: true
          });
        }
      });
  });

  
</script>

@endsection
	