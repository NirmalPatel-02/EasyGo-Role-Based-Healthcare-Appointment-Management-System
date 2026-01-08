@extends('layout.client')
@section('title','Get Your Doctor Appointment Details Here!')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@section('content')

<!-- OPTIONS SECTION STRAT -->
<section class="Option_section py-3">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="asset/img/Book_Appointment.svg" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Book Appointment</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-0">
                        <img src="asset/img/Treatment.svg" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Treatment</h5>

                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="asset/img/Plan_surgery.svg" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Plan my Surgery</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="asset/img/Ask_Question.svg" alt="">
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

<!-- PROFILE TITLE SECTION START -->
<section class="Appointment_Details_Page py-5">
    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div>
                <h3 class="blue_f">Appointment Details</h3>
            </div>
            <div class="Rescheduled d-flex gap-3">
           Today Date:  {{ date('Y-m-d') }}
            </div>
        </div>

        <div class="all_apoint_details">
            <div class="row">
                <div class="col-md-5 py-3">
                    <div class="left_part h-100 p-3">
                        <form>
                            <div class="py-3">
                                <label for="" class="mb-2">First Name</label>
                                <div class="inputFild d-flex align-items-center px-3">
                                    <input type="text" class="border-0 w-100" placeholder="Enter your name" value="{{Auth::user()->first_name}}" name="first_name">
                                </div>
                            </div>
                            <div class="py-3">
                                <label for="" class="mb-2">Last Name</label>
                                <div class="inputFild d-flex align-items-center px-3">
                                    <input type="text" class="border-0 w-100" placeholder="Enter your name" value="{{Auth::user()->last_name}}"  name="last_name">
                                </div>
                            </div>
                            <div class="py-3">
                                <label for="" class="mb-2">Phone Number</label>
                                <div class="inputFild d-flex align-items-center px-3">
                                <input type="text" class="border-0 w-100" placeholder="Enter your Number" value="{{Auth::user()->phone}}" name="phone" 
    maxlength="10" minlength="10" pattern="\d{10}" 
    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" />

                                </div>
                            </div>
                            <div class="py-3">
                                <label for="" class="mb-2">DOB</label>
                                <div class="inputFild d-flex align-items-center px-3">
                                    <input type="date" class="border-0 w-100" value="{{Auth::user()->dob}}"  name="dob">
                                </div>
                            </div>
                            <div class="d-flex gap-3 py-2">
                                <div>
                                    <label for="">Gender Category</label>
                                </div>
                                <label>
                                    <input type="radio" name="gender" value="Male" 
                                        {{ (Auth::user()->gender ?? 'Male') === 'Male' ? 'checked' : '' }}>
                                    Male
                                </label>
                                <label>
                                    <input type="radio" name="gender" value="Female" 
                                        {{ (Auth::user()->gender ?? 'Male') === 'Female' ? 'checked' : '' }}>
                                    Female
                                </label>

                            </div>
