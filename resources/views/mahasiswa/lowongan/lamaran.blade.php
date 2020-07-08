@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Daftar Apply Lowongan</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Daftar Apply Lowongan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Apply Lowongan</h3>
          </div>
          
          <div class="card-body">
            <div class="form-group">
              <table id="datalamaran" class="table table-bordered table-striped text-center">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Instansi</th>
                    <th>Posisi</th>
                    <th>Status</th>
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
  $(function () {

  fill_datatable();
    function fill_datatable(){
      var dataTable = $('#datalamaran').DataTable({
        language: {
            emptyTable: "Tidak ada lowongan yang dilamar"
          },
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,

        ajax: {
            url: "/mahasiswa/lamaran",

          },
        columns:[
          {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
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
            data:'status',
            name:'status',
            render: function(data, type, full, meta)
            {
              if (data == 'melamar'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }else if(data == 'diterima'){
                return "<span class='badge bg-success'>"+ data + "</span>";
              }else if(data == 'ditolak'){
                return "<span class='badge bg-danger'>"+ data + "</span>";
              }
            },
          },
          
        ]
      });
    }
  });

  
</script>

@endsection