@extends('layout.client')
@section('title','Book Doctor Appointments in Just a Click')
@section('content')

<!-- OPTIONS SECTION STRAT -->
<section class="Option_section py-3">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Book_Appointment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Book Appointment</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-0">
                        <img src="{{asset('asset/img/Treatment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Treatment</h5>

                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Plan_surgery.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Plan my Surgery</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Ask_Question.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Ask a Question</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- OPTIONS SECTION END -->

<!-- Book Appointment section START -->
<section class="Book_Appointment_page py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
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
                <div class="left_part">
                    <div>
                        <h2 class="blue_f">Book Appointment</h2>
                    </div>
                    @include('doctor', ['showAppointmentButton' => false])



                    <div class="py-2">
                        <h3>About Dr  {{ ucwords(strtolower($doctor->first_name)) }} {{ ucwords(strtolower($doctor->last_name)) }} </h3>
                    </div>
                    <div class="about_dr p-3">
                    {{$doctor->bio}} 
                    </div>
                    <div class="row py-3">
                   

                    </div>
                    
                </div>
            </div>
            <div class="col-md-5 py-3">
                <div class="right_part px-3 py-4">
                    <div>
                        <h2 class="blue_f">Booking Slots</h2>
                    </div>
                    <div class="my_slider position-relative py-2">
                        <!-- Swiper -->
                        <div class="left_right_arrow position-absolute">
                            <div class="swiper-button-next">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_10_2020)">
                                        <g clip-path="url(#clip1_10_2020)">
                                            <path
                                                d="M12.7734 10.9132C13.0168 10.9132 13.2484 10.8182 13.4276 10.6149C13.7734 10.2357 13.7484 9.63991 13.3893 9.27324L8.52844 4.42074C8.44406 4.33679 8.3434 4.27099 8.23265 4.22739C8.1219 4.18379 8.0034 4.16331 7.88444 4.16722C7.76547 4.17112 7.64857 4.19932 7.54091 4.25009C7.43326 4.30085 7.33713 4.37311 7.25844 4.46241C6.9126 4.84158 6.9376 5.43741 7.29677 5.80408L12.1576 10.6557C12.3376 10.8316 12.5551 10.9132 12.7734 10.9132Z"
                                                fill="#121414" />
                                            <path
                                                d="M7.91226 15.8199C8.13059 15.8199 8.36143 15.7383 8.52809 15.5616L13.3889 10.6424C13.5622 10.4636 13.6612 10.2256 13.6658 9.97654C13.6705 9.72751 13.5805 9.486 13.4139 9.30078C13.3352 9.21103 13.2387 9.13863 13.1305 9.08818C13.0223 9.03774 12.9048 9.01036 12.7854 9.00777C12.666 9.00518 12.5474 9.02745 12.4372 9.07316C12.3269 9.11887 12.2273 9.18702 12.1448 9.27328L7.28393 14.1933C7.11062 14.3722 7.01165 14.6102 7.00701 14.8592C7.00237 15.1082 7.0924 15.3497 7.25893 15.5349C7.43809 15.7249 7.66893 15.8333 7.91226 15.8333V15.8199Z"
                                                fill="#121414" />
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
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5669 10.9132C7.32357 10.9132 7.0919 10.8182 6.91273 10.6149C6.5669 10.2357 6.5919 9.63991 6.95107 9.27324L11.8119 4.42074C11.8963 4.33679 11.9969 4.27099 12.1077 4.22739C12.2184 4.18379 12.3369 4.16331 12.4559 4.16722C12.5749 4.17112 12.6918 4.19932 12.7994 4.25009C12.9071 4.30085 13.0032 4.37311 13.0819 4.46241C13.4277 4.84158 13.4019 5.43741 13.0436 5.80408L8.18273 10.6557C8.10212 10.7371 8.00621 10.8018 7.90052 10.846C7.79483 10.8902 7.68145 10.913 7.5669 10.9132Z"
                                        fill="#121414" />
                                    <path
                                        d="M12.4276 15.8199C12.2093 15.8199 11.9784 15.7383 11.8118 15.5616L6.95092 10.6424C6.77761 10.4636 6.67864 10.2256 6.674 9.97654C6.66936 9.72751 6.75939 9.486 6.92592 9.30078C7.00464 9.21103 7.10117 9.13863 7.20937 9.08818C7.31758 9.03774 7.43509 9.01036 7.55445 9.00777C7.67381 9.00518 7.7924 9.02745 7.90269 9.07316C8.01298 9.11887 8.11255 9.18702 8.19508 9.27328L13.0559 14.1933C13.4143 14.5599 13.4276 15.1558 13.0809 15.5349C12.9983 15.6268 12.8977 15.7007 12.7853 15.752C12.6729 15.8034 12.5511 15.831 12.4276 15.8333V15.8199Z"
                                        fill="#121414" />
                                </svg>
                            </div>
                        </div>
                        <div class="swiper mySwiperBooking_Slots slots_slider">
    <div class="swiper-wrapper">
        @php
            use Carbon\Carbon;
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addMonths(2);
        @endphp

        @while ($startDate->lte($endDate))
            <div class="swiper-slide">
                <div class="booking_date p-2" style="background: rgba(0, 0, 102, 0.07);">
                    <h5>
                        <span class="{{ $startDate->isSaturday() || $startDate->isSunday() ? 'red_f' : '' }}">
                            {{ $startDate->format('D') }}
                        </span>
                    </h5>
                    <h4 class="mb-0 date-clickable" data-date="{{ $startDate->format('Y-m-d') }}">
                        {{ $startDate->format('d') }}
                    </h4>
                </div>
            </div>
            @php
                $startDate->addDay();
            @endphp
        @endwhile
    </div>
