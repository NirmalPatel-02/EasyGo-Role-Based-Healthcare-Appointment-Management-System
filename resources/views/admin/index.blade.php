@extends('admin.admin_layout')
@section('title','Admin Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        <!-- Small boxes (Stat box) --
        $totalcommission 
        $totalplatform 
        $totalgst 
        $totalearnings  
-->
        <div class="row">

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalearnings }}</h3>
                <p>Total Earnings</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('admin.incomes')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalplatform }}</h3>
                <p>Total Platform Fee</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('admin.incomes')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalgst }}</h3>
                <p>Total GST</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('admin.incomes')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalcommission }}</h3>
                <p>Total Commission</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="{{route('admin.incomes')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalBookings }}</h3>
                <p>Total Bookings</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="{{route('admin.appointmentList')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalCustomers }}</h3>
                <p>Total Customers</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{ route('admin.clientList', ['role'=>'client']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $totalDoctors }}</h3>
                <p>Total Doctors</p>
              </div>
              <div class="icon">
                <i class="fas fa-stethoscope"></i>
              </div>
              <a href="{{ route('admin.doctorList', ['role'=>'doctor']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $todayEarnings }}</h3>
                <p>Today Earning</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bill"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $todayBookings }}</h3>
                <p>Today Booking</p>
              </div>
              <div class="icon">
                <i class="fas fa-table"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-theme">
              <div class="inner">
                <h3>{{ $pendingBookings }}</h3>
                <p>Pending Bookings</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