</form>
                    </div>
                </div>
                <div class="col-md-7 py-3">
                    <div class="right_part">
                        <div class="row">
                            <div class="col-md-6 py-3">
                                <div class="appointment_date d-flex justify-content-between p-3">
                                    <div>
                                        <svg width="20" height="22" class="mb-2" viewBox="0 0 20 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19 9H1M14 1V5M6 1V5M5.8 21H14.2C15.8802 21 16.7202 21 17.362 20.673C17.9265 20.3854 18.3854 19.9265 18.673 19.362C19 18.7202 19 17.8802 19 16.2V7.8C19 6.11984 19 5.27976 18.673 4.63803C18.3854 4.07354 17.9265 3.6146 17.362 3.32698C16.7202 3 15.8802 3 14.2 3H5.8C4.11984 3 3.27976 3 2.63803 3.32698C2.07354 3.6146 1.6146 4.07354 1.32698 4.63803C1 5.27976 1 6.11984 1 7.8V16.2C1 17.8802 1 18.7202 1.32698 19.362C1.6146 19.9265 2.07354 20.3854 2.63803 20.673C3.27976 21 4.11984 21 5.8 21Z"
                                                stroke="#000066" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                                            @php
                                                            use Carbon\Carbon;

                                                            // Check if dated is not null or empty before formatting
                                                            $formattedDate = $dated ? Carbon::parse($dated)->format('d, M Y') : 'N/A';
                                                        @endphp


                                        <p class="mb-2">Appointment Date</p>
                                        <h5 class="mb-0"> {{ $formattedDate }}</h5>
                                    </div>
                                    <div>
                                        <a href="/book-appointment?hashid={{$sha1}}">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.3335 2.66666H4.5335C3.41339 2.66666 2.85334 2.66666 2.42552 2.88464C2.04919 3.07639 1.74323 3.38235 1.55148 3.75867C1.3335 4.1865 1.3335 4.74655 1.3335 5.86666V11.4667C1.3335 12.5868 1.3335 13.1468 1.55148 13.5746C1.74323 13.951 2.04919 14.2569 2.42552 14.4487C2.85334 14.6667 3.41339 14.6667 4.5335 14.6667H10.1335C11.2536 14.6667 11.8137 14.6667 12.2415 14.4487C12.6178 14.2569 12.9238 13.951 13.1155 13.5746C13.3335 13.1468 13.3335 12.5868 13.3335 11.4667V8.66666M5.33348 10.6667H6.44984C6.77596 10.6667 6.93902 10.6667 7.09247 10.6298C7.22852 10.5972 7.35858 10.5433 7.47788 10.4702C7.61243 10.3877 7.72773 10.2724 7.95833 10.0418L14.3335 3.66666C14.8858 3.11437 14.8858 2.21894 14.3335 1.66666C13.7812 1.11437 12.8858 1.11437 12.3335 1.66665L5.95832 8.04182C5.72772 8.27242 5.61241 8.38772 5.52996 8.52228C5.45685 8.64157 5.40298 8.77163 5.37032 8.90768C5.33348 9.06113 5.33348 9.22419 5.33348 9.55031V10.6667Z"
                                                    stroke="#333333" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 py-3">
                                <div class="appointment_date d-flex justify-content-between p-3">
                                    <div>
                                        <svg width="22" height="22" class="mb-2" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 5V11L15 13M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z"
                                                stroke="#000066" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <p class="mb-2">Appointment Time</p>
                                        <h5 class="mb-0"> {{ $slot }}</h5>
                                    </div>
                                    <div>
                                        <a href="/book-appointment?hashid={{$sha1}}">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.3335 2.66666H4.5335C3.41339 2.66666 2.85334 2.66666 2.42552 2.88464C2.04919 3.07639 1.74323 3.38235 1.55148 3.75867C1.3335 4.1865 1.3335 4.74655 1.3335 5.86666V11.4667C1.3335 12.5868 1.3335 13.1468 1.55148 13.5746C1.74323 13.951 2.04919 14.2569 2.42552 14.4487C2.85334 14.6667 3.41339 14.6667 4.5335 14.6667H10.1335C11.2536 14.6667 11.8137 14.6667 12.2415 14.4487C12.6178 14.2569 12.9238 13.951 13.1155 13.5746C13.3335 13.1468 13.3335 12.5868 13.3335 11.4667V8.66666M5.33348 10.6667H6.44984C6.77596 10.6667 6.93902 10.6667 7.09247 10.6298C7.22852 10.5972 7.35858 10.5433 7.47788 10.4702C7.61243 10.3877 7.72773 10.2724 7.95833 10.0418L14.3335 3.66666C14.8858 3.11437 14.8858 2.21894 14.3335 1.66666C13.7812 1.11437 12.8858 1.11437 12.3335 1.66665L5.95832 8.04182C5.72772 8.27242 5.61241 8.38772 5.52996 8.52228C5.45685 8.64157 5.40298 8.77163 5.37032 8.90768C5.33348 9.06113 5.33348 9.22419 5.33348 9.55031V10.6667Z"
                                                    stroke="#333333" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('doctor', ['showAppointmentButton' => false])
                        <div class="location_detail d-flex align-items-center justify-content-between px-3">
                            <div class="w-100">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 13.2864C2.14864 14.1031 1 15.2412 1 16.5C1 18.9853 5.47715 21 11 21C16.5228 21 21 18.9853 21 16.5C21 15.2412 19.8514 14.1031 18 13.2864M17 7C17 11.0637 12.5 13 11 16C9.5 13 5 11.0637 5 7C5 3.68629 7.68629 1 11 1C14.3137 1 17 3.68629 17 7ZM12 7C12 7.55228 11.5523 8 11 8C10.4477 8 10 7.55228 10 7C10 6.44772 10.4477 6 11 6C11.5523 6 12 6.44772 12 7Z"
                                        stroke="#000066" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <input type="text" class="ms-2 border-0"
                                    value="{{ $doctor->locality }}, {{ $doctor->city }}, {{ $doctor->state }}">
                            </div>
                            <div>
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.41345 9.74448C1.81811 9.51296 1.52043 9.39719 1.43353 9.23039C1.35819 9.08579 1.35809 8.91354 1.43326 8.76886C1.51997 8.60195 1.8175 8.48584 2.41258 8.25361L19.3003 1.66327C19.8375 1.45364 20.1061 1.34883 20.2777 1.40616C20.4268 1.45596 20.5437 1.57292 20.5935 1.72197C20.6509 1.8936 20.5461 2.16219 20.3364 2.69937L13.7461 19.5871C13.5139 20.1822 13.3977 20.4797 13.2308 20.5664C13.0862 20.6416 12.9139 20.6415 12.7693 20.5662C12.6025 20.4793 12.4867 20.1816 12.2552 19.5862L9.6271 12.8282C9.58011 12.7074 9.55661 12.647 9.52031 12.5961C9.48815 12.551 9.44871 12.5115 9.40361 12.4794C9.35273 12.4431 9.29231 12.4196 9.17146 12.3726L2.41345 9.74448Z"
                                        stroke="#333333" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <table class="table table-bordered mt-2">
                        
                       @php
                        $total_amount= $doctor->price+($doctor->price*$settings->gst/100)+$settings->platform_fee;
                        @endphp
                        <tr><th>Doctor Fee</th><td style="text-align:right">{{number_format($doctor->price,2)}}</td></tr>
                        <tr><th>Platform Fee</th><td style="text-align:right">{{number_format($settings->platform_fee,2)}}</td></tr>
                        <tr><th>GST ({{$settings->gst}})%)</th><td style="text-align:right">{{number_format(($doctor->price*$settings->gst/100),2)}}</td></tr>
                        <tr><th>Total Amount</th><td style="text-align:right;font-weight:bold">{{number_format($total_amount,2)}}</td></tr>

                        </tr>

                        </table>

                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">I Agree to the terms and conditions.</label>
                        </div>
                        <a href="javascript:void(0)" class="link-underline link-underline-opacity-0" id="payNowButton" >
                            <div class="Continue_Booking_btn d-flex align-items-center justify-content-center my-3 ">
                                Continue Booking Pay INR. {{$total_amount}}</div>
                        </a>
                        <!-- <a href="#" class="link-underline link-underline-opacity-0">
                            <div class="Cancel_Booking_btn d-flex align-items-center justify-content-center my-3 ">Cancel Booking</div>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- PROFILE TITLE SECTION END -->

