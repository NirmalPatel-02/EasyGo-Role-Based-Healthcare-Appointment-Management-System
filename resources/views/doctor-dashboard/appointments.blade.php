@extends('doctor-dashboard.layout')
@section('title','Doctors Appointment')
@section('content')

<main id="main" class="main">
  <div class="d-flex justify-content-between"></div>
  <section class="section dashboard">
    <div class="page_title_link">
      <div class="desbord_card d-flex gap-2 align-items-center p-3">
        <svg width="18" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 8.5L3.16667 6.83333M3.16667 6.83333L9 1L14.8333 6.83333M3.16667 6.83333V15.1667C3.16667 15.3877 3.25446 15.5996 3.41074 15.7559C3.56702 15.9122 3.77899 16 4 16H6.5M14.8333 6.83333L16.5 8.5M14.8333 6.83333V15.1667C14.8333 15.3877 14.7455 15.5996 14.5893 15.7559C14.433 15.9122 14.221 16 14 16H11.5M6.5 16C6.72101 16 6.93298 15.9122 7.08926 15.7559C7.24554 15.5996 7.33333 15.3877 7.33333 15.1667V11.8333C7.33333 11.6123 7.42113 11.4004 7.57741 11.2441C7.73369 11.0878 7.94565 11 8.16667 11H9.83333C10.0543 11 10.2663 11.0878 10.4226 11.2441C10.5789 11.4004 10.6667 11.6123 10.6667 11.8333V15.1667C10.6667 15.3877 10.7545 15.5996 10.9107 15.7559C11.067 15.9122 11.279 16 11.5 16M6.5 16H11.5" stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">
          <span>Home</span>
        </p>
        <svg width="8" height="13" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">Appointments</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
        <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
            <div>
              <h3 class="mb-0">All Appointments</h3>
            </div>
            <div class="d-flex flex-wrap gap-2">
    <!-- Search Bar Form -->
    <div class="search-bar ms-auto px-3 py-2">
        <form class="d-flex align-items-center" method="GET" action="{{ route('doctor.appointments') }}">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            <input type="text" name="query" placeholder="Search by Patient name" title="Enter search keyword" value="{{ request()->query('query') }}">
        </form>
    </div>

    <!-- Date Filter Form -->
    <div class="input_fild px-3">
        <form class="d-flex align-items-center" method="GET" action="{{ route('doctor.appointments') }}">
            <input type="date" class="w-100 border-0" name="dated" onchange="this.form.submit()" value="{{ request()->query('dated') }}">
        </form>
    </div>
</div>

          </div>
          <div class="table_scroll mt-3">
         
            <table class="table table-striped" id="example">
              <thead>
                <tr>
                  <th scope="col">NAME</th>
                  <th scope="col">AGE</th>
                  <th scope="col">PHONE NUMBER</th>
                  <th scope="col">GENDER</th>
                  <th scope="col">DATE</th>
                  <th scope="col">TIME</th>
                  <th scope="col">ACTION</th>
                  <th scope="col">RATINGS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($appointments as $row)
                <tr>
                    <td>{{ ucwords(strtolower($row->first_name)) }} {{ ucwords(strtolower($row->last_name)) }}</td>
                    <td>
    <!-- {{ \Carbon\Carbon::parse($row->dob)->format('d/m/Y') }}  -->
    {{ \Carbon\Carbon::parse($row->dob)->age }} years
</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->dated)->format('d/m/Y') }}</td>
                    <td>{{ $row->time_slot }}</td>
                    <td>
                        @if($row->status === 'Pending')
                            <button class="btn btn-success btn-sm update-status" data-id="{{ $row->id }}" data-status="Confirmed">Accept</button>
                            <button class="btn btn-danger btn-sm update-status" data-id="{{ $row->id }}" data-status="Rejected">Reject</button>
                            <a href="#" 
                            class="reschedule-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ResheduledModal" 
                            data-id="{{ $row->id }}" 
                            data-first-name="{{ ucwords(strtolower($row->first_name)) }}" 
                            data-last-name="{{ ucwords(strtolower($row->last_name)) }}" 
                            data-dob="{{ $row->dob }}" 
                            data-phone="{{ $row->phone }}" 
                            data-dated="{{ $row->dated }}" 
                            data-time-slot="{{ $row->time_slot }}">
                              <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                          </a>
                                <a href="#" id="cancel" class="cancel-btn" data-id="{{ $row->id }}"> 
    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
                        @elseif($row->status === 'Confirmed')
                        <a href="#" 
                            class="reschedule-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ResheduledModal" 
                            data-id="{{ $row->id }}" 
                            data-first-name="{{ ucwords(strtolower($row->first_name)) }}" 
                            data-last-name="{{ ucwords(strtolower($row->last_name)) }}" 
                            data-dob="{{ $row->dob }}" 
                            data-phone="{{ $row->phone }}" 
                            data-dated="{{ $row->dated }}" 
                            data-time-slot="{{ $row->time_slot }}">
                              <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                          </a>

                                <a href="#" id="cancel" class="cancel-btn" data-id="{{ $row->id }}"> 
    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
                            <button class="btn btn-warning btn-sm update-status" data-id="{{ $row->id }}" data-status="Completed">Complete</button>
                        @else
                            <span class="text-muted">{{ $row->status }}</span>
                        @endif
                    </td>
