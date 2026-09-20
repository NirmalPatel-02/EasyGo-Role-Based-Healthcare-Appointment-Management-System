<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') - Doctors Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('doctor-asset/img/favicon.png')}}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">


  
  <!-- Vendor CSS Files -->
  <link href="{{asset('doctor-asset/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('doctor-asset/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <!-- <link href="{{asset('doctor-asset/vendor/remixicon/remixicon.css')}}" rel="stylesheet"> -->

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Template Main CSS File -->
  <link href="{{asset('doctor-asset/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('doctor-asset/css/media.css')}}" rel="stylesheet">
</head>

<body>
  <div class="d-none" id="loader"
    style="width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center; position: absolute; z-index: 999;background: #0000002e">
    <div style="width: 200px; height: 200px;">
      <img src="{{asset('doctor-asset/img/loader.gif')}}" alt="" class="w-100 h-100">
    </div>
  </div>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center justify-content-center">
        <img src="{{asset('asset/img/medisync_logo.png')}}" alt="" class="w-50">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->

        <li class="nav-item dropdown mx-md-4">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <svg width="18" height="23" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7 0C5.4087 0 3.88258 0.632141 2.75736 1.75736C1.63214 2.88258 1 4.4087 1 6V9.586L0.293001 10.293C0.153191 10.4329 0.0579847 10.611 0.0194171 10.805C-0.0191505 10.9989 0.000652574 11.2 0.0763226 11.3827C0.151993 11.5654 0.280132 11.7215 0.444542 11.8314C0.608952 11.9413 0.80225 12 1 12H13C13.1978 12 13.391 11.9413 13.5555 11.8314C13.7199 11.7215 13.848 11.5654 13.9237 11.3827C13.9993 11.2 14.0192 10.9989 13.9806 10.805C13.942 10.611 13.8468 10.4329 13.707 10.293L13 9.586V6C13 4.4087 12.3679 2.88258 11.2426 1.75736C10.1174 0.632141 8.5913 0 7 0ZM7 16C6.20435 16 5.44129 15.6839 4.87868 15.1213C4.31607 14.5587 4 13.7956 4 13H10C10 13.7956 9.68393 14.5587 9.12132 15.1213C8.55871 15.6839 7.79565 16 7 16Z"
                fill="#302C36" />
        </svg>
        <span class="badge badge-number">
            {{ \App\Models\Notification::where('doctor_id', Auth::id())->where('status', 'Pending')->count() }}
        </span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        @php
            $notifications = \App\Models\Notification::where('doctor_id', Auth::id())
                ->where('status', 'Pending')
                ->get();
        @endphp

        <li class="dropdown-header">
            You have {{ $notifications->count() }} new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        @foreach ($notifications as $notification)
            <li class="notification-item">
                <i class="bi bi-info-circle text-primary"></i>
                <div>
                    <h4>{{ $notification->title }}</h4>
                    <p>{{ $notification->message }}</p>
                </div>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
        @endforeach

        <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
        </li>
    </ul>
</li>

        <div class="dropdown mt-2">

<div class="admin_menu d-flex align-items-center justify-content-between gap-3 p-1 " type="button"
  data-bs-toggle="dropdown" aria-expanded="false" style="border-radius:50%;box-shadow:none;border-botton:1px solid #000">
  <div class="d-flex gap-2">
    <div class="admin_border" style="box-shadow:none">
      <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" class="w-100" alt="">
    </div>
    <div>
      @auth
  <h6 class="mb-0">{{ Auth::user()->first_name }}
  {{ Auth::user()->last_name }}
  </h6>
  <p class="mb-0">{{ Auth::user()->role }}</p>
@else
<h6 class="mb-0">Guest User</h6>
<p class="mb-0">Guest</p>
@endauth
    </div>
  </div>
  <div>
    <svg width="11" height="7" class="me-3" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M0.292787 0.884878C0.480314 0.697407 0.734622 0.592092 0.999786 0.592092C1.26495 0.592092 1.51926 0.697407 1.70679 0.884878L4.99979 4.17788L8.29279 0.884878C8.38503 0.789368 8.49538 0.713186 8.61738 0.660777C8.73939 0.608368 8.87061 0.580781 9.00339 0.579628C9.13616 0.578474 9.26784 0.603775 9.39074 0.654056C9.51364 0.704337 9.62529 0.77859 9.71918 0.872483C9.81307 0.966376 9.88733 1.07803 9.93761 1.20092C9.98789 1.32382 10.0132 1.4555 10.012 1.58828C10.0109 1.72106 9.9833 1.85228 9.93089 1.97428C9.87848 2.09629 9.8023 2.20663 9.70679 2.29888L5.70679 6.29888C5.51926 6.48635 5.26495 6.59166 4.99979 6.59166C4.73462 6.59166 4.48031 6.48635 4.29279 6.29888L0.292787 2.29888C0.105316 2.11135 0 1.85704 0 1.59188C0 1.32671 0.105316 1.07241 0.292787 0.884878Z"
        fill="#302C36" />
    </svg>
  </div>
