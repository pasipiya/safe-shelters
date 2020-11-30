<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>
  <link rel="icon" href="{{url('Main/images/logo.png')}}" type="image/gif">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/summernote/summernote-bs4.css')}}">
  <!--Select2-->
  <link href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <!--OpenLayers CSS-->
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/openlayers/dist/ol.css" />
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/ol-geocoder@4.0.0/dist/ol-geocoder.min.css" />
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/ol-popup@2.0.0/src/ol-popup.css" />


</head>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a style="color: blue" href="{{url('/')}}" class="nav-link">Go to Main Page</a>
        </li>

      </ul>



      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">





        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}

            <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4" style="background-color: #000080">
      <!-- Brand Logo -->
      <a href="{{url('/home')}}" class="brand-link">

        <span style="color:white; margin-left:15px"
          class="brand-text font-weight-bold">{{ config('app.name', 'Laravel') }}</span>
      </a>
      <?php $profile_pic=Auth::user()->profile_pic  ?>

      <!-- Sidebar -->
      <div style="color:white" class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('Images/'.$profile_pic)}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a style="color:white" href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



            @if(Auth::check() && (Auth::user()->role == 1))
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p style="color:white">
                  Admin
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/view_users')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p style="color:white">View Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/view_shelters')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p style="color:white">View Shelter</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/add_shelter')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p style="color:white">Add New Shelter</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-header">CMS</li>
            <li class="nav-item">
              <a href="{{url('web_content')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p style="color:white">
                  Main page wording
                </p>
              </a>
            </li>
            @endif




            @if(Auth::check() && (Auth::user()->role == 2))
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p style="color:white">
                  Shelters
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/add_shelter')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p style="color:white">Add New Shelter</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/view_shelters')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p style="color:white">View Shelters</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif




            <li class="nav-header">User Settings</li>
            <li class="nav-item">
              <a href="{{url('userProfile')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p style="color:white">
                  User Profile
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('pass_reset')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p style="color:white">
                  Reset Password
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('logout')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p style="color:white">
                  Log Out
                </p>
              </a>
            </li>





          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>






    <!--Yield Content Here-->

    @yield('content')

    <!--End Yield Content Here-->






    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">DmvSafe</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->



  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE -->
  <script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!--OpenLayers-->
  <script src="https://unpkg.com/openlayers@4.6.5/dist/ol.js"></script>
  <script src="https://unpkg.com/ol-geocoder@4.0.0/dist/ol-geocoder.js"></script>
  <script src="https://unpkg.com/ol-popup@2.0.0/src/ol-popup.js"></script>
  <!--Select2-->
  <script src="{{asset('AdminLTE/plugins/select2/js/select2.min.js')}}"></script>

  @yield('script')

</body>

</html>