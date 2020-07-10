@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Riwayat Kelompok</h4>
          </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Riwayat Kelompok</li>
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
            <h3 class="card-title">Riwayat Kelompok</h3>
          </div>
          <div class="card-body">
              
              <div class="form-group">
                <table id="riwayatkelompok" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kelompok</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  
                </table>
              </div>
            
            </div>
          
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
$(document).ready(function(){
  fill_datatable();
    function fill_datatable(){
      var dataTable = $('#riwayatkelompok').DataTable({
        language: {
            emptyTable: "Anda belum memiliki kelompok"
          },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        
        ajax:{
          url: "/mahasiswa/indexkelompok",
         
        },
        
        columns:[
          { data: 'DT_RowIndex', 
          name:'DT_RowIndex'
          },
          {
            data:'nama_kelompok',
            name:'nama_kelompok',
                        
          },
          {
            data:'tahap',
            name:'tahap',
            render: function(data, type, full, meta)
            {
              if (data == 'diproses'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }else if(data == 'diterima'){
                return "<span class='badge bg-success'>"+ data + "</span>";
              }else if(data == 'ditolak'){
                return "<span class='badge bg-danger'>"+ data + "</span>";
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

</script>
@endsection