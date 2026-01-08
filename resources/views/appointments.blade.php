@extends('layout.client')
@section('title','Find and Schedule Your Doctor Appointment Today')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="Option_section py-3">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Book_Appointment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f"><a href="/">Book Appointment</a></h5>
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
<!-- PROFILE TITLE SECTION START -->
<section class="Appointment_page">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap py-3">
            <div>
                <h3>Appointment</h3>
            </div>
            
        </div>
        <div class="table_scroll">
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
            <table class="table  table-striped " id="example">
                <thead>
                    <tr>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date&Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($appointments as $row)
        @php
        if($row->doctor->status==="Deleted") continue;
            $formattedDate = $row->dated ? \Carbon\Carbon::parse($row->dated)->format('d, M Y') : 'N/A';
        @endphp
        <tr>
            <td class="name_fild">{{ ucwords(strtolower($row->doctor->first_name)) }} {{ ucwords(strtolower($row->doctor->last_name)) }}</td>
            <td>{{ $row->doctor->phone }}</td>
            <td>{{ $row->doctor->address }}, {{ $row->doctor->city }}</td>
            <td>{{ $formattedDate }} : {{ $row->time_slot }}</td>
            <td>
                <span class="badge bg-{{ 
                    $row->status === 'Confirmed' ? 'info' : 
                    ($row->status === 'Cancelled' ? 'warning' : 
                    ($row->status === 'Rejected' ? 'danger' : 
                    ($row->status === 'Completed' ? 'success' : 
                    ($row->status === 'Pending' ? 'primary' : 'secondary')))) 
                }}">
                    {{ $row->status }}
                </span>
            </td>
            <td>
                <div class="d-flex gap-3">
                    <!-- Eye Icon for Viewing Details -->
                    <a href="#" class="view-details-btn" data-bs-toggle="modal" data-bs-target="#appointmentModal"  data-bs-target="#appointmentModal" 
                    data-id="{{ $row->id }}"
                       data-created="{{ \Carbon\Carbon::parse($row->created_at)->format('d, M Y, h:i a') }}"
                       data-patient-name="{{ $row->first_name }} {{ $row->last_name }}"
                       data-patient-dob="{{ $row->dob }}" 
                       data-patient-phone="{{ $row->phone }}" 
                       data-patient-gender="{{ $row->gender }}"
                       data-doctor-name="{{ ucwords(strtolower($row->doctor->first_name)) }} {{ ucwords(strtolower($row->doctor->last_name)) }}"
                       data-doctor-address="{{ $row->doctor->address }}"
                       data-doctor-city="{{ $row->doctor->city }}"
                       data-time-slot="{{ $row->time_slot }}"
                       data-row-dated="{{ $formattedDate }}"
                       data-fee="{{ $row->doctor_price }}"
                       data-payment-id="{{ $row->payment_id }}"
                       data-platform_fee="{{ $row->platform_fee }}"
                       data-gst-percent="{{ $row->gst_percent }}"
                       data-gst-amount="{{ $row->gst_amount }}"
                       data-total-amount="{{ $row->total_amount }}"  
                       data-longitude="{{ $row->doctor->longitude }}"  
                       data-latitude="{{ $row->doctor->latitude }}"  
                    
                    >
                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10 18C13.3137 18 16 14.6863 16 12C16 9.31371 13.3137 6 10 6C6.68629 6 4 9.31371 4 12C4 14.6863 6.68629 18 10 18Z" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 8C8.34315 8 7 9.34315 7 11C7 12.6569 8.34315 14 10 14C11.6569 14 13 12.6569 13 11C13 9.34315 11.6569 8 10 8Z" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                    </a>
                    @if ($row->status !== 'Completed' && $row->status !== 'Cancelled')
    <a href="reschedule-appointment?id={{ $row->id }}">
        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
@endif
@if ($row->status !== 'Completed' && $row->status !== 'Cancelled' )
                    <!-- Cancel Appointment Button -->
                    <a href="#" id="cancel" class="cancel-btn" data-id="{{ $row->id }}">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
@endif
@if ($row->status === 'Completed' )
                    <a href="#" id="rate" class="rate-btn" data-bs-toggle="modal" data-bs-target="#rateModal-{{ $row->id }}">
                <svg width="18" height="18" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" fill="#FFD700" />
                </svg>
                @if($row->review)
                    {{ $row->review->star }}
                @else
                    Add Review
                @endif
            </a>
            @endif

                </div>
            </td>
        </tr>
       <!-- Modal for each appointment -->