<!-- Modal Slot Book Successfully -->
<div class="modal fade" id="SlotBookModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="Slot_Book_model">
                    <div class="text-end">
                        <svg width="22" height="22" data-bs-dismiss="modal" aria-label="Close" viewBox="0 0 22 22"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 8L8 14M8 8L14 14M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z"
                                stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="success_icon_bg d-flex align-items-center justify-content-center">
                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.5478 4.67395C14.3489 4.53014 16.0587 3.82172 17.4338 2.64955C18.9868 1.3268 20.9602 0.600342 23.0002 0.600342C25.0402 0.600342 27.0135 1.3268 28.5666 2.64955C29.9416 3.82172 31.6515 4.53014 33.4526 4.67395C35.4866 4.83651 37.3962 5.71824 38.839 7.16109C40.2819 8.60394 41.1636 10.5135 41.3262 12.5475C41.469 14.3479 42.1774 16.0587 43.3506 17.4335C44.6733 18.9866 45.3998 20.9599 45.3998 22.9999C45.3998 25.04 44.6733 27.0133 43.3506 28.5663C42.1784 29.9414 41.47 31.6512 41.3262 33.4523C41.1636 35.4864 40.2819 37.396 38.839 38.8388C37.3962 40.2817 35.4866 41.1634 33.4526 41.3259C31.6515 41.4697 29.9416 42.1782 28.5666 43.3503C27.0135 44.6731 25.0402 45.3996 23.0002 45.3996C20.9602 45.3996 18.9868 44.6731 17.4338 43.3503C16.0587 42.1782 14.3489 41.4697 12.5478 41.3259C10.5138 41.1634 8.60418 40.2817 7.16134 38.8388C5.71849 37.396 4.83675 35.4864 4.67419 33.4523C4.53039 31.6512 3.82196 29.9414 2.64979 28.5663C1.32705 27.0133 0.600586 25.04 0.600586 22.9999C0.600586 20.9599 1.32705 18.9866 2.64979 17.4335C3.82196 16.0585 4.53039 14.3487 4.67419 12.5475C4.83675 10.5135 5.71849 8.60394 7.16134 7.16109C8.60418 5.71824 10.5138 4.83651 12.5478 4.67395ZM33.3798 19.3795C33.8898 18.8515 34.1721 18.1442 34.1657 17.41C34.1593 16.6759 33.8648 15.9736 33.3457 15.4545C32.8265 14.9353 32.1243 14.6408 31.3901 14.6345C30.656 14.6281 29.9487 14.9103 29.4206 15.4203L20.2002 24.6407L16.5798 21.0203C16.0517 20.5103 15.3444 20.2281 14.6103 20.2345C13.8761 20.2408 13.1738 20.5353 12.6547 21.0545C12.1356 21.5736 11.8411 22.2759 11.8347 23.01C11.8283 23.7442 12.1105 24.4515 12.6206 24.9795L18.2206 30.5795C18.7457 31.1045 19.4577 31.3993 20.2002 31.3993C20.9427 31.3993 21.6547 31.1045 22.1798 30.5795L33.3798 19.3795Z"
                                fill="#13DEB9" />
                        </svg>
                    </div>
                    <div class="text-center mt-3 mb-4">
                        <h4 class="mb-1">Slot Book Successfully! </h4>
                        <div class="d-flex justify-content-center gap-3 py-3">
                            <div class="time_date">
                                <svg width="21" height="22" class="me-2" viewBox="0 0 21 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.5 9H1.5M14.5 1V5M6.5 1V5M6.3 21H14.7C16.3802 21 17.2202 21 17.862 20.673C18.4265 20.3854 18.8854 19.9265 19.173 19.362C19.5 18.7202 19.5 17.8802 19.5 16.2V7.8C19.5 6.11984 19.5 5.27976 19.173 4.63803C18.8854 4.07354 18.4265 3.6146 17.862 3.32698C17.2202 3 16.3802 3 14.7 3H6.3C4.61984 3 3.77976 3 3.13803 3.32698C2.57354 3.6146 2.1146 4.07354 1.82698 4.63803C1.5 5.27976 1.5 6.11984 1.5 7.8V16.2C1.5 17.8802 1.5 18.7202 1.82698 19.362C2.1146 19.9265 2.57354 20.3854 3.13803 20.673C3.77976 21 4.61984 21 6.3 21Z"
                                        stroke="#000066" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>08,Sep 2024
                            </div>
                            <div class="time_date">
                                <svg width="23" height="22" class="me-2" viewBox="0 0 23 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.5 5V11L15.5 13M21.5 11C21.5 16.5228 17.0228 21 11.5 21C5.97715 21 1.5 16.5228 1.5 11C1.5 5.47715 5.97715 1 11.5 1C17.0228 1 21.5 5.47715 21.5 11Z"
                                        stroke="#000066" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>12:00 - 12:15 Pm
                            </div>
                        </div>
                        <div class="time_date">
                            <svg width="23" height="22" class="me-2" viewBox="0 0 23 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.5 13.2864C2.64864 14.1031 1.5 15.2412 1.5 16.5C1.5 18.9853 5.97715 21 11.5 21C17.0228 21 21.5 18.9853 21.5 16.5C21.5 15.2412 20.3514 14.1031 18.5 13.2864M17.5 7C17.5 11.0637 13 13 11.5 16C10 13 5.5 11.0637 5.5 7C5.5 3.68629 8.18629 1 11.5 1C14.8137 1 17.5 3.68629 17.5 7ZM12.5 7C12.5 7.55228 12.0523 8 11.5 8C10.9477 8 10.5 7.55228 10.5 7C10.5 6.44772 10.9477 6 11.5 6C12.0523 6 12.5 6.44772 12.5 7Z"
                                    stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Apollo Spectra Hospitals Chirag Enclave
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
   var order_id = 0;

