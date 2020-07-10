@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Lowongan</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Lowongan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Lowongan</h3>
          </div>
          
          <div class="card-body">
            <div class="col-sm-12">
              <a  href="/mahasiswa/lamaran/" class="btn btn-info float-right btn-sm" ><i class="fas fa-arrow-right"> </i> Cek Status Pendaftaran Lowongan </a> <br><br>
            </div>
            <div class="form-group">
              <table id="lowongan" class="table table-bordered table-striped  text-center">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Instansi</th>
                    <th>Posisi</th>
                    <th>Kapasitas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
      
            </table>
          </div>
        </form>
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


  fill_datatable();
    function fill_datatable(){
      var dataTable = $('#lowongan').DataTable({
        language: {
            emptyTable: "Tidak ada lowongan yang tersedia"
          },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        
        ajax:{
          url: "/mahasiswa/indexlowongan",
         
        },
        
        columns:[
          { data: 'DT_RowIndex', 
          name:'DT_RowIndex'
          },
          {
            data:'nama',
            name:'nama',
                        
          },
          {
            data:'pekerjaan',
            name:'pekerjaan'
          },
          {
            data:'kapasitas',
            name:'kapasitas'
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