</div>


<ul class="dropdown-menu border-0 mt-1 w-100">
  <li>
    <a class="dropdown-item" href="profile">
      <svg width="20" height="19" class="me-2" viewBox="0 0 20 19" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
          d="M9.1665 2.92499H5.6665C4.26637 2.92499 3.56631 2.92499 3.03153 3.19748C2.56112 3.43716 2.17867 3.81961 1.93899 4.29002C1.6665 4.8248 1.6665 5.52486 1.6665 6.92499V13.925C1.6665 15.3251 1.6665 16.0252 1.93899 16.56C2.17867 17.0304 2.56112 17.4128 3.03153 17.6525C3.56631 17.925 4.26637 17.925 5.6665 17.925H12.6665C14.0666 17.925 14.7667 17.925 15.3015 17.6525C15.7719 17.4128 16.1543 17.0304 16.394 16.56C16.6665 16.0252 16.6665 15.3251 16.6665 13.925V10.425M6.66648 12.925H8.06193C8.46959 12.925 8.67341 12.925 8.86522 12.8789C9.03528 12.8381 9.19786 12.7708 9.34698 12.6794C9.51517 12.5763 9.6593 12.4322 9.94755 12.1439L17.9165 4.17499C18.6069 3.48464 18.6069 2.36535 17.9165 1.67499C17.2261 0.984638 16.1069 0.984637 15.4165 1.67499L7.44753 9.64395C7.15928 9.9322 7.01515 10.0763 6.91208 10.2445C6.8207 10.3936 6.75336 10.5562 6.71253 10.7263C6.66648 10.9181 6.66648 11.1219 6.66648 11.5296V12.925Z"
          stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>View Profile
    </a>
  </li>

  <li>
    <a class="dropdown-item" href="{{route('logout')}}">
      <svg width="18" height="17" class="me-2" viewBox="0 0 18 17" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
          d="M13.1667 11.9253L16.5 8.59196M16.5 8.59196L13.1667 5.25863M16.5 8.59196H4.83333M9.83333 11.9253V12.7586C9.83333 13.4217 9.56994 14.0576 9.1011 14.5264C8.63226 14.9952 7.99637 15.2586 7.33333 15.2586H4C3.33696 15.2586 2.70107 14.9952 2.23223 14.5264C1.76339 14.0576 1.5 13.4217 1.5 12.7586V4.42529C1.5 3.76225 1.76339 3.12637 2.23223 2.65753C2.70107 2.18869 3.33696 1.92529 4 1.92529H7.33333C7.99637 1.92529 8.63226 2.18869 9.1011 2.65753C9.56994 3.12637 9.83333 3.76225 9.83333 4.42529V5.25863"
          stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>Logout
    </a>
  </li>
