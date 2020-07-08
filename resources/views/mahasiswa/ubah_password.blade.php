@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Ubah Password</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ubah Password</h3>
          </div>
          <!-- /.card-header -->
          <div class="container">
              @if (session('error'))
              <div class="alert alert-danger">
              {{ session('error') }}
              </div>
              @endif
              @if (session('success'))
              <div class="alert alert-success">
              {{ session('success') }}
              </div>
              @endif 
            <div class="row justify-content-center">
              <div class="col-9">
                <form id="updatePassword" method="post">
                  <input type="hidden" name="id_users" id="id_users" value="{{$user->id_users}}">
                  <div class="card-body">
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">New Password <font color="red">*</font></label>
                        <div class="col-sm-7">
                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                        </div>
                    </div>
                    </br>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">New Confirm Password <font color="red">*</font></label>
                        <div class="col-sm-7">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Re-enter Password">
                        </div>
                    </div>
                    </br>            
                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <button type="reset" class="btn btn-danger"> Cancel </button>                                      
                        </span>
                        <span>
                          <button type="submit" class="btn btn-primary" id="submit" > Save </button>
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
        </div>
      </div>
    </section>
    
@endsection


@section('scripts')

<script >
$(document).ready(function(){   
    $('#updatePassword').on('submit', function(e){
        e.preventDefault();
      var id = $('#id_users').val();

      $.ajax({
        type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/mahasiswa/changepassword/"+id,
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          data: new FormData(this),
          success: function(data){
              window.location = "/mahasiswa/index";
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
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
});
</script>
@endsection