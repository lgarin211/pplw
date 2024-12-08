<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMPTL</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('modernize/src/assets/images/logos/favicon.png') }} "/>
  <link rel="stylesheet" href="{{ asset('Modernize/src/assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" style="background-color: black">
    <!-- Sidebar Start -->
    <aside class="left-sidebar" style="background-color:black">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between" >
          <a href="./index.html" class="text-nowrap logo-img">
            <h3 class="text-white" style="margin-left: 10px">SIMPTL</h3>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse" style="background-color: white">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar"   data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu text-white">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('simptl') }}" aria-expanded="false" style="text-decoration: none;color:black">
                <span>
                  <i class="ti ti-layout-dashboard" style="color:white"></i>
                </span>
                <span class="hide-menu text-white">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu text-white">Pengawasan</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('simptl/pkpt') }}" aria-expanded="false" style="text-decoration: none;color:black">
                  <span>
                    <i class="ti ti-layout-dashboard" style="color: white"></i>
                  </span>
                  <span class="hide-menu text-white">PKPT</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('simptl/tipeA') }}" aria-expanded="false" style="text-decoration: none;color:black">
                  <span>
                    <i class="ti ti-layout-dashboard" style="color: white"></i>
                  </span>
                  <span class="hide-menu text-white">Tipe Rekomendasi</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('simptl/tipeB') }}" aria-expanded="false" style="text-decoration: none;color:black">
                  <span>
                    <i class="ti ti-layout-dashboard" style="color: white"></i>
                  </span>
                  <span class="hide-menu text-white">Tipe Temuan dan <br> Rekomendasi</span>
                </a>
              </li>

              <div class="dropdown">

            </div>

            <style>
                .button {
  background-color: #000; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
            </style>

            <li class="sidebar-item">
                <button type="button"  data-toggle="dropdown"  class="button sidebar-link dropdown-toggle"  aria-expanded="false" style="text-decoration: none;color:black">
                    <span>
                        <i class="ti ti-layout-dashboard" style="color: white"></i>
                      </span>
                      <span class="hide-menu text-white">Data Dukung</span>
                    </a>
                </button>

                <div class="dropdown-menu" style="background-color: gray">
                  <a class="dropdown-item" href="{{ url('simptl/data_dukungRekom') }}">Tipe Rekomendasi</a>
                  <a class="dropdown-item" href="{{ url('simptl/data_dukungTemuanRekom') }}">Tipe Temuan dan Rekomendasi</a>
              </div>
            </li>



              {{-- <div class="dropdown">
                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                   Data Dukung
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </div> --}}



              <li class="nav-small-cap" style="margin-top: 80px">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu text-white">Pengguna</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('simptl/pengguna') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-layout-dashboard" style="color: white"></i>
                  </span>
                  <span class="hide-menu text-white">User</span>
                </a>
              </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper" >
      <!--  Header Start -->
      <header class="app-header" style="background-color:black">
        <nav class="navbar navbar-expand-lg navbar-light" >
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2" style="color: white">

                </i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing" style="color: white"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
              <div class="col-xl-8 ">
                <form action="{{ url('simptl/ubahtahun') }}" method="post">
                  @method('post')
                  @csrf
                   <select name="tahun" id="tahun" class="form-control" onchange="submit()" style="background-color: white">
                   <option value="">PILIH TAHUN</option>
                   @for ($i = 2023; $i <= date('Y'); $i++)
                    <option value="{{ $i }}" @if ($i == session('tahun')) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
                </form>

              </div>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('Modernize/src/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="{{ url('logout_simptl') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid" style="background-color:darkkhaki">
        <div class="row">
            <div class="col-12">
                <div class="card" style="background-color: gray">
                    <div class="card-body mt-3" >
                        @yield('content')
                    </div>
                  </div>
            </div>
        </div>
        <div class="py-6 px-6 text-center" style="background-color:white">
          {{-- <p class="mb-0 fs-4 text-info"><b>Design by Inspektorat Kab. Sragen</b></p> --}}
        </div>
      </div>
  <script src="{{ asset('modernize/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('modernize/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('modernize/src/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('modernize/src/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('modernize/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('modernize/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('modernize/src/assets/js/dashboard.js') }}"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
     {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <!-- js untuk bootstrap4  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script> --}}
        <!-- js untuk select2  -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>
