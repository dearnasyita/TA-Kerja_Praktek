@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Usulan Instansi</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                            <li class="breadcrumb-item active">Usulan Instansi</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usulan Instansi</h3>
                    </div>

                    <div class="card-body ">
                        <div class="col-sm-12">

                            @if ($statusKeanggotaan!=null && @$statusKeanggotaan->status_keanggotaan == 'Ketua' && ($statusUsulan==null || @$statusUsulan->status=="ditolak") && ($statusLamaran==null || @$statusLamaran->status=="ditolak"))
                                <a href="{{route('usulan.create')}}" class="btn btn-success float-right btn-sm"><i
                                        class="fas fa-plus"></i> Tambah Usulan </a> <br><br>
                            @endif

                        </div>

                        <div class="table-responsive p-0  ">
                            <table id="datausulan" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Instansi</th>
                                        <th>Website</th>
                                        <th>Alamat</th>
                                        <th>Jobdesk</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="modal fade" id="surat">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row justify-content-center" id="suratUsulan">
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

            function fill_datatable() {
                var dataTable = $('#datausulan').DataTable({
                    language: {
                            emptyTable: "Tidak ada usulan instansi yang diajukan"
                        },
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,

                    ajax: {
                        url: "/mahasiswa/indexusulan",

                    },

                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_instansi',
                            name: 'nama_instansi',

                        },
                        {
                            data: 'website_instansi',
                            name: 'website_instansi'
                        },
                        {
                            data: 'alamat_instansi',
                            name: 'alamat_instansi'
                        },
                        {
                            data: 'jobdesk',
                            name: 'jobdesk'
                        },
                        {
                            data: 'deskripsi_instansi',
                            name: 'deskripsi_instansi'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function (data, type, full, meta) {
                                if (data == 'diproses') {
                                    return "<span class='badge bg-warning'>" + data + "</span>";
                                } else if (data == 'diterima') {
                                    return "<span class='badge bg-success'>" + data + "</span>";
                                } else if (data == 'ditolak') {
                                    return "<span class='badge bg-danger'>" + data + "</span>";
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

        $(document).on('click', '.surat', function () {
            id = $(this).attr('id');
            $('#surat').modal('show');

            $.ajax({
                url: '/api/mahasiswa/showsurat/',
                method: 'GET',
                dataType: 'JSON',
                data: {id_usulan: id},
                success: function (response) {
                    var surat = "<iframe src={{ URL::to('/') }}/uploads/suratpersetujuan/" + response.surat + " width='700px' height='700px' frameborder='0' ></iframe>";
                    $("#suratUsulan").html(surat);
                    $('#surat').modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                }
            });
        });


    </script>

@endsection