</ul>
</div>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar " style="top:60px">
    <div class="d-flex mobile_side_logo align-items-center justify-content-between my-4 my-sm-0">

    </div>
    <ul class="sidebar-nav h-100 position-relative" id="sidebar-nav">
    
      <li class="nav-item">
        <a class="nav-link index " href="{{route('doctorDashboard')}}">
          <svg width="24" height="25" class="me-2" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M6.39241 5.55121C7.71833 4.49529 9.31546 3.83523 11 3.64697V13.592H20.945C20.7567 15.2765 20.0966 16.8736 19.0407 18.1995C17.9848 19.5255 16.576 20.5263 14.9763 21.0868C13.3767 21.6474 11.6513 21.7449 9.99874 21.3681C8.34615 20.9913 6.83354 20.1555 5.63499 18.957C4.43644 17.7584 3.60068 16.2458 3.22388 14.5932C2.84708 12.9406 2.94456 11.2152 3.50511 9.61559C4.06566 8.01597 5.06649 6.60712 6.39241 5.55121Z"
              stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
              d="M15 9.592H20.488C20.0391 8.32662 19.3135 7.17735 18.3641 6.22794C17.4147 5.27854 16.2654 4.55293 15 4.104V9.592Z"
              stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link appointments" href="{{route('doctor.appointments')}}">
          <svg width="20" height="20" class="me-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M6 10.5918V9.5918M10 10.5918V7.5918M14 10.5918V5.5918M6 18.5918L10 14.5918L14 18.5918M1 1.5918H19M2 1.5918H18V13.5918C18 13.857 17.8946 14.1114 17.7071 14.2989C17.5196 14.4864 17.2652 14.5918 17 14.5918H3C2.73478 14.5918 2.48043 14.4864 2.29289 14.2989C2.10536 14.1114 2 13.857 2 13.5918V1.5918Z"
              stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span>Appointments</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link scheduled" href="{{route('doctor.appointments')}}?status=Confirmed">
          <svg width="22" height="23" class="me-2" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M11 5.5918V11.5918L15 13.5918M21 11.5918C21 17.1146 16.5228 21.5918 11 21.5918C5.47715 21.5918 1 17.1146 1 11.5918C1 6.06895 5.47715 1.5918 11 1.5918C16.5228 1.5918 21 6.06895 21 11.5918Z"
              stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span>Scheduled</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link transactions" href="transactions">
          <svg width="20" height="19" class="me-2" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M19 9.5918C19 8.99506 18.7629 8.42276 18.341 8.00081C17.919 7.57885 17.3467 7.3418 16.75 7.3418H13C13 8.13745 12.6839 8.90051 12.1213 9.46312C11.5587 10.0257 10.7956 10.3418 10 10.3418C9.20435 10.3418 8.44129 10.0257 7.87868 9.46312C7.31607 8.90051 7 8.13745 7 7.3418H3.25C2.65326 7.3418 2.08097 7.57885 1.65901 8.00081C1.23705 8.42276 1 8.99506 1 9.5918M19 9.5918V15.5918C19 16.1885 18.7629 16.7608 18.341 17.1828C17.919 17.6047 17.3467 17.8418 16.75 17.8418H3.25C2.65326 17.8418 2.08097 17.6047 1.65901 17.1828C1.23705 16.7608 1 16.1885 1 15.5918V9.5918M19 9.5918V6.5918M1 9.5918V6.5918M19 6.5918C19 5.99506 18.7629 5.42276 18.341 5.00081C17.919 4.57885 17.3467 4.3418 16.75 4.3418H3.25C2.65326 4.3418 2.08097 4.57885 1.65901 5.00081C1.23705 5.42276 1 5.99506 1 6.5918M19 6.5918V3.5918C19 2.99506 18.7629 2.42276 18.341 2.00081C17.919 1.57885 17.3467 1.3418 16.75 1.3418H3.25C2.65326 1.3418 2.08097 1.57885 1.65901 2.00081C1.23705 2.42276 1 2.99506 1 3.5918V6.5918"
              stroke="#302C36" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <span>Transactions</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link withdrawals" href="withdrawals">
        <svg width="20" height="19" class="me-2" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path
    d="M19 9.5918C19 8.99506 18.7629 8.42276 18.341 8.00081C17.919 7.57885 17.3467 7.3418 16.75 7.3418H3.25C2.65326 7.3418 2.08097 7.57885 1.65901 8.00081C1.23705 8.42276 1 8.99506 1 9.5918V15.5918C1 16.1885 1.23705 16.7608 1.65901 17.1828C2.08097 17.6047 2.65326 17.8418 3.25 17.8418H16.75C17.3467 17.8418 17.919 17.6047 18.341 17.1828C18.7629 16.7608 19 16.1885 19 15.5918V9.5918Z"
    stroke="#302C36" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  <path
    d="M10 4.3418V10.3418M10 10.3418L12.5 7.8418M10 10.3418L7.5 7.8418"
    stroke="#302C36" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>

          <span>Withdrawals</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link slots" href="slots">
        <svg width="20" height="19" class="me-2" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path
    d="M10 1.5918C14.4183 1.5918 18 5.17347 18 9.5918C18 14.0101 14.4183 17.5918 10 17.5918C5.58172 17.5918 2 14.0101 2 9.5918C2 5.17347 5.58172 1.5918 10 1.5918Z"
    stroke="#302C36" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  <path
    d="M10 5.5918V9.5918L12.5 11.0918"
    stroke="#302C36" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  <path
    d="M4 12.0918H6M8 12.0918H10M12 12.0918H14"
    stroke="#302C36" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>


          <span>Slots</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link fee" href="fee">
        <svg width="20" height="20" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 4H17M6 8H17M10 4C10 3.44772 10.4477 3 11 3H16C16.5523 3 17 3.44772 17 4C17 4.55228 16.5523 5 16 5H11C10.4477 5 10 4.55228 10 4ZM10 8C10 7.44772 10.4477 7 11 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H11C10.4477 9 10 8.55228 10 8ZM10 9L16 18H7" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
