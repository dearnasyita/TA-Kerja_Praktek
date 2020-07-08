@extends('mahasiswa.base')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Detail Kelompok</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                            <li class="breadcrumb-item active">Detail Kelompok</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <!-- Main content -->
                    <div class="container-fluid">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#kelompok" data-toggle="tab">Anggota</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#magang" data-toggle="tab">Info Kerja
                                        Praktik</a></li>
                                <li class="nav-item"><a class="nav-link" href="#jadwal_presentasi" data-toggle="tab">Jadwal
                                        Presentasi</a></li>
                            </ul>
                        </div><!-- /.card-header -->

                        <div class="card-body ">
                            <div class="tab-content">

                                <div class="active tab-pane" id="kelompok">
                                    <div class="col-12">
                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h2 style="font-weight: 600;">
                                                            <font color="#4287f5">
                                                                {{($detail_kelompok!= null&& @$detail_kelompok->tahap!="ditolak") ? $detail_kelompok['nama_kelompok'] : "belum memiliki kelompok"}}
                                                            </font></h2>
                                                        <i class="text-muted">{{($detail_kelompok!= null&& @$detail_kelompok->tahap!="ditolak") ? $detail_kelompok['tahap'] : " "}}</i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        @if(@$detail_kelompok->tahap!="ditolak")
                                        <div class="card-body"><br>
                                            <div class="row">

                                                @foreach($anggota as $anggotas)
                                                    <div class="col-md-4">
                                                        <!-- Profile Image -->
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-body box-profile">
                                                                <div class="text-center">
                                                                  @if(isset($anggotas->foto))
                                                                    <img class="img-circle"
                                                                         style="object-fit: cover; object-position: top;"
                                                                         width="100px" height="100px"
                                                                         src="{{ asset('uploads/fotoprofile/'.$anggotas->foto) }}"
                                                                         onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';"
                                                                         >
                                                                    @else
                                                                    <img class="img-circle"
                                                                        style="object-fit: cover; object-position: top;"
                                                                        width="100px" height="100px"
                                                                        src="{{ asset('uploads/fotoprofile /'.$anggotas->foto) }}"
                                                                        onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';">                                                                        
                                                                    @endif
                                                                </div>
                                                                </br>
                                                                @if (!empty($anggotas->nama))
                                                                    <h3 class="profile-username text-center">{{$anggotas->nama}}</h3>
                                                                @else
                                                                    <h3 class="profile-username text-center">-</h3>
                                                                @endif

                                                                <ul class="list-group list-group-unbordered mb-3">
                                                                    <li class="list-group-item">
                                                                        <b>NIM</b>
                                                                        @if (!empty($anggotas->nim))
                                                                            <a class="float-right">{{$anggotas->nim}}</a>
                                                                        @else
                                                                            <a class="float-right">-</a>
                                                                        @endif
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <b>Angkatan</b>
                                                                        @if (!empty($anggotas->angkatan))
                                                                            <a class="float-right">{{$anggotas->angkatan}}</a>
                                                                        @else
                                                                            <a class="float-right">-</a>
                                                                        @endif
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <b>Status</b>
                                                                        @if (!empty($anggotas->status_keanggotaan))
                                                                            <a class="float-right ">{{$anggotas->status_keanggotaan}}</a>
                                                                        @else
                                                                            <a class="float-right">-</a>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.box -->
                                                    </div>
                                                    <!-- /.col -->
                                                @endforeach
                                            </div>
                                            <br/>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                @if(@$detail_kelompok->tahap!="ditolak")
                                <div class="tab-pane" id="magang">
                                    <div class="row">

                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fa fa-user"></i> <strong> 
                                                        Dosen Pembimbing</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="row justify-content-center">
                                                <div class="col-md-11">
                                                    <div class="card card-outline">
                                                        <div class="card-body box-profile ">
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-9">
                                                                    <ul class="list-group list-group-unbordered">
                                                                        <div class="text-center">
                                                                            <img class="img-circle"
                                                                                 style="object-fit: cover; object-position: top;"
                                                                                 width="100px" height="100px"
                                                                                 src="{{ asset('uploads/fotoprofile /'.$magang->foto) }}"
                                                                                 onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';">
                                                                        </div>
                                                                        </br>
                                                                        <li class="list-group-item">
                                                                            <b>Nama</b>
                                                                            @if (!empty($magang->nama))
                                                                                <a class="float-right">{{$magang->nama}}</a>
                                                                            @else
                                                                                <a></a>
                                                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>NIP</b>
                                                                            @if (!empty($magang->nip))
                                                                                <a class="float-right">{{$magang->nip}}</a>
                                                                            @else
                                                                                <a></a>
                                                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Email</b>
                                                                            @if (!empty($magang->email))
                                                                                <a class="float-right">{{$magang->email}}</a>
                                                                            @else
                                                                                <a></a>
                                                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>No.Hp</b>
                                                                            @if (!empty($magang->no_hp))
                                                                                <a class="float-right">{{$magang->no_hp}}</a>
                                                                            @else
                                                                                <a></a>
                                                                            @endif
                                                                        </li>
                                                                        </br>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 text-center">
                                            </br>
                                            </br>
                                            </br>

                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fas fa-building"></i> <strong>Tempat Kerja
                                                                Praktik</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row justify-content-center">
                                                <div class="col-md-11">
                                                    <div class="card card-outline">
                                                        <div class="card-body box-profile ">
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-9">
                                                                    <div class="text-center">
                                                                    @if($instansi)
                                                                        <img class="img-circle"
                                                                                style="object-fit: cover; object-position: top;"
                                                                                width="100px" height="100px"
                                                                                src="{{ asset('uploads/fotoprofile/'.$instansi->foto) }}"
                                                                                onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';">
                                                                    @else
                                                                        <img class="img-circle"
                                                                                style="object-fit: cover; object-position: top;"
                                                                                width="100px" height="100px"
                                                                                src="{{ asset('uploads/fotoprofile/') }}"
                                                                                onerror="this.onerror=null;this.src='../../dist/img/iconuser.png';">
                                                                    @endif
                                                                    </div>
                                                                    </br>
                                                                    <ul class="list-group list-group-unbordered">
                                                                        <li class="list-group-item">
                                                                            <p><b>Nama Instansi</b></p>
                                                                            @if (!empty($instansi->nama))
                                                                                <p>{{$instansi->nama}}</p>
                                                                            @else
                                                                                <p></p>
                                                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <p><b>Alamat Instansi</b></p>
                                                                            @if (!empty($instansi->alamat))
                                                                                <p>{{$instansi->alamat}}</p>
                                                                            @else
                                                                                <p></p>
                                                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <p><b>Website</b></p>
                                                                            @if (!empty($instansi->website))
                                                                                <p>{{$instansi->website}}</p>
                                                                            @else
                                                                                <p></p>
                                                                            @endif
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- /.tab-pane -->
                                @if(@$detail_kelompok->tahap!="ditolak")
                                <div class="tab-pane" id="jadwal_presentasi">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fas fa-clock"></i> <strong>Jadwal
                                                                Presentasi</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body box-profile ">
                                            <div class="row justify-content-center">
                                                <div class="col-md-9">
                                                    <ul class="list-group list-group-unbordered">
                                                        <li class="list-group-item">
                                                            <i class="nav-icon fas fa-calendar-alt"> Hari,Tanggal</i>
                                                            @if (!empty($jadwal->tanggal))
                                                                <a class="float-right">
                                                                    {{Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y')}}
                                                                </a>
                                                            @else
                                                                <a></a>
                                                            @endif

                                                        </li>
                                                        <li class="list-group-item">
                                                            <i class="nav-icon fas fa-clock"> Waktu</i>
                                                            @if (!empty($jadwal->sesi))
                                                                <a class="float-right">
                                                                    {{Carbon\Carbon::parse($jadwal->sesi)->translatedFormat('G:i')}}
                                                                </a>
                                                            @else
                                                                <a></a>
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item">
                                                            <i class="nav-icon fas fa-building"> Ruang</i>
                                                            @if (!empty($jadwal->ruang))
                                                                <a class="float-right">{{$jadwal->ruang}}</a>
                                                            @else
                                                                <a></a>
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item">
                                                            <i class="nav-icon fas fa-user"> Penguji</i>
                                                            @if (!empty($jadwal->nama))
                                                                <a class="float-right">{{$jadwal->nama}}</a>
                                                            @else
                                                                <a></a>
                                                            @endif
                                                        </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- /.tab-pane-->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- container -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.col -->
        </section>
        <!-- /.content -->
    </div>

@endsection
