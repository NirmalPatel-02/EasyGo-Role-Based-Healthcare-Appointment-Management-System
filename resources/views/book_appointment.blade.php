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
                    <a href="#" id="continue-booking-link" class="link-underline link-underline-opacity-0 continue-booking-link Continue_Booking_btn d-flex align-items-center justify-content-center my-3" disabled="disabled">
    Continue Booking
</a>

<!-- Hidden form to send data -->
<form id="booking-form" action="{{ route('appointmentDetails') }}" method="GET" style="display: none;">
    @csrf
    <input type="hidden" name="doctor_id" id="doctor_id">
    <input type="hidden" name="dated" id="dated">
    <input type="hidden" name="slot" id="slot">
</form>

                </div>
            </div>

            <div class="row py-3">
                    <div class="container">
    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="doctorTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="conditions-tab" data-bs-toggle="tab" data-bs-target="#conditions" type="button" role="tab" aria-controls="conditions" aria-selected="true">
                Conditions & Procedures
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab" aria-controls="education" aria-selected="false">
                Work Experience
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab" aria-controls="gallery" aria-selected="false">
                Gallery
            </button>
        </li> 
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="gallery" aria-selected="false">
                Reviews & Ratings
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content py-3" id="doctorTabsContent">
        <!-- Conditions Tab -->
        <div class="tab-pane fade show active" id="conditions" role="tabpanel" aria-labelledby="conditions-tab">
            <div class="h-100 px-3 py-2">
                @if(!empty($doctor->conditions))
                    <ul>
                        @foreach($doctor->conditions as $condition)
                            <li>{{ $condition->value }}</li>
                        @endforeach
                    </ul>
                @else
                    <p></p>
                @endif
            </div>
        </div>

        <!-- Work Experience Tab -->
        <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
            <div class="h-100 px-3 py-2">
                @if(!empty($doctor->experiences))
                    <ul>
                        @foreach($doctor->experiences as $experience)
                            <li>{{ $experience->name }} ({{ \Carbon\Carbon::parse($experience->from)->format('Y') }} - {{ \Carbon\Carbon::parse($experience->to)->format('Y') }})</li>
                        @endforeach
                    </ul>
                @else
                    <p></p>
                @endif
            </div>
        </div>

        <!-- Gallery Tab -->
        <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
            <div class="h-100 px-3 py-2">
                @if(!empty($doctor->galleries))
                    <div class="row">
                        @foreach($doctor->galleries as $gallery)
                            <div class="col-md-4 py-2">
                                <img src="galleries/{{ $gallery->name }}" alt="Gallery Image" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p></p>
                @endif
            </div>
        </div>

     <!-- Reviews Tab -->
<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
    <div class="h-100 px-3 py-2">
        @if($doctor->reviews->isNotEmpty())
            <div class="row">
                @foreach($doctor->reviews as $review)
                    <div class="col-md-12 py-2">
                        <div class="card mb-3">
                        <div class="card-body">
    <!-- Star Rating -->
    <div class="d-flex align-items-center">
        <i class="fas fa-star text-warning"></i> {{$review->star}}
        
        <!-- Time on the right -->
        <span class="ms-auto text-muted">{{ $review->created_at->diffForHumans() }}</span>
    </div>
    
    <!-- Remarks -->
    <p class="mt-2">{{ $review->remarks }}</p>
</div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No reviews available for this doctor.</p>
        @endif
    </div>
</div>


    </div>
</div>


                    </div>
        </div>
    </div>
</section>
<!-- Book Appointment section END -->