</div>



                    </div>
                    <div id="time-slots"></div>
                    <div class="row">
                    <div class="col-md-12">
                    <form id="booking-form" action="/appointments/{{$appointment->id}}/update" method="post" style="">
                    @csrf
                    <input type="hidden" name="doctor_id" id="doctor_id">
                    <input type="hidden" name="dated" id="dated">
                    <input type="hidden" name="time_slot" id="slot">
                    <input type="hidden" name="status" value="Pending" id="status">
                    <button type="button" id="continue-booking-link" class="btn btn-danger btn-block w-100 mt-2 " style="background:#ff0000;" >
                    Reschedule Booking
                </button>
                </form>
                   


                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Book Appointment section END -->


@endsection

@section('scripts')


<style>
    .red_f {
        color: red;
    }
  
    .morning_time {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        background-color: #f9f9f9;
    }

    .morning_time.selected {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .morning_time.disabled {
        background-color: #e0e0e0;
        color: #888;
        cursor: not-allowed;
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script>
 $(document).ready(function () {
    let selectedDate = ''; // Declare selectedDate globally
    let selectedSlot = ''; // Declare selectedSlot globally

    // Function to update time slots
    const updateTimeSlots = (selectedDate) => {
        const doctorId = "{{$doctor->id}}"; // Assuming the doctor_id is stored in a hidden input field
        $.ajax({
            url: '/available-slots', // Your Laravel route for fetching available slots
            method: 'GET',
            data: {
                doctor_id: doctorId, // Send doctor_id and selected date
                dated: selectedDate
            },
            success: function(response) {
                const morningSlots = response.available_slots.morning;
                const afternoonSlots = response.available_slots.afternoon;
                const bookedMorningSlots = response.booked_slots.morning;
                const bookedAfternoonSlots = response.booked_slots.afternoon;

                // Clear previous slots
                $('#time-slots').html('');

                // Populate morning slots
                $('#time-slots').append(`
                    <div class="">
                        <div class="Slot_title d-flex align-items-center py-3 gap-2">
                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 1V3M4.31412 5.31412L2.8999 3.8999M17.6858 5.31412L19.1 3.8999M5 13C5 9.68629 7.68629 7 11 7C14.3137 7 17 9.68629 17 13M21 13H1M18 17H4"
                                    stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Morning Slot
                        </div>
                        <div class="row">
                            ${morningSlots.map(slot => `
                                <div class="col-6 col-md-6 col-lg-3 py-2">
                                    <div class="morning_time text-center ${bookedMorningSlots.includes(slot) ? 'disabled' : ''}" 
                                        data-slot="${slot}">
                                        ${slot}
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `);

                // Populate afternoon slots
                $('#time-slots').append(`
                    <div class=" mt-2">
                        <div class="Slot_title d-flex align-items-center py-3 gap-2">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 1V3M11 19V21M3 11H1M5.31412 5.31412L3.8999 3.8999M16.6859 5.31412L18.1001 3.8999M5.31412 16.69L3.8999 18.1042M16.6859 16.69L18.1001 18.1042M21 11H19M16 11C16 13.7614 13.7614 16 11 16C8.23858 16 6 13.7614 6 11C6 8.23858 8.23858 6 11 6C13.7614 6 16 8.23858 16 11Z"
                                    stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Afternoon Slot
                        </div>
                        <div class="row">
                            ${afternoonSlots.map(slot => `
                                <div class="col-6 col-md-6 col-lg-3 py-2">
                                    <div class="morning_time text-center ${bookedAfternoonSlots.includes(slot) ? 'disabled' : ''}" 
                                        data-slot="${slot}">
                                        ${slot}
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `);
            }
        });
    };

    // Event listener for clicking on a date
    $('.date-clickable').on('click', function () {
        selectedDate = $(this).data('date'); // Set the selected date
        updateTimeSlots(selectedDate);
        updateContinueBookingLink();
        // Highlight the selected date with light blue/green color
        $('.date-clickable').removeClass('active-date'); // Remove the class from all dates
        $(this).addClass('active-date'); // Add the class to the clicked date
    });

    // Event listener for clicking on a slot
    $('#time-slots').on('click', '.morning_time:not(.disabled)', function () {
        selectedSlot = $(this).data('slot'); // Set the selected slot
        // Remove previous selection
        $('.morning_time').removeClass('selected');
        // Mark this slot as selected
        $(this).addClass('selected');
        updateContinueBookingLink();
    });

    // Function to update the "Continue Booking" link with the selected date and time slot
    function updateContinueBookingLink() {
        const button = $('#continue-booking-link');

        if (selectedDate && selectedSlot) {
            // Enable the button
            button.removeClass('disabled');
        } else {
            // Disable the button if no slot is selected
            button.addClass('disabled');
        }
    }

    $('#continue-booking-link').on('click', function (e) {
        $('#doctor_id').val("{{$doctor->id}}"); // Make sure to define doctorId in your JS code
        $('#dated').val(selectedDate);  // Make sure to define selectedDate in your JS code
        $('#slot').val(selectedSlot);   // Make sure to define selectedSlot in your JS code

        const dated = document.getElementById('dated').value;
        
        const timeSlot = document.getElementById('slot').value;

        if (!dated || !timeSlot) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Details',
                text: 'Please select a date and time slot before proceeding.',
            });
        } else {
            document.getElementById('booking-form').submit();
        }
    });

    // Trigger click on the first date to load slots by default
    $('.date-clickable').first().trigger('click');
});



</script>

<style>
    .red_f {
        color: red;
    }
  
    .morning_time {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        background-color: #f9f9f9;
    }

    .morning_time.selected {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .morning_time.disabled {
        background-color: #e0e0e0;
        color: #888;
        cursor: not-allowed;
    }
/* Light blue effect for selected date */
.date-clickable.active-date {
    background-color: lightblue; /* Light blue background */
    color: #fff; /* White text */
    border-radius: 5px; /* Optional, for rounded corners */
    transition: background-color 0.3s ease;
}

/* Green effect for selected date */
.date-clickable.active-date {
    background-color: lightgreen; /* Light green background */
    color: #fff; /* White text */
    border-radius: 5px; /* Optional, for rounded corners */
    transition: background-color 0.3s ease;
}

/* Optional: Styling for when the date is hovered over */
.date-clickable:hover {
    background-color: rgba(173, 216, 230, 0.5); /* Light blue hover */
}

</style>
@endsection