<div class="modal fade" id="rateModal-{{ $row->id }}" tabindex="-1" aria-labelledby="rateModalLabel-{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rateModalLabel-{{ $row->id }}">Rate Appointment Ref#{{ $row->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($row->review)
                <div class="review-card">
        <div class="review-header d-flex justify-content-between">
            <h5 class="review-title mb-0">Rating</h5>
            <p class="text-muted mb-0">{{ $row->review->created_at->diffForHumans() }}</p>
        </div>

        <!-- Star Rating -->
        <div class="rating d-flex justify-content-center my-2">
            @for($i = 1; $i <= 5; $i++)
                <i class="fa fa-star {{ $i <= $row->review->star ? 'text-warning' : 'text-secondary' }} star-icon"></i>
            @endfor
        </div>

        <!-- Remarks -->
        <div class="remarks">
            <p><strong>Remarks:</strong> <em>{{ $row->review->remarks }}</em></p>
        </div>
    </div>
                @else
                    @if($row->status == 'Completed')
                        <form id="rateForm-{{ $row->id }}">
                            <input type="hidden" name="appointment_id" value="{{ $row->id }}">
                            <div class="rating d-flex justify-content-center my-3" id="starRating-{{ $row->id }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star star-icon text-secondary" data-value="{{ $i }}" data-id="{{ $row->id }}"></i>
                                @endfor
                            </div>
                            <textarea id="remarks-{{ $row->id }}" name="remarks" class="form-control mt-3" placeholder="Enter your remarks"></textarea>
                            <button type="button" class="btn btn-primary mt-3 w-100 submitReview" data-id="{{ $row->id }}">Submit</button>
                        </form>
                    @else
                        <p>Only completed appointments can be reviewed.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

    @endforeach
</tbody>


            </table>
        </div>
        <div class="py-4">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="py-3">
                <form method="GET" action="{{ url()->current() }}">
    <label for="per_page">Items per page:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
    </select>

    <!-- Add all other query parameters as hidden inputs -->
    @foreach(request()->except('per_page') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>

                </div>
                <div class="table_page_list py-3">
                    <div class="pagination">
                        <ul> <!--pages or li are comes from javascript --> </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
<!-- PROFILE TITLE SECTION END -->
<!-- Modal for Appointment Details -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="text-start">
                        <h5 class="modal-title" id="appointmentModalLabel">Appointment Details</h5>
                    </div>
                    <div class="text-center">
                        <span>#<span id="apId"></span></span>
                    </div>
                    <div class="text-end">
                        <span>Created At: <span id="createdAt"></span></span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-section">
                        <h6 class="section-title blue">Patient Info</h6>
                        <div><span>Name:</span> <span id="patient-name"></span></div>
                        <div><span>DOB:</span> <span id="dob"></span></div>
                        <div><span>Phone:</span> <span id="patient-phone"></span></div>
                        <div><span>Gender:</span> <span id="gender"></span></div>
                    </div>
                    <div class="info-section">
                        <h6 class="section-title red">Doctor Info</h6>
                        <div><span>Name:</span> <span id="doctor-name"></span></div>
                        <div><span>Address:</span> <span id="doctor-address"></span></div>
                        <div><span>City:</span> <span id="doctor-city"></span></div>
                        <h6 class="section-title blue">Appointment Info</h6>
                        <div><span>Time Slot:</span> <span id="time-slot"></span></div>
                        <div><span>Date:</span> <span id="appointment-dated"></span></div>
                    </div>
                    <div class="info-section">
                        <h6 class="section-title red">Payment Info</h6>
                        <div><span>Fee:</span> <span id="fee"></span></div>
                        <div><span>Platform Fee:</span> <span id="platform_fee"></span></div>
                        <div><span>GST (%):</span> <span id="gst-percent"></span></div>
                        <div><span>GST Amount:</span> <span id="gst-amount"></span></div>
                        <div><span>Total Amount:</span> <span id="total-amount"></span></div>
                        <div><span>Payment ID:</span> <span id="payment-id"></span></div>
                    </div>
                </div>

                <!-- Map Section -->
                <h6 class="section-title blue mt-3">Location Info</h6>
                <div id="map-container" class="mb-3" style="width: 100%; height: 300px; border: 1px solid #ddd;"></div>
                <div class="text-end">
                    <a id="view-direction-btn" class="btn btn-primary" target="_blank">View Directions</a>
                </div>
            </div>
            <div class="modal-footer custom-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<style>
/* Custom Modal Header */
.custom-header {
    background-color: #0d6efd;
    color: white;
    padding: 10px 15px;
}

/* Custom Modal Footer */
.custom-footer {
    background-color: #f8f9fa;
    padding: 8px 15px;
}

/* Grid Layout for Info Sections */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

/* Info Section Styling */
.info-section {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 8px;
    font-size: 14px;
    line-height: 1.5;
    background-color: #f9f9f9;
}

/* Section Titles */
.section-title {
    margin-bottom: 5px;
    font-weight: bold;
    padding: 4px 6px;
    border-radius: 3px;
    color: white;
}

/* Blue Theme */
.blue {
    background-color: #007bff;
}

/* Red Theme */
.red {
    background-color: #dc3545;
}

/* Key-Value Pairs */
.info-section div {
    display: flex;
    justify-content: space-between;
    padding: 2px 0;
}

.info-section div span:first-child {
    font-weight: bold;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .info-grid {
        grid-template-columns: 1fr;
    }
}
.modal-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 0;
}

