<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-asset/dist/css/adminlte.min.css?v=1.2') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/summernote/summernote-bs4.min.css') }}">
  
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin-asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('admin-asset/dist/img/easy_go.png') }}" alt="AdminLTELogo" height="100" width="100">
  </div>
Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   
      
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link"  href="{{route('adminDashboard')}}" >
          <i class="fas fa-user"></i> Admin 
        </a>
      </li>
     <!-- Notifications Dropdown Menu -->
      
     <li class="nav-item">
        <a class="nav-link"  href="{{route('adminLogout')}}" >
          <i class="fas fa-power-off"></i>
        </a>
      </li>
   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: #f8f8f8;overflow:hidden">
    <!-- Brand Logo -->
    <a href="{{route('adminDashboard')}}" class="brand-link">
       <img src="{{asset('admin-asset/dist/img/easy_go.png') }}" alt="EasyGO Logo" class="" style="opacity: .8;width:200px"> 
      <span class="brand-text font-weight-light" style="color: white;">EasyGO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
<!-- Sidebar Menu -->
<nav class="mt-2 ">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <!-- Dashboard -->
    <li class="nav-item">
      <a href="{{ route('adminDashboard') }}" class="nav-link {{ request()->routeIs('adminDashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <!-- Doctors Management -->
    <li class="nav-item has-treeview {{( request()->routeIs('admin.doctorList') && request('status')==null ) || (request()->routeIs('admin.doctorList') && in_array(request('status'), ['Approved', 'Pending', 'Rejected']) )? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{( request()->routeIs('admin.doctorList') && request('status')==null )  ||( request()->routeIs('admin.doctorList') && in_array(request('status'), ['Approved', 'Pending', 'Rejected'])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Doctors 
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('admin.doctorList', ['role'=>'doctor']) }}" class="nav-link {{( request()->routeIs('admin.doctorList') && request('status')==null )   ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>All</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.doctorList', ['status' => 'Approved', 'role'=>'doctor']) }}" class="nav-link {{ request()->routeIs('admin.doctorList') && request('status') == 'Approved' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Approved</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.doctorList', ['status' => 'Pending', 'role'=>'doctor']) }}" class="nav-link {{ request()->routeIs('admin.doctorList') && request('status') == 'Pending' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Pending</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.doctorList', ['status' => 'Rejected', 'role'=>'doctor']) }}" class="nav-link {{ request()->routeIs('admin.doctorList') && request('status') == 'Rejected' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Rejected</p>
          </a>
        </li>
      </ul>
    </li>
 <!-- clients Management -->
 <li class="nav-item has-treeview {{ ( request()->routeIs('admin.clientList') && request('status')==null ) || (request()->routeIs('admin.clientList') && in_array(request('status'), ['Approved', 'Pending', 'Rejected','Blocked']) )? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ ( request()->routeIs('admin.clientList') && request('status')==null ) || (request()->routeIs('admin.clientList') && in_array(request('status'), ['Approved', 'Pending', 'Rejected','Blocked']) )? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Clients
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
      <li class="nav-item">
          <a href="{{ route('admin.clientList', [ 'role'=>'client']) }}" class="nav-link {{( request()->routeIs('admin.clientList') && request('status')==null )   ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>All</p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.clientList', ['status' => 'Blocked', 'role'=>'client']) }}" class="nav-link {{ request()->routeIs('admin.clientList') && request('status') == 'Blocked' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Blocked</p>
          </a>
        </li>
      </ul>
    </li>
    <!-- Appointments -->
    <li class="nav-item has-treeview {{ request()->routeIs('admin.appointmentList') && in_array(request('status'), ['Confirmed','Cancelled','Completed', 'Pending', 'Rejected']) || ( request()->routeIs('admin.appointmentList') && request('created_at')===date('Y-m-d'))? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ request()->routeIs('admin.appointmentList') && in_array(request('status'), ['Confirmed','Cancelled','Completed', 'Pending', 'Rejected']) || ( request()->routeIs('admin.appointmentList') && request('created_at')===date('Y-m-d')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>
          Appointments
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
      <li class="nav-item">
          <a href="{{ route('admin.appointmentList', ['created_at' => date('Y-m-d')]) }}" class="nav-link {{ request()->routeIs('admin.appointmentList') && request('created_at') == date('Y-m-d') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>All</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.appointmentList', ['status' => 'Pending']) }}" class="nav-link {{ request()->routeIs('admin.appointmentList') && request('status') == 'Pending' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Pending</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.appointmentList', ['status' => 'Completed']) }}" class="nav-link {{ request()->routeIs('admin.appointmentList') && request('status') == 'Completed' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Completed</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.appointmentList', ['status' => 'Cancelled']) }}" class="nav-link {{ request()->routeIs('admin.appointmentList') && request('status') == 'Cancelled' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Cancelled</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.appointmentList', ['status' => 'Confirmed']) }}" class="nav-link {{ request()->routeIs('admin.appointmentList') && request('status') == 'Confirmed' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Confirmed</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.appointmentList', ['status' => 'Rejected']) }}" class="nav-link {{ request()->routeIs('admin.appointmentList') && request('status') == 'Rejected' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Rejected</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Transactions -->
    <li class="nav-item">
      <a href="{{ route('admin.wallets') }}" class="nav-link {{ request()->routeIs('admin.wallets') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-invoice-dollar"></i>
        <p>Wallet History</p>
      </a>
    </li>

    <!-- clients Management -->
 <li class="nav-item has-treeview {{ ( request()->routeIs('admin.withdrawals') && request('status')==null ) || (request()->routeIs('admin.withdrawals') && in_array(request('status'), ['Processed', 'Pending', 'Rejected']) )? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ ( request()->routeIs('admin.withdrawals') && request('status')==null ) || (request()->routeIs('admin.withdrawals') && in_array(request('status'), ['Processed', 'Pending', 'Rejected']) )? 'active' : '' }}">
        <i class="nav-icon fas fa-credit-card"></i>
        <p>
          Withdrawals
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
      <li class="nav-item">
          <a href="{{ route('admin.withdrawals') }}" class="nav-link {{( request()->routeIs('admin.withdrawals') && request('status')==null )   ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>All</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.withdrawals', ['status' => 'Processed']) }}" class="nav-link {{ request()->routeIs('admin.withdrawals') && request('status') == 'Processed' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Processed</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.withdrawals', ['status' => 'Pending']) }}" class="nav-link {{ request()->routeIs('admin.withdrawals') && request('status') == 'Pending' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Pending</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.withdrawals', ['status' => 'Rejected']) }}" class="nav-link {{ request()->routeIs('admin.withdrawals') && request('status') == 'Rejected' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Rejected</p>
          </a>
        </li>
      </ul>
    </li>
    <!-- Refund Management 
    <li class="nav-item">
      <a href="" class="nav-link {{ request()->routeIs('refundRequest') ? 'active' : '' }}">
        <i class="nav-icon fas fa-retweet"></i>
        <p>Refund</p>
      </a>
    </li>
-->
    <!-- Notifications -->
    <li class="nav-item">
       <a href="{{ route('admin.notifications') }}" class="nav-link {{ request()->routeIs('admin.notifications') ? 'active' : '' }}">
       <i class="nav-icon fas fa-bell"></i>
            <p>Notifications</p>
          </a>
    </li>
   

    <!-- Reviews -->
    <li class="nav-item">
      <a href="{{ route('admin.reviews') }}" class="nav-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
        <i class="nav-icon fas fa-star"></i>
        <p>Reviews</p>
      </a>
    </li>
   <!-- Reviews -->
   <li class="nav-item">
      <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th-large"></i>
        <p>Settings</p>
      </a>
    </li>
 <!-- Reviews -->
 <li class="nav-item">
      <a href="{{ route('admin.pages') }}" class="nav-link {{ request()->routeIs('admin.pages') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>Pages</p>
      </a>
    </li>

 <!-- Reviews -->
 <li class="nav-item">
      <a href="{{ route('admin.contactForms') }}" class="nav-link {{ request()->routeIs('admin.contactForms') ? 'active' : '' }}">
        <i class="nav-icon fas fa-inbox"></i>
        <p>Contact Forms</p>
      </a>
    </li>


    <!-- Logout -->
    <li class="nav-item pb-5 mb-5">
      <a href="{{ route('admin.change-password.update') }}" class="nav-link">
        <i class="nav-icon fas fa-key"></i>
        <p>Change Password</p>
      </a>
    </li>

  </ul>
  <div class="mt-5 mb-5">&nbsp;</div>
</nav>
<!-- /.sidebar-menu -->


<!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>
  @yield('content')




  <footer class="main-footer">
    <strong>Copyright &copy; 2001-2024 <a href="">Easy Go</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin-asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{asset('admin-asset/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{asset('admin-asset/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{asset('admin-asset/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin-asset/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin-asset/plugins/moment/moment.min.js') }}"></script>
<script src="{{asset('admin-asset/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Bootstrap Switch -->


<!-- Select2 -->
<script src="{{asset('admin-asset/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin-asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{asset('admin-asset/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin-asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-asset/dist/js/adminlte.js') }}"></script>

<!-- AdminLTE for demo purposes -->


@yield('scripts')
<style>
  /* Custom CSS for smaller submenus */
.nav-sidebar .nav-item .nav-treeview .nav-item a {
  padding-left: 2rem;
  font-size: 0.9rem;
}

/* Highlight active items */
  .nav-sidebar .nav-treeview .nav-item .nav-link {
    font-size: 14px; /* Smaller font size */
    padding-left: 30px; /* Indent submenu items */
  }
  .nav-sidebar .nav-treeview .nav-icon {
    font-size: 12px; /* Smaller submenu icon */
  }
  
  .table td,.table th{border-collapse:collapse;white-space: nowrap;}
 
  .nav-sidebar>.nav-item .nav-icon.far{
        font-size: 0.5rem;
  }
  .nav-pills .nav-link {
    color: #000060;
}
.nav-sidebar .menu-open > .nav-link, .nav-sidebar .nav-link.active {
    background-color: #000060;
    color: white;
}

.nav-pills .nav-link:not(.active):hover {
    color: #fe3232;
}


.dataTable h3 {
    color: #000;
    font-size: 24px;
    font-weight: 800;
}
.dataTable .search_fild {
    background: #f5f9fa;
    border: 1px solid #f5f9fa;
    border-radius: 8px;
    height: 40px;
}
.dataTable .search_fild input {
    outline: none;
    background: transparent;
}
.dataTable .table_scroll table {
    width: 100%;
}
.dataTable .table_scroll table thead tr th {
    font-size: 12px;
    font-weight: 700;
    font-family: "Montserrat", sans-serif;
    color: #202224;
}
.dataTable .table_scroll table tbody tr td {
    color: #202224;
    font-size: 12px;
    font-weight: 500;
    font-family: "Montserrat", sans-serif;
}
.dataTable .table_scroll table tbody tr .name_fild {
    width: 110px;
}
.dataTable .table_page_list .pagination ul {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    background: #fff;
    padding: 8px;
    border-radius: 50px;
}
.dataTable .table_page_list .pagination ul li {
    color: #202224;
    list-style: none;
    line-height: 34px;
    text-align: center;
    font-size: 14px;
    font-weight: 400;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    transition: all 0.3s ease;
}
.dataTable .table_page_list .pagination ul li.numb {
    list-style: none;
    height: 30px;
    width: 30px;
    margin: 0 3px;
    line-height: 29px;
    border-radius: 24%;
    border: 1px solid #e0e0e0;
}
.dataTable .table_page_list .pagination ul li.numb.first {
    margin: 0px 3px 0 -5px;
}
.dataTable .table_page_list .pagination ul li.numb.last {
    margin: 0px -5px 0 3px;
}
.dataTable .table_page_list .pagination ul li.dots {
    font-size: 22px;
    cursor: default;
}
.dataTable .table_page_list .pagination ul li.btn {
    padding: 0 20px;
    border-radius: 5px;
}
.dataTable .table_page_list .pagination li.active {
    color: #fff;
    background: #000066;
}
body>.table>thead>tr>td, .card-body>.table>thead>tr>th {
    border-top-width: 1px; 
}
.small-box,.btn{background:#000060;border-color:#000060;color:#fff}
.small-box .bg-theme{background:#000060;border-color:#000060;color:#fff}
.btn .next,.btn .prev{color:#fff}
.dataTable .table_page_list .pagination ul li.next{color:#fff;}
.dataTable .table_page_list .pagination ul li.prev{color:#fff;}
.small-box .icon {
    color: rgb(255 255 255 / 15%);
    z-index: 0;
}
</style>
</body>
</html>
