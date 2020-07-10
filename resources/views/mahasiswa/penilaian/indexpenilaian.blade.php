@extends('mahasiswa.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Penilaian Kelompok</h4>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Penilaian Kelompok</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">

<div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Nilai Anggota Kelompok</h3>
            </div>
				<div class="box-body">
					<div class="card-body">
						<div class="form-group table-responsive p-0" >
						<table id="nilai" class="table table-bordered table-striped text-center" style="width:100%">
							<thead>
							<tr class="text-center">
								<th>No</th>
								<th>NIM</th>
								<th>Nama Mahasiswa</th>
								<th>Skill</th>
								<th>Kerapihan</th>
								<th>Sikap</th>
								<th>Keaktifan</th>
								<th>Perhatian</th>
								<th>Kehadiran</th>
								<th>Total Nilai</th>
								<th>Aksi</th>
								
							</tr>
							</thead>
							<tbody>

							
							@php $no = 1; @endphp
							@foreach($data as $anggotas)
							
							<tr class="text-center">
							<td>{{$no++}}</td>
							<td>{{$anggotas->nim}}</td>
							<td>{{$anggotas->nama}}</td>
							<td>{{@App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->where('id_aspek_penilaian',1)->first()->nilai}}</td>
							<td>{{@App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->where('id_aspek_penilaian',5)->first()->nilai}}</td>
							<td>{{@App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->where('id_aspek_penilaian',3)->first()->nilai}}</td>
							<td>{{@App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->where('id_aspek_penilaian',2)->first()->nilai}}</td>
							<td>{{@App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->where('id_aspek_penilaian',6)->first()->nilai}}</td>
							<td>{{@App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->where('id_aspek_penilaian',7)->first()->nilai}}</td>
							@php
							$total = @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('id_aspek_penilaian',1)->where('created_by','=', $userId)->first()->nilai + @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('id_aspek_penilaian',5)->where('created_by','=', $userId)->first()->nilai + @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('id_aspek_penilaian',3)->where('created_by','=', $userId)->first()->nilai + @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('id_aspek_penilaian',2)->where('created_by','=', $userId)->first()->nilai + @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('id_aspek_penilaian',7)->where('created_by','=', $userId)->first()->nilai + @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('id_aspek_penilaian',6)->where('created_by','=', $userId)->first()->nilai;
							$edit = @App\Nilai::where('id_mahasiswa',$anggotas->id_mahasiswa)->where('created_by','=', $userId)->count();
							@endphp
							<td>{{$total}}</td>
							<td>
								@if($edit>5)
								<a href="javascript:void(0);" type="button" class="btn btn-info btn-sm disabled"><i
                              class="fas fa-edit"></i></a>
								@else
								<a href="/mahasiswa/formnilai/{{$anggotas->id_mahasiswa}}" type="button" class="btn btn-info btn-sm"><i
                              class="fas fa-edit"></i></a>
								@endif
							</td>
							</tr>
							@endforeach
							</tbody>
						</table>
						</div>
					<br>
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
$(function () {
	$("#nilai").DataTable({
		
      responsive: true,
	  autoWidth: false,
	  language: {
      emptyTable: "Anda belum memiliki kelompok"
    }
	})
});
</script>
@endsection