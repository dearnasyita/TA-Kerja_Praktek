<!DOCTYPE html>
<html>
<head>
  <base href="dashboard">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Komsi Kerja Praktek</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
  <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i id="avatar">
          </i>
          <span id="username"></span>
        </a>
        
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a href="/mahasiswa/ubah_password" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <i class="nav-icon fas fa-key"> </i>
                  Change Password
                </h3>
              </div>
            </div>
          </a>
         <hr>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <i class="nav-icon fas fa-power-off"> </i>
                  Logout
                </h3>
              </div>
            </div>
          </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          
          
        </div>
      </li>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/mahasiswa/index" class="brand-link text-center">
      <span class="brand-text "><b>Kerja Praktek</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user (optional) -->
      <div class="user-panel1 mt-3 pb-3 mb-3 d-flex " style="border-bottom: 1px solid #4f5962;padding: 5px 5px 5px 5px">
        <div class="image" id="avatar1">
          
        </div>
        <div class="info" style="padding: 5px 5px 5px 15px">
          <a class="d-block " id="usernames"></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/mahasiswa/index" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/mahasiswa/profile" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Kelompok
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="/mahasiswa/namakelompok" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buat Kelompok</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mahasiswa/indexpenilaian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penilaian Anggota</p>
                </a>
              </li>
              
              <li class="nav-item">
              <a href="/mahasiswa/detailkelompok" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detail Kelompok</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="/mahasiswa/indexusulan" class="nav-link">
              <i class="fas fa-envelope-open-text nav-icon"></i>
              <p>
                Usulan Instansi
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/mahasiswa/indexlowongan" class="nav-link">
              <i class="fas fa-list nav-icon"></i>
              <p>Lowongan</p>
            </a>
          </li>
           
          <li class="nav-item ">
            <a class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/mahasiswa/laporanharian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mahasiswa/laporanpkl" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Akhir</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/mahasiswa/pengumuman" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Pengumuman
                <span class="badge badge-info right">{{ App\Pengumuman::count() }}</span>
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  @yield('content')
    <!-- Main content -->
</div>
<script>
  if(performance.navigation.type == 2){
    location.reload(true);
  }
</script>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Toast -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function(){

$.ajax({
  type: 'GET',
  url: '/api/mahasiswa/userlogin',
  dataType: 'JSON',
  headers: {
      Authorization : 'Bearer {{Auth::user()->api_token}}',
  },
  success: function (response) {
    var user = response.user.mahasiswa.nama;
    $("#username").append(user);
    $("#usernames").append(user);

    var kel = "<img src={{ URL::to('/') }}/uploads/fotoprofile/" + response.user.mahasiswa.foto + "  width='30px' height='30px' style='object-fit: cover; object-position: top' class='mr-3 img-circle '  onerror=this.onerror=null;this.src='/dist/img/iconuser.png' />";
    $("#avatar").append(kel);



    var foto = response.user.mahasiswa.foto;
    var kel1 = "<img src={{ URL::to('/') }}/uploads/fotoprofile/" + foto + " style='object-fit: cover; object-position:top' width='45px' height='45px' class='mr-3 img-circle elevation-2' onerror=this.onerror=null;this.src='/dist/img/iconuser2.png' />";
    $("#avatar1").append(kel1);
  
    
  }
});
});
</script>
@yield('scripts')
</body>
</html>