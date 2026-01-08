@extends('doctor-dashboard.layout')
@section('title','Doctor Dashboard')
@section('content')

<main id="main" class="main">
  <div class="d-flex justify-content-between">
    
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="DR_Name d-flex flex-wrap justify-content-between">
            <div>
              <h3>  @php
            $hour = date('H'); // Get the current hour in 24-hour format
        @endphp

        @if ($hour < 12)
            Good Morning!
        @elseif ($hour < 18)
            Good Afternoon!
        @else
            Good Evening!
        @endif Dr.  {{ ucwords(strtolower($doctor->first_name)) }} {{ ucwords(strtolower($doctor->last_name)) }}</h3>
        <div class="row">
    
    <div class="col strong text-{{($doctor->status==='Approved')?'success':'danger'}} fs-14">
        Account Status: {{$doctor->status}} 
        
    @if($doctor->status==='Pending' && $doctor->city===null)
    <span class="  text-danger">, Please Complete your <a href="editprofile" class="badge badge-sm bg-primary text-white">profile</a></span>
    @endif
   
    @if($slots->count()<=0)
    <span class="  text-danger">, No Slots added <a href="slots" class="badge badge-sm bg-danger text-white">Add Slots</a></span>
    @endif
    </div>
</div>

            </div>
            <div class="d-flex flex-wrap gap-2">
                <div class="input_fild my-2 px-3">
                    <input type="date" class="filter-input border-0 w-100" name="date">
                </div>
                <div class="input_fild my-2 px-3">
                    <select name="week" id="weekFilter" class="filter-input border-0 w-100">
                        <option value="this_week">This Week</option>
                        <option value="next_week">Next Week</option>
                        <option value="last_week">Last Week</option>
                    </select>
                </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 my-3">
    <div class="desbord_card p-3 h-100">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-2">Today's Appointment</p>
                <h4 class="fw-bold">{{ $todaysAppointments }}</h4>
            </div>
            <div>
                <img src="{{ asset('doctor-asset/img/Today_Appointment.svg') }}" class="w-100" alt="">
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-4 col-sm-6 my-3">
    <div class="desbord_card p-3 h-100">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-2">Total Appointments</p>
                <h4 class="fw-bold">{{ $totalAppointments }}</h4>
            </div>
            <div>
                <img src="{{ asset('doctor-asset/img/Total_Appointed.svg') }}" class="w-100" alt="">
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-4 col-sm-6 my-3">
    <div class="desbord_card p-3 h-100">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-2">Remaining Appointments</p>
                <h4 class="fw-bold">{{ $remainingAppointments }}</h4>
            </div>
            <div>
                <img src="{{ asset('doctor-asset/img/Remaining_Appointment.svg') }}" class="w-100" alt="">
            </div>
        </div>
    </div>