$(document).ready(function () {
    // Disable the button initially
    // $('#payNowButton').addClass('disabled').css('pointer-events', 'none');

    // Enable/Disable button based on checkbox state
    $('#inlineCheckbox1').change(function () {
        if ($(this).is(':checked')) {
            $('#payNowButton').removeClass('disabled').css('pointer-events', 'auto');
        } else {
            $('#payNowButton').addClass('disabled').css('pointer-events', 'none');
        }
    });

    // Remove error styling when the user starts typing or selects an option
    $('input').on('input', function () {
        const parent = $(this).closest('.inputFild');
        parent.removeClass('error-highlight');
        parent.next('.error-message').remove();
    });

    // For radio buttons
    $('input[name="gender"]').on('change', function () {
        const parent = $(this).closest('.d-flex');
        parent.removeClass('error-highlight');
        parent.next('.error-message').remove();
    });

    // On button click
    document.getElementById('payNowButton').addEventListener('click', function () {
        // Clear previous error highlights
        $('.error-highlight').removeClass('error-highlight');
        $('.error-message').remove();

        // Validate form fields
        const firstName = $('input[name="first_name"]').val().trim();
        const lastName = $('input[name="last_name"]').val().trim();
        const phone = $('input[name="phone"]').val().trim();
        const dob = $('input[name="dob"]').val().trim();
        const gender = $('input[name="gender"]:checked').val();

        let hasError = false;

        // Helper function to show error on the field's parent
        function showError(selector, message) {
            const inputFild = $(selector).closest('.inputFild');
            inputFild.addClass('error-highlight');
            inputFild.after(`<span class="error-message text-danger">${message}</span>`);
            hasError = true;
        }

        // Check individual fields and show error
        if (!firstName) {
            showError('input[name="first_name"]', 'Required.');
        }
        if (!lastName) {
            showError('input[name="last_name"]', 'Required.');
        }
        if (!phone) {
            showError('input[name="phone"]', 'Required.');
        }
        if (!dob) {
            showError('input[name="dob"]', 'Required.');
        }
        if (!gender) {
            $('input[name="gender"]').closest('.d-flex').addClass('error-highlight');
            $('input[name="gender"]').closest('.d-flex').after(`<span class="error-message text-danger">Gender selection is required.</span>`);
            hasError = true;
        }

        // If there's any error, stop further execution
        if (hasError) {
            Swal.fire({
                icon: "error",
                title: "Missing Information",
                text: "Please fill in all the required fields to continue.",
                confirmButtonText: "Okay",
            });
            return;
        }

        // Check if terms and conditions are accepted
        if (!$('#inlineCheckbox1').is(':checked')) {
            Swal.fire({
                icon: "error",
                title: "Terms Not Accepted!",
                text: "Please agree to the terms and conditions to continue.",
                confirmButtonText: "Okay",
            });
            return; // Stop further execution
        }

        // Show the processing spinner and message
        Swal.fire({
    title: "Processing...",
    text: "Please do not click back or close this page while we are processing your payment.",
    html: '<div class="spinner"></div>',  // Use the above spinner here
    showConfirmButton: false,
    allowOutsideClick: false
});

        // Call the backend to create the order
        $.ajax({
            url: '/razorpay/create-order', // Route to your backend createOrder method
            method: 'POST',
            data: {
                amount: {{$doctor->price+($doctor->price*$settings->gst/100)+$settings->platform_fee}}, // Amount to pay in INR
                doctor_id: "{{ $doctor->id }}",
                dated: "{{ $dated }}",
                time_slot: "{{ $slot }}",
                first_name: firstName,
                last_name: lastName,
                phone: phone,
                dob: dob,
                gender: gender,
                _token: "{{ csrf_token() }}" // CSRF token for security
            },
            success: function (response) {
                const orderId = response.order_id; // Save the order_id for verification

                const options = {
                    key: "rzp_test_bbRtA8Osny0og0", // Razorpay API Key
                    amount: response.amount, // Amount in paise
                    currency: "INR",
                    name: "Doctor Appointment",
                    description: `Payment for Dr. {{ ucwords(strtolower($doctor->first_name)) }}`,
                    image: "{{ asset('avatars/' . $doctor->avatar) }}",
                    order_id: orderId, // Use the saved order_id here
                    handler: function (paymentResponse) {
                        const verificationData = {
                            payment_id: paymentResponse.razorpay_payment_id,
                            order_id: orderId, // Pass the same order_id here
                            doctor_id: "{{ $doctor->id }}",
                            dated: "{{ $dated }}",
                            time_slot: "{{ $slot }}",
                            first_name: firstName,
                            last_name: lastName,
                            phone: phone,
                            dob: dob,
                            gender: gender,
                            _token: "{{ csrf_token() }}"
                        };

                        // Show the processing spinner during verification
                     
                        Swal.fire({
    title: "Verifying Payment...",
    text: "Please do not click back or close this page while we are verifying your payment.",
    html: '<div class="spinner"></div>',  // Use the above spinner here
    showConfirmButton: false,
    allowOutsideClick: false
});
                        // Verify the payment
                        $.ajax({
                            url: '/razorpay/verify-payment',
                            method: 'POST',
                            data: verificationData,
                            success: function (result) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Payment Verified!",
                                    text: result.message || "Your payment has been successfully verified.",
                                    confirmButtonText: "Go to Appointments",
                                }).then(() => {
                                    window.location.href = '{{route('client.appointments')}}';
                                });
                            },
                            error: function (xhr) {
                                const error = JSON.parse(xhr.responseText);
                                Swal.fire({
                                    icon: "error",
                                    title: "Verification Failed!",
                                    text: error.message || "Something went wrong while verifying the payment.",
                                    confirmButtonText: "Retry",
                                });
                            }
                        });
                    },
                    prefill: {
                        name: `${firstName} ${lastName}`,
                        email: "{{ $doctor->email }}",
                        contact: phone,
                    },
                    notes: {
                        address: "{{ $doctor->address }}",
                    },
                    theme: {
                        color: "#3399cc",
                    },
                };

                const rzp = new Razorpay(options);
                rzp.open();
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Order Creation Failed!",
                    text: "Unable to create an order. Please try again.",
                    confirmButtonText: "Retry",
                });
            }
        });
    });
});
</script>

<style>
.inputFild.error-highlight {
    border: 2px solid red !important;
    border-radius: 5px;
}

.error-message {
    font-size: 0.875rem;
    color: red;
    margin-top: 5px;
    display: block;
}

</style>
<style>
    .spinner {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 6px solid #f3f3f3; /* Light gray color */
        border-top: 6px solid blue; /* Blue color for the top */
        border-bottom: 6px solid red; /* Red color for the bottom */
        animation: spin 1.5s linear infinite;
        margin:0px auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>



@endsection