.text-start, .text-center, .text-end {
    flex: 1;
}

.text-center {
    text-align: center;
}
.text-end {
    text-align: right;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkVY54ZKvhxyMy9fJzcK2LS1uIUxVdwEU"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


    $(document).on('click', '.cancel-btn', function (e) {
        e.preventDefault();

        // Get the appointment ID from data-id attribute
        let appointmentId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/appointments/${appointmentId}/cancel`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: response.type,
                            title: response.title,
                            text: response.message,

                            showConfirmButton: true
                        }).then(() => {
                            // Reload the page to update the appointment list
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized',
                                text: 'You are not authorized to perform this action.'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while canceling the appointment. Please try again.'
                            });
                        }
                    }
                });
            }
        });
    });
</script>
<script>
 
 $(document).on('click', '.view-details-btn', function () {
    console.log('Button clicked');

    // Get data attributes from the button
    var patientName = $(this).data('patient-name');
    var id = $(this).data('id');
    var created = $(this).data('created');
    var dob = $(this).data('patient-dob');
    var phone = $(this).data('patient-phone');
    var gender = $(this).data('patient-gender');
    var doctorName = $(this).data('doctor-name');
    var doctorAddress = $(this).data('doctor-address');
    var doctorCity = $(this).data('doctor-city');
    var timeSlot = $(this).data('time-slot');
    var appointmentDated = $(this).data('appointment-dated');
    var fee = $(this).data('fee');
    var paymentId = $(this).data('payment-id');
    var platformFee = $(this).data('platform-fee');
    var gstPercent = $(this).data('gst-percent');
    var gstAmount = $(this).data('gst-amount');
    var longitude = $(this).data('longitude');
    var latitude = $(this).data('latitude');
  
    var totalAmount = $(this).data('total-amount');
console.log($(this).data("payment-id"));
    // Populate modal fields
    $('#patient-name').text(patientName);
    $('#dob').text(dob);
    $('#patient-phone').text(phone);
    $('#gender').text(gender);
    $('#doctor-name').text(doctorName);
    $('#doctor-address').text(doctorAddress);
    $('#doctor-city').text(doctorCity);
    $('#time-slot').text(timeSlot);
    $('#appointment-dated').text(appointmentDated);
    $('#fee').text(fee);
    $('#payment-id').text(paymentId);
    $('#platform_fee').text(platformFee);
    $('#gst-percent').text(gstPercent);
    $('#gst-amount').text(gstAmount);
    
    $('#total-amount').text(totalAmount);
    $('#apId').text(id);
    $('#createdAt').text(created);
    
    var googleMapLink = `https://www.google.com/maps?q=${latitude},${longitude}`;

    // Populate modal fields

    $('#view-direction-btn').attr('href', googleMapLink);

    // Initialize Map
    initMap(latitude, longitude);

    // Show modal
    $('#appointmentModal').modal('show');
});
function initMap(lat, lng) {
    var mapContainer = document.getElementById('map-container');
    var mapOptions = {
        center: { lat: parseFloat(lat), lng: parseFloat(lng) },
        zoom: 15,
    };

    // Create a map instance
    var map = new google.maps.Map(mapContainer, mapOptions);

    // Add a marker
    var marker = new google.maps.Marker({
        position: { lat: parseFloat(lat), lng: parseFloat(lng) },
        map: map,
        title: 'Appointment Location',
    });
}
// Ensure modal closes programmatically as a fallback
$('#appointmentModal').on('hidden.bs.modal', function () {
    console.log('Modal closed');
});
document.querySelector('.btn-close').addEventListener('click', function () {
    var modalElement = document.getElementById('appointmentModal');
    var modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
        modalInstance.hide();
    }
});
function changePage(page) {
    const perPage = document.getElementById('per_page').value;  // Get selected per page value
    const url = new URL(window.location.href);
    url.searchParams.set('page', page); // Update the page parameter
    url.searchParams.set('per_page', perPage);  // Update the per_page parameter
    window.location.href = url.toString();  // Redirect to the updated URL
}