</div>

    </div>

    <div class="Appointments_Details">
      <div class="row">
        <div class="col-md-8">
          <div class="desbord_card p-3 h-100">
            <div class="Upcoming_Appointments">
              <div class=" d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="fw-bold">Upcoming Appointments</h3>
                </div>
                <div>
                  <a href="{{route('doctor.appointments').'?status=Confirmed'}}" class="fw-bold">View More</a>
                </div>
              </div>
              <div class="my_slider position-relative my-4 py-2">
                  <!-- Swiper -->
                  <div class="left_right_arrow position-absolute">
                      <div class="swiper-button-next">
                          <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_10_2020)">
                                  <g clip-path="url(#clip1_10_2020)">
                                      <path d="M12.7734 10.9132C13.0168 10.9132 13.2484 10.8182 13.4276 10.6149C13.7734 10.2357 13.7484 9.63991 13.3893 9.27324L8.52844 4.42074C8.44406 4.33679 8.3434 4.27099 8.23265 4.22739C8.1219 4.18379 8.0034 4.16331 7.88444 4.16722C7.76547 4.17112 7.64857 4.19932 7.54091 4.25009C7.43326 4.30085 7.33713 4.37311 7.25844 4.46241C6.9126 4.84158 6.9376 5.43741 7.29677 5.80408L12.1576 10.6557C12.3376 10.8316 12.5551 10.9132 12.7734 10.9132Z" fill="#121414" />
                                      <path d="M7.91226 15.8199C8.13059 15.8199 8.36143 15.7383 8.52809 15.5616L13.3889 10.6424C13.5622 10.4636 13.6612 10.2256 13.6658 9.97654C13.6705 9.72751 13.5805 9.486 13.4139 9.30078C13.3352 9.21103 13.2387 9.13863 13.1305 9.08818C13.0223 9.03774 12.9048 9.01036 12.7854 9.00777C12.666 9.00518 12.5474 9.02745 12.4372 9.07316C12.3269 9.11887 12.2273 9.18702 12.1448 9.27328L7.28393 14.1933C7.11062 14.3722 7.01165 14.6102 7.00701 14.8592C7.00237 15.1082 7.0924 15.3497 7.25893 15.5349C7.43809 15.7249 7.66893 15.8333 7.91226 15.8333V15.8199Z" fill="#121414" />
                                  </g>
                              </g>
                              <defs>
                                  <clipPath id="clip0_10_2020">
                                      <rect width="20" height="20" fill="white" transform="translate(0.339844)" />
                                  </clipPath>
                                  <clipPath id="clip1_10_2020">
                                      <rect width="20" height="20" fill="white" transform="translate(0.339844)" />
                                  </clipPath>
                              </defs>
                          </svg>
                      </div>
                      <div class="swiper-button-prev">
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7.5669 10.9132C7.32357 10.9132 7.0919 10.8182 6.91273 10.6149C6.5669 10.2357 6.5919 9.63991 6.95107 9.27324L11.8119 4.42074C11.8963 4.33679 11.9969 4.27099 12.1077 4.22739C12.2184 4.18379 12.3369 4.16331 12.4559 4.16722C12.5749 4.17112 12.6918 4.19932 12.7994 4.25009C12.9071 4.30085 13.0032 4.37311 13.0819 4.46241C13.4277 4.84158 13.4019 5.43741 13.0436 5.80408L8.18273 10.6557C8.10212 10.7371 8.00621 10.8018 7.90052 10.846C7.79483 10.8902 7.68145 10.913 7.5669 10.9132Z" fill="#121414" />
                              <path d="M12.4276 15.8199C12.2093 15.8199 11.9784 15.7383 11.8118 15.5616L6.95092 10.6424C6.77761 10.4636 6.67864 10.2256 6.674 9.97654C6.66936 9.72751 6.75939 9.486 6.92592 9.30078C7.00464 9.21103 7.10117 9.13863 7.20937 9.08818C7.31758 9.03774 7.43509 9.01036 7.55445 9.00777C7.67381 9.00518 7.7924 9.02745 7.90269 9.07316C8.01298 9.11887 8.11255 9.18702 8.19508 9.27328L13.0559 14.1933C13.4143 14.5599 13.4276 15.1558 13.0809 15.5349C12.9983 15.6268 12.8977 15.7007 12.7853 15.752C12.6729 15.8034 12.5511 15.831 12.4276 15.8333V15.8199Z" fill="#121414" />
                          </svg>
                      </div>
                  </div>
                  <div class="swiper mySwiperBooking_Slots slots_slider">
                  <div class="swiper-wrapper">
    @php
        $today = now()->startOfDay();

        // Filter confirmed appointments and ensure each date appears only once
        $upcomingAppointments = $appointments
            ->where('status', 'Confirmed')
            ->where('dated', '>=', $today->format('Y-m-d'))
            ->unique('dated'); // Ensure unique dates
    @endphp

    @foreach($upcomingAppointments as $appointment)
        @php
            $dayOfWeek = \Carbon\Carbon::parse($appointment->dated)->format('l'); // Full day name
            $isWeekend = in_array($dayOfWeek, ['Saturday', 'Sunday']); // Check if it's Saturday or Sunday
        @endphp
        <div 
            class="swiper-slide clickable-slide" 
            data-url="{{ route('doctor.appointments', ['status' => 'Confirmed', 'dated' => $appointment->dated]) }}"
            style="cursor: pointer;">
            <div class="booking_date p-2" style="{{ $isWeekend ? 'background: rgba(255, 0, 0, 0.1);' : '' }}">
                <h5>
                    <span class="{{ $isWeekend ? 'red_f' : '' }}">
                        {{ \Carbon\Carbon::parse($appointment->dated)->format('D') }}
                    </span>
                </h5>
                <h4 class="mb-0">
                    {{ \Carbon\Carbon::parse($appointment->dated)->format('j') }}
                </h4>
            </div>
        </div>
    @endforeach
