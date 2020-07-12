@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Pengumuman</h4>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Pengumuman</li>
              </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            @foreach ($data as $datas)
            
            <div class="timeline">
              <div>
                <i class="fas fa-angle-right bg-blue "></i>
                <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> {{Carbon\Carbon::parse ($datas->created_at)->translatedFormat('d F Y, G:i')}} </span>
                <h3 class="timeline-header"><a>{{ $datas->judul }}</a></h3>
                <div class="timeline-body">
                  {{ str_limit ($datas->deskripsi, $limit = 70, $end = '... ') }}
                </div>
                <div class="timeline-footer ">
                  <button type="button" class="btn btn-outline-secondary btn-xs detailbtn" id="{{ $datas->id_pengumuman }}"> >>Detail<<
                  </button>
                </div>
              </div> 
            </div>
            </br>
            @endforeach 
          </div>
        </div>                     
      </div>
    
        <!-- modal -->
        
        <div style="position: fixed" class="modal fade show" id="modal-lg" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-tittle text-center">
                <b><h5><p id="judul_p"></p></h5></b>
               
              </div>
              
              <div class="modal-body">
                <div class="form-group row justify-content-center" id="lampiran">
                </div>
                <div class="form-group row justify-content-center">
                  <div class="col-md-10">
                    <p id="deskripsi"></p>
                  </div>
                </div>
              </div>                           
              <!-- /.modal-dialog -->
            </div>
          </div>
          <!-- /.modal -->
        </div>
      </div>
      <!-- /.timeline -->
    </section>
@endsection

@section('scripts')
<script>
$(document).ready(function(){    
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' }
  });

    $('.detailbtn').click(function(){
      var id = $(this).attr('id');
      $.ajax({
        url:'/api/mahasiswa/pengumuman/',
        method: 'GET',
        dataType: 'JSON',
        data: { id_pengumuman : id },
        success: function(response){
          $('#judul_p').html(response.judul);
          $('#deskripsi').html(response.deskripsi);

          var lampiranss = response.lampiran;
          if(lampiranss == null){ 
            var lampkosong = "<img src={{ URL::to('/') }}/images/blank.jpg  width='10px' height='10px' style='object-fit: contain'/>" ;
            $("#lampiran").html(lampkosong);
          }else{
            var lamp = "<img src={{ URL::to('/') }}/uploads/lampiran/" + response.lampiran + " width='400px' height='400px' style='object-fit: contain' />" ;
            $("#lampiran").html(lamp);
          }
          $('#modal-lg').modal({
            backdrop:  'static',
            keyboard: true,
            show: true
          });
        }
      });
      
    });

  });
</script>
@endsection