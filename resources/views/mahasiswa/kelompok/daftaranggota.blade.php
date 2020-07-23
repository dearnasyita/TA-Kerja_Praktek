@extends('mahasiswa.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Daftar Anggota</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Daftar Anggota</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h1 class="card-title"><b>Kelompok {{$idKelompok->nama_kelompok}}</b></h1>
          </div>
          
          <div class="box-body"> 
            <div class="card-body">
            @if ( @$statusKeanggotaan->status_keanggotaan == 'Ketua')
              <div class="col-sm-12">
                <a  href="/mahasiswa/buatkelompok" class="btn btn-success float-right btn-sm" ><i class="fas fa-plus"></i> Tambah Anggota</a> <br><br>
              </div>
            @endif
              <div class="form-group table-responsive p-0" >
                <table id="daftaranggota" class="table table-bordered table-striped text-center" style="width:100%">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>NIM</th>
                      <th>Nama Mahasiswa</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>	
          </div>
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
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
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
// DELETE
$(document).on('click', '.deleteAnggota', function(){
  id_kelompok_detail = $(this).attr('id');
    $('#confirmModal').modal('show');
  });

  $('#ok_button').click(function(){
    $.ajax({
        type: "GET",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/mahasiswa/daftaranggota/hapus/'+id_kelompok_detail,
        success: function (data) {
            $('#confirmModal').modal('hide');
            window.location.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
  });
  
$(document).ready(function(){
    fill_datatable();
    function fill_datatable(){
      var dataTable = $('#daftaranggota').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        language: {
            emptyTable: "Tidak ada anggota yang ditambahkan"
          },
        ajax:{
          url: "/mahasiswa/daftaranggota/".$id,
         
        },
        
        columns:[
			{ data: 'DT_RowIndex', 
          name:'DT_RowIndex'
          },
         
          {
            data:'nim',
            name:'nim'
                        
          },
          {
            data:'nama',
            name:'nama'
          },
          {
            data:'status_keanggotaan',
            name:'status_keanggotaan',
            render: function(data, type, full, meta)
            {
              if (data == 'Ketua'){
                return "<span class='badge bg-info'>"+ data + "</span>";
              }else if(data == 'Anggota'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }
            },
          },
          {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false
          },
         
        ]
      });
    }
  });
</script>
@endsection