<td>
                    <a href="#" id="rate" class="rate-btn" data-bs-toggle="modal" data-bs-target="#rateModal-{{ $row->id }}">
                <svg width="18" height="18" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" fill="#FFD700" />
                </svg>
                @if($row->review)
                    {{ $row->review->star }}  View Review
              @endif
            </a>
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
              @endif
            </div>
        </div>
    </div>
</div>
                @endforeach
            </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="desbord_card  px-3">
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
                        <ul class="mb-0"> <!--pages or li are comes from javascript --> </ul>
                    </div>
                </div>
            </div>
        </div>
  </section>
</main>


@endsection



@section('scripts')
<div class="modal fade" id="ResheduledModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Rescheduled</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="withdrow_form">
          <div class="sedule_detail flex-wrap gap-2 d-flex justify-content-between">
              <div>
                <p class="mb-1">Patient Name</p>
                <h5 id="modal-name">Mohd Tabrej</h5>
              </div>
              <div>
                <p class="mb-1">DOB</p>
                <h5 id="modal-dob">30/08/1999</h5>
              </div>
              <div>
                <p class="mb-1">Phone Number</p>
                <h5 id='modal-phone'>9876543210</h5>
              </div>
              <div>
                <p class="mb-1"> Date </p>
                <h5 id="modal-dated">30/08/2024</h5>
              </div>
              <div>
                <p class="mb-1">Time</p>
                <h5 id="modal-time">1:00 - 1:15 PM</h5>
              </div>
          </div>
          <form action="" id="submitForm" method="post">
          @csrf
          <input type="hidden" name="status" value="Confirmed">
            <div class="row">
              <div class="col-md-6 py-3">
                <div>
                  <label for="" class="mb-2">Date</label>
                  <div class="input_fild px-3 d-flex align-items-center">
                    <input type="date" name="dated" placeholder="" class="border-0 w-100" required>
                   
                  </div>
                </div>
              </div>
              <div class="col-md-6 py-3">
                <div>
                  <label for="" class="mb-2">Time</label>
                  <div class="input_fild px-3 d-flex align-items-center">
                    <input type="time" placeholder="Choose Slot" class="border-0 w-100" id="edit_time_slot" name="time_slot">
                    
                  </div>
                </div>
              </div>
              <div class="col-md-12 py-3">
                <div>
                  <label for="" class="mb-2">Remark</label>
                  <div class="input_fild px-3 d-flex align-items-center" style="min-height: 66px;">
                    <textarea name="" class="border-0 w-100" style="outline: none;" placeholder="Choose date" id=""></textarea>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block " >
                Confirm
</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
   $(document).ready(function () {
    const editTimePicker = flatpickr("#edit_time_slot", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // h for hours, i for minutes, K for AM/PM
            time_24hr: false // Ensures AM/PM is used
        });
    const urlParams = new URLSearchParams(window.location.search);
    
    // Check if 'status' parameter is present
    if (urlParams.has('status')) {
        // Add the class if 'status' parameter exists
        $('.scheduled').addClass('active_side');
    }
    else 
    { $('.appointments').addClass('active_side');}
    $(document).on('click', '.update-status', function () {
        var appointmentId = $(this).data('id');
        var status = $(this).data('status');

        $.ajax({
            url: `{{ route('doctor.updateStatus', ':id') }}`.replace(':id', appointmentId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Status updated successfully!', // Default message if response doesn't have 'message'
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload(); // Reload page to reflect changes
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong!',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});
</script>
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
                    url: `/doctor-dashboard/appointments/${appointmentId}/cancel`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cancelled!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
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

    $(document).on('click', '.reschedule-btn', function () {
    const id = $(this).data('id');
    const firstName = $(this).data('first-name');
    const lastName = $(this).data('last-name');
    const dob = $(this).data('dob');
    const phone = $(this).data('phone');
    const dated = $(this).data('dated');
    const timeSlot = $(this).data('time-slot');

    // Populate modal fields
    $('#modal-id').val(id);
    $('#modal-name').text(`${firstName} ${lastName}`);
    $('#modal-dob').text(dob);
    $('#modal-phone').text(phone);
    $('#modal-dated').text(dated);
    $('#modal-time').text(timeSlot);
    const actionUrl = `/doctor-dashboard/appointments/${id}/update`; // URL to reschedule the appointment
    $('#submitForm').attr('action', actionUrl);
});



</script>
<script>
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
<style>.btn-primary {
    background: #000066;
    border-color: #000066;
}</style>
@endsection


