
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK IKM {{ request()->is('/') ? '' : '|' }} @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template') }}/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <h5 class="nav-link"><b>DINAS KOPERASI, USAHA KECIL MENENGAH, DAN PERINDUSTRIAN KOTA SAMARINDA</b></h5>
      </li>
      <!--li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">IKM</a>
      </li-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item nav-link">
            Logout
          </button>
        </form>
        
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-secondary elevation-3">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <!--img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"-->
      <img src="{{ asset('img') }}/kaltimprov.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-5" style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      @include('layout/sidebar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-7">
            <!--h1>@yield('title')</h1-->
          </div>
          <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong> </strong> 
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</body>


<script type="text/javascript">
//sweetalert
$('.delete').click(function(){
  var id_industri = $(this).attr('data-id');
  var nama_industri = $(this).attr('data-nama');
  swal({
    title: "Hapus Data IKM",
    text: "Ingin menghapus data IKM milik "+nama_industri+" ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((Hapus) => {
      if (Hapus) {
        window.location = "/industri/hapus/"+id_industri+""
        swal("Menghapus IKM", {
        icon: "success",
      });
      } 
  });
});

$('.deleteall').click(function(){
  swal({
    title: "Hapus Seluruh Data IKM",
    text: "Ingin menghapus Seluruh data IKM ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((format) => {
      if (format) {
        window.location = "/industri/format"
        swal("Menghapus Seluruh IKM", {
        icon: "success",
      });
      } 
  });
});

//toastr
@if(Session::has('success'))
  toastr.success("{{ Session::get('success') }} ")
@endif
@if(Session::has('info'))
  toastr.info("{{ Session::get('info') }} ")
@endif
@if(Session::has('error'))
  toastr.error("{{ Session::get('error') }} ")
@endif
@if(Session::has('warning'))
  toastr.warning("{{ Session::get('warning') }} ")
@endif


</script>

</html>