<span>Fee Setup</span>
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link conditions" href="conditions">
        <svg width="20" height="20" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 2H18C18.553 2 19 2.447 19 3V21C19 21.553 18.553 22 18 22H6C5.447 22 5 21.553 5 21V3C5 2.447 5.447 2 6 2Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M9 10L12 13L15 10" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M9 16H15" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


 <span>Conditions </span>
        </a>
      </li>
      
        
      <li class="nav-item">
        <a class="nav-link galleries" href="galleries">
        <svg width="24" height="24" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect x="2" y="3" width="20" height="18" rx="2" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <circle cx="8" cy="8" r="2" fill="#333333"/>
  <path d="M21 17L16 12L5 21" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>



 <span>Gallery  </span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link banks" href="banks">
        <svg width="20" height="20" class="me-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 7.00002V15M7.5 7.00002V15M12.5 7.00002V15M17 7.00002V15M1 16.6L1 17.4C1 17.9601 1 18.2401 1.10899 18.454C1.20487 18.6422 1.35785 18.7952 1.54601 18.891C1.75992 19 2.03995 19 2.6 19H17.4C17.9601 19 18.2401 19 18.454 18.891C18.6422 18.7952 18.7951 18.6422 18.891 18.454C19 18.2401 19 17.9601 19 17.4V16.6C19 16.04 19 15.7599 18.891 15.546C18.7951 15.3579 18.6422 15.2049 18.454 15.109C18.2401 15 17.9601 15 17.4 15H2.6C2.03995 15 1.75992 15 1.54601 15.109C1.35785 15.2049 1.20487 15.3579 1.10899 15.546C1 15.7599 1 16.04 1 16.6ZM9.65291 1.07715L2.25291 2.7216C1.80585 2.82094 1.58232 2.87062 1.41546 2.99082C1.26829 3.09685 1.15273 3.24092 1.08115 3.40759C1 3.59654 1 3.82553 1 4.28349L1 5.40002C1 5.96007 1 6.2401 1.10899 6.45401C1.20487 6.64217 1.35785 6.79515 1.54601 6.89103C1.75992 7.00002 2.03995 7.00002 2.6 7.00002H17.4C17.9601 7.00002 18.2401 7.00002 18.454 6.89103C18.6422 6.79515 18.7951 6.64217 18.891 6.45401C19 6.2401 19 5.96007 19 5.40002V4.2835C19 3.82553 19 3.59655 18.9188 3.40759C18.8473 3.24092 18.7317 3.09685 18.5845 2.99082C18.4177 2.87062 18.1942 2.82094 17.7471 2.7216L10.3471 1.07715C10.2176 1.04837 10.1528 1.03398 10.0874 1.02824C10.0292 1.02314 9.97077 1.02314 9.91264 1.02824C9.8472 1.03398 9.78244 1.04837 9.65291 1.07715Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>



          <span>Bank Details</span>
        </a>
      </li>

     
    </ul>

  </aside>

  @yield('content')


  <footer id="footer" class="footer">
    <div class="credits">
      © EasyGo Inc 2024
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


  <!-- Yajra Table  -->
  <script src="{{asset('doctor-asset/js/ajax.js')}}"></script>
  <script src="{{asset('doctor-asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('doctor-asset/js/main.js?v=1.0')}}"></script>
  <script src="{{asset('doctor-asset/js/bootstrap5.min.js')}}"></script>
  <script src="{{asset('doctor-asset/js/sweetalert.js')}}"></script>
  
@yield('scripts')
 
  

 
<style>.btn-primary {
    background: #000066;
    border-color: #000066;
}</style>
</body>

</html>