</div>





                  </div>
              </div>
            </div>
            <hr>

            <div class="Upcoming_Appointments d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="fw-bold">Recent Appointments </h3>
                </div>
                <div>
                  <a href="{{route('doctor.appointments')}}" class="fw-bold">View More</a>
                </div>
            </div>
            <div class="table_scroll mt-3">
            <table class="table  table-striped " id="example1">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">AGE</th>
                        <th scope="col">PHONE NUMBER</th>
                        <th scope="col">DATE</th>
                        <th scope="col">TIME</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($appointments->where('status', 'Confirmed')->sortByDesc('dated')->take(5) as $row)
                    <tr>
                        <td>{{ ucwords(strtolower($row->first_name)) }} {{ ucwords(strtolower($row->last_name)) }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->dob)->age }} years</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->dated)->format('d/m/Y') }}</td>
                        <td>{{ $row->time_slot }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endforeach

                   
                </tbody>
            </table>
        </div>

          </div>
        </div>
        <div class="col-md-4">
          <div class="desbord_card p-3 h-100">
            <div class="Upcoming_Appointments mb-4 d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="fw-bold">Appointment Request</h3>
                </div>
                <div>
                  <a href="{{route('doctor.appointments')}}?status=Pending" class="fw-bold">View More</a>
              </div>
            </div>
            @foreach ($appointments->where('status', 'Pending') as $appointment)
    <div class="pasent_request m-2 p-3">
        <div class="d-flex gap-2">
            <div class="pasent_img">
                <img src="{{ asset('avatars/'.$appointment->client->avatar) }}" class="w-100" alt="">
            </div>
            <div>
                <h5 class="mb-0">{{ $appointment->first_name.' '.$appointment->last_name }}</h5>
                <p class="mb-0">{{ \Carbon\Carbon::parse($appointment->dated)->format('d M') }},
                    {{ $appointment->time_slot }}</p>
                <p class="mb-0"><td>
    <!-- {{ \Carbon\Carbon::parse($appointment->dob)->format('d/m/Y') }}  -->
    {{ \Carbon\Carbon::parse($appointment->dob)->age }} years
</td></p>
            </div>
        </div>
        <div class="d-flex gap-3">
            <a href="javascript:void(0)" class="w-100 accept-btn" data-id="{{ $appointment->id }}">
                <div class="Accept_btn d-flex justify-content-center align-items-center w-100 mt-3">Accept</div>
            </a>
            <a href="javascript:void(0)" class="w-100 reject-btn" data-id="{{ $appointment->id }}">
                <div class="Reject_btn d-flex justify-content-center align-items-center w-100 mt-3">Reject</div>
            </a>
        </div>
    </div>
    @endforeach
           
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<style>
.clickable-slide {
    cursor: pointer;
}

</style>
@endsection

@section('scripts')

<script>

    $(document).ready(function () {
        const baseRoute = "{{ route('doctor.appointments') }}"; // Replace with your route

// Trigger on change for both filters
$('.filter-input').on('change', function () {
    // Get filter values
    const date = $('input[name="date"]').val();
    const week = $('select[name="week"]').val();

    // Build query parameters
    let params = { status: 'Confirmed' }; // Always include status=Confirmed
    if (date) params.dated = date; // Add date if selected
    if (week) params.week = week; // Add week if selected

    // Construct query string
    const queryString = $.param(params);

    // Redirect to the route with query parameters
    window.location.href = baseRoute + '?' + queryString;
});


    // Handle click event on swiper slides
    $('.swiper-wrapper').on('click', '.clickable-slide', function () {
        // Get the URL from the data-url attribute
        const targetUrl = $(this).data('url');
        
        if (targetUrl) {
            // Redirect to the target URL
            window.location.href = targetUrl;
        } else {
            console.error('No URL found for the clicked slide.');
        }
    });

        $('.nav-link').removeClass('active_side');
        $('.index').addClass('active_side');
        // Handle Accept button click
        $('.accept-btn').click(function () {
            const appointmentId = $(this).data('id');
            updateStatus(appointmentId, 'Confirmed');
        });

        // Handle Reject button click
        $('.reject-btn').click(function () {
            const appointmentId = $(this).data('id');
            updateStatus(appointmentId, 'Rejected');
        });

        // AJAX request to update status
        function updateStatus(appointmentId, status) {
            $.ajax({
                url: "{{ route('doctor.updateStatus', ':id') }}".replace(':id', appointmentId),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: true
                    }).then(() => {
                        location.reload(); // Reload page to update status
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON.message || 'Something went wrong!',
                        timer: 2000,
                        showConfirmButton: true
                    });
                }
            });
        }
    });
</script>

@endsection