@extends('doctor-dashboard.layout')
@section('title','Reviews')
@section('content')

<main id="main" class="main">
  <div class="d-flex justify-content-between">
    <!-- <div class="pagetitle">
      <h1 class="mb-2">Dashboard</h1>
    </div> -->

    <!-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="./asset/icon/more.png" class="mt-2" alt="" style="width: 30px"></a> -->
  </div>
  <section class="section dashboard">
    <div class="page_title_link">
      <div class="desbord_card d-flex gap-2 align-items-center p-3">
        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 8.5L3.16667 6.83333M3.16667 6.83333L9 1L14.8333 6.83333M3.16667 6.83333V15.1667C3.16667 15.3877 3.25446 15.5996 3.41074 15.7559C3.56702 15.9122 3.77899 16 4 16H6.5M14.8333 6.83333L16.5 8.5M14.8333 6.83333V15.1667C14.8333 15.3877 14.7455 15.5996 14.5893 15.7559C14.433 15.9122 14.221 16 14 16H11.5M6.5 16C6.72101 16 6.93298 15.9122 7.08926 15.7559C7.24554 15.5996 7.33333 15.3877 7.33333 15.1667V11.8333C7.33333 11.6123 7.42113 11.4004 7.57741 11.2441C7.73369 11.0878 7.94565 11 8.16667 11H9.83333C10.0543 11 10.2663 11.0878 10.4226 11.2441C10.5789 11.4004 10.6667 11.6123 10.6667 11.8333V15.1667C10.6667 15.3877 10.7545 15.5996 10.9107 15.7559C11.067 15.9122 11.279 16 11.5 16M6.5 16H11.5" stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">
          <span>Home</span>
        </p>
        <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">Reviews</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
            <div>
              <h3 class="mb-0">All Reviews</h3>
            </div>
           
          </div>

          <div class="table_scroll mt-3">
            <table class="table  table-striped " id="example">
                <thead>
                    <tr>
                        <th scope="col">Client Name</th>
                        <th scope="col">Appointment ID</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Status</th>
                        <th scope="col">Dated</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="">Swami</td>
                        <td>15</td>
                        <td>Very Experienced Doctor</td>
                        <td>Completed</td>
                        <td>15/12/2024</td>
                    </tr>
                    
                   
                </tbody>
            </table>
        </div>

        

        </div>
      </div>
    </div>
    
  </section>
</main>

@endsection
@section('scripts')
<script>

$(document).ready(function(){
  $('.reviews').addClass('active_side');

});

</script>
@endsection