<!-- SIMILAR DOCTOR SLIDER SECTION START -->
<section class="Similar_Doctors_Slider pb-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="title_text">
                <h3 class="blue_f mb-0">Similar Doctors</h3>
            </div>
            <a href="#" class="link-underline link-underline-opacity-0">
                <div class="view_all d-flex align-items-center gap-2 blue_f">
                    View All
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#000066" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
        </div>
        <div class="position-relative">
            <!-- Swiper -->
            <div class="swiper mySwiperSimilarDoctors">
                <div class="swiper-wrapper">
                    @foreach($similarDoctors as $similar)
                    <div class="swiper-slide">
                        <div class="similar_dr p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="dr_img">
                                    <img src="{{ asset('avatars/' . $similar->avatar) }}" class="w-100" alt="">
                                </div>
                                <div class="dr_names">
                                    <h4>Dr. {{$similar->first_name." ".$similar->last_name}}</h4>
                                    <div class="d-flex">
                                        <h5 class="blue_f mb-0">{{$similar->speciality}}</h5>
                                        <ul class="mb-0">
                                            <li class="blue_f mb-0">{{$similar->experience}} Years Exp.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="language_digri">
                                    <svg width="22" height="20" class="me-3" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.913 15H19.087M11.913 15L10 19M11.913 15L14.7783 9.00902C15.0092 8.52627 15.1246 8.2849 15.2826 8.20862C15.4199 8.14228 15.5801 8.14228 15.7174 8.20862C15.8754 8.2849 15.9908 8.52627 16.2217 9.00902L19.087 15M19.087 15L21 19M1 3H7M7 3H10.5M7 3V1M10.5 3H13M10.5 3C10.0039 5.95729 8.85259 8.63618 7.16555 10.8844M9 12C8.38747 11.7248 7.76265 11.3421 7.16555 10.8844M7.16555 10.8844C5.81302 9.84776 4.60276 8.42664 4 7M7.16555 10.8844C5.56086 13.0229 3.47143 14.7718 1 16"
                                            stroke="#333333" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg> {{ $similar->languages->pluck('name')->implode(', ') }}
                                </div>
                                <div class="language_digri">
                                    <svg width="20" height="20" class="me-3" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1 5.8C1 4.11984 1 3.27976 1.32698 2.63803C1.6146 2.07354 2.07354 1.6146 2.63803 1.32698C3.27976 1 4.11984 1 5.8 1H14.2C15.8802 1 16.7202 1 17.362 1.32698C17.9265 1.6146 18.3854 2.07354 18.673 2.63803C19 3.27976 19 4.11984 19 5.8V14.2C19 15.8802 19 16.7202 18.673 17.362C18.3854 17.9265 17.9265 18.3854 17.362 18.673C16.7202 19 15.8802 19 14.2 19H5.8C4.11984 19 3.27976 19 2.63803 18.673C2.07354 18.3854 1.6146 17.9265 1.32698 17.362C1 16.7202 1 15.8802 1 14.2V5.8Z"
                                            stroke="#333333" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11.8333 5.3C11.8333 5.01997 11.8333 4.87996 11.7788 4.773C11.7309 4.67892 11.6544 4.60243 11.5603 4.5545C11.4534 4.5 11.3134 4.5 11.0333 4.5H8.96667C8.68664 4.5 8.54663 4.5 8.43967 4.5545C8.34559 4.60243 8.2691 4.67892 8.22116 4.773C8.16667 4.87996 8.16667 5.01997 8.16667 5.3V7.36667C8.16667 7.64669 8.16667 7.78671 8.11217 7.89366C8.06423 7.98774 7.98774 8.06423 7.89366 8.11217C7.78671 8.16667 7.64669 8.16667 7.36667 8.16667H5.3C5.01997 8.16667 4.87996 8.16667 4.773 8.22116C4.67892 8.2691 4.60243 8.34559 4.5545 8.43967C4.5 8.54663 4.5 8.68664 4.5 8.96667V11.0333C4.5 11.3134 4.5 11.4534 4.5545 11.5603C4.60243 11.6544 4.67892 11.7309 4.773 11.7788C4.87996 11.8333 5.01997 11.8333 5.3 11.8333H7.36667C7.64669 11.8333 7.78671 11.8333 7.89366 11.8878C7.98774 11.9358 8.06423 12.0123 8.11217 12.1063C8.16667 12.2133 8.16667 12.3533 8.16667 12.6333V14.7C8.16667 14.98 8.16667 15.12 8.22116 15.227C8.2691 15.3211 8.34559 15.3976 8.43967 15.4455C8.54663 15.5 8.68664 15.5 8.96667 15.5H11.0333C11.3134 15.5 11.4534 15.5 11.5603 15.4455C11.6544 15.3976 11.7309 15.3211 11.7788 15.227C11.8333 15.12 11.8333 14.98 11.8333 14.7V12.6333C11.8333 12.3533 11.8333 12.2133 11.8878 12.1063C11.9358 12.0123 12.0123 11.9358 12.1063 11.8878C12.2133 11.8333 12.3533 11.8333 12.6333 11.8333H14.7C14.98 11.8333 15.12 11.8333 15.227 11.7788C15.3211 11.7309 15.3976 11.6544 15.4455 11.5603C15.5 11.4534 15.5 11.3134 15.5 11.0333V8.96667C15.5 8.68664 15.5 8.54663 15.4455 8.43967C15.3976 8.34559 15.3211 8.2691 15.227 8.22116C15.12 8.16667 14.98 8.16667 14.7 8.16667H12.6333C12.3533 8.16667 12.2133 8.16667 12.1063 8.11217C12.0123 8.06423 11.9358 7.98774 11.8878 7.89366C11.8333 7.78671 11.8333 7.64669 11.8333 7.36667V5.3Z"
                                            stroke="#333333" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>{{$similar->education}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- SIMILAR DOCTOR SLIDER SECTION END -->

@endsection

@section('scripts')
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>


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
    .card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 1.5rem;
}

.bi {
    font-size: 1.2rem;
}

.card-body p {
    font-size: 1rem;
    color: #333;
}

.card-body .text-muted {
    font-size: 0.9rem;
    font-style: italic;
}

</style>
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
    if (!$(this).hasClass('disabled')) {
        // Set values for the form fields before submitting
        $('#doctor_id').val("{{$doctor->id}}"); // Make sure to define doctorId in your JS code
        $('#dated').val(selectedDate);  // Make sure to define selectedDate in your JS code
        $('#slot').val(selectedSlot);   // Make sure to define selectedSlot in your JS code

        // Submit the form as a GET request
        $('#booking-form').submit(); // This will send a GET request with the form data as query parameters
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

<script>
    var swiper = new Swiper(".mySwiperSimilarDoctors", {
        loop: true,
        freeMode: true,
        spaceBetween: 60,
        grabCursor: true,
        slidesPerView: 2,
        slidesPerGroup: 1,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        freeMode: false,
        speed: 1000,
        freeModeMomentum: false,
        breakpoints: {
            220: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 2.5,
                spaceBetween: 10,
            },
            1330: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
        },
    });
</script>
@endsection