// Selecting required elements
const element = document.querySelector(".pagination ul");
const totalPages = {{ $appointments->lastPage() }};  // Get total pages from the pagination data
const currentPage = {{ $appointments->currentPage() }};  // Get current page from the pagination data

// Call function to generate pagination
element.innerHTML = createPagination(totalPages, currentPage);

function createPagination(totalPages, currentPage) {
    let liTag = '';
    let active;
    let beforePage = currentPage - 1;
    let afterPage = currentPage + 1;

    if (currentPage > 1) {
        liTag += `<li class="btn prev" onclick="changePage(${currentPage - 1})">
                    <span><i class="fas fa-angle-left"></i> Prev</span>
                  </li>`;
    }

    if (currentPage > 2) {
        liTag += `<li class="first numb" onclick="changePage(1)">
                    <span>1</span>
                  </li>`;
        if (currentPage > 3) {
            liTag += `<li class="dots"><span>...</span></li>`;
        }
    }

    if (currentPage == totalPages) {
        beforePage -= 2;
    } else if (currentPage == totalPages - 1) {
        beforePage -= 1;
    }

    if (currentPage == 1) {
        afterPage += 2;
    } else if (currentPage == 2) {
        afterPage += 1;
    }

    for (let plength = beforePage; plength <= afterPage; plength++) {
        if (plength > totalPages || plength < 1) {
            continue;
        }

        active = (currentPage == plength) ? "active" : "";

        liTag += `<li class="numb ${active}" onclick="changePage(${plength})">
                    <span>${plength}</span>
                  </li>`;
    }

    if (currentPage < totalPages - 1) {
        if (currentPage < totalPages - 2) {
            liTag += `<li class="dots"><span>...</span></li>`;
        }
        liTag += `<li class="last numb" onclick="changePage(${totalPages})">
                    <span>${totalPages}</span>
                  </li>`;
    }

    if (currentPage < totalPages) {
        liTag += `<li class="btn next" onclick="changePage(${currentPage + 1})">
                    <span>Next <i class="fas fa-angle-right"></i></span>
                  </li>`;
    }

    return liTag;
}
document.addEventListener('DOMContentLoaded', function () {
    let selectedRatings = {}; // Track ratings per appointment

    // Initialize star rating for each appointment
    const starContainers = document.querySelectorAll('.rating');

    starContainers.forEach(container => {
        const stars = container.querySelectorAll('.star-icon');
        let selectedRating = 0;

        stars.forEach(star => {
            const appointmentId = star.getAttribute('data-id');

            // Highlight stars on hover
            star.addEventListener('mouseover', function () {
                highlightStars(container, this.dataset.value);
            });

            // Revert to selected rating on mouse out
            star.addEventListener('mouseout', function () {
                highlightStars(container, selectedRatings[appointmentId] || selectedRating);
            });

            // Select rating on click
            star.addEventListener('click', function () {
                selectedRating = this.dataset.value;
                selectedRatings[appointmentId] = selectedRating; // Store selected rating
                highlightStars(container, selectedRating);
            });
        });

        function highlightStars(container, rating) {
            const stars = container.querySelectorAll('.star-icon');
            stars.forEach(star => {
                star.classList.remove('text-warning', 'text-secondary');
                star.classList.add(star.dataset.value <= rating ? 'text-warning' : 'text-secondary');
            });
        }
    });

    // Review submission logic
    document.querySelectorAll('.submitReview').forEach(button => {
        button.addEventListener('click', function () {
            const appointmentId = this.getAttribute('data-id');
            const form = document.getElementById(`rateForm-${appointmentId}`);
            const formData = new FormData(form);

            // Append rating to form data
            formData.append('star', selectedRatings[appointmentId]);

            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenMeta) {
                console.error('CSRF token meta tag not found.');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'CSRF token is missing. Please refresh the page and try again.',
                });
                return;
            }

            const csrfToken = csrfTokenMeta.getAttribute('content');

            fetch('/submit-review', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
                .then(response => {
                    return response.json().then(data => ({ status: response.status, data }));
                })
                .then(({ status, data }) => {
                    if (status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload();
                        });
                    } else if (status === 400) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred. Please try again later.',
                    });
                    console.error(error);
                });
        });
    });
});


</script>
<style>
    .rating .fa-star {
        font-size: 2rem;
        cursor: pointer;
        margin: 0 5px;
        transition: color 0.3s;
    }

    .rating .fa-star.text-warning {
        color: #ffc107; /* Yellow color for selected stars */
    }

    .rating .fa-star.text-secondary {
        color: #e4e5e9; /* Grey color for unselected stars */
    }

    .rating .fa-star:hover,
    .rating .fa-star:hover ~ .fa-star {
        color: #ffc107; /* Highlight stars on hover */
    }
</style>


@endsection