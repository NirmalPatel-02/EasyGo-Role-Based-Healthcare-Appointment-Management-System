@extends('admin.admin_layout')
@section('title','View Client Details')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>

   <!-- Main Content -->
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
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-3">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <img class="profile-user-img img-fluid img-circle border border-primary" 
                                 src="{{ asset('avatars/' . $user->avatar) }}" 
                                 alt="Client Picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>
                        <p class="text-muted text-center">Client</p>
                        <div class="text-center w-100 mt-3">
                        @if($user->status !== 'Blocked')
                            <form method="POST" action="{{ route('userUpdate') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="hidden" name="status" value="Blocked">
                                <button type="submit" class="btn btn-warning btn-sm">Block</button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('userUpdate') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="hidden" name="status" value="Pending">
                                <button type="submit" class="btn btn-primary btn-sm">Unblock</button>
                            </form>
                            @endif
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editClientModal">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Section -->
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Client Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th class="col-3">Email</th>
                                    <td class="col-9">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Phone</th>
                                    <td class="col-9">{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Current Status</th>
                                    <td class="col-9">{{ $user->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- Main content -->
 <section class="content dataTable">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Bookings of Client</h5>
                            <!-- Search Form -->
                          

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>ID</th>
                                        <th>Created</th>
                                        <th>Client</th>
                                        <th>Dated</th>
                                        <th>TimeSlot</th>
                                        <th>Doctor</th>
                                        <th>PaymentID</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @php
    $statusClasses = [
        'Confirmed' => 'bg-primary',
        'Completed' => 'bg-success',
        'Pending' => 'bg-info',
        'Cancelled' => 'bg-warning',
        'Rejected' => 'bg-danger',
    ];
@endphp

                                    @foreach($appointments as $appointment)
                                   @php  $formattedDate = $appointment->dated ? \Carbon\Carbon::parse($appointment->dated) ->format('d, M Y') : 'N/A';
                                   @endphp
                                        <tr>
                                            <td>
                                                                                                        
                                                        <span class="badge {{ $statusClasses[$appointment->status] ?? 'bg-secondary' }}">
                                                            {{ $appointment->status }}
                                                        </span>

                                            </td>
                                            <td>
                                                <a href="#" class="badge bg-info badge-sm view-details-btn"  data-toggle="modal" data-target="#appointmentModal"   
                       data-id="{{ $appointment->id }}"
                       data-created="{{ \Carbon\Carbon::parse($appointment->created_at)->format('d, M Y, h:i a') }}"
                       data-patient-name="{{ $appointment->first_name }} {{ $appointment->last_name }}"
                       data-patient-dob="{{ $appointment->dob }}" 
                       data-patient-phone="{{ $appointment->phone }}" 
                       data-patient-gender="{{ $appointment->gender }}"
                       data-doctor-name="{{ ucwords(strtolower($appointment->doctor->first_name)) }} {{ ucwords(strtolower($appointment->doctor->last_name)) }}"
                       data-doctor-address="{{ $appointment->doctor->address }}"
                       data-doctor-city="{{ $appointment->doctor->city }}"
                       data-time-slot="{{ $appointment->time_slot }}"
                       data-appointment-dated="{{ $formattedDate }}"
                       data-fee="{{ $appointment->doctor_price }}"
                       data-payment-id="{{ $appointment->payment_id }}"
                       data-platform_fee="{{ $appointment->platform_fee }}"
                       data-gst-percent="{{ $appointment->gst_percent }}"
                       data-gst-amount="{{ $appointment->gst_amount }}"
                       data-comission-rate="{{ $appointment->commission_rate }}"
                       data-comission-amount="{{ $appointment->commission_amount }}"
                       data-total-amount="{{ $appointment->total_amount }}"
                       
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                               
                                            </td>
                                            <td>{{ $appointment->id }}</td>
                                            <td>{{ $appointment->created_at }}</td>
                                            <td>{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</td>
                                            <td>{{ $appointment->dated }}</td>
                                            
                                            <td>{{ $appointment->time_slot }}</td>
                                            <td>{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</td>
                                            
                                            <td>{{ $appointment->payment_id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
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
                                            @foreach(request()->except('per_page') as $key => $value)
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endforeach
                                        </form>
                                    </div>
                                    <div class="table_page_list py-3">
                                        <div class="pagination">
                                            <ul></ul> <!-- Pagination generated by JavaScript -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
<!-- Edit Client Modal -->
<div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('userUpdate') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Edit Client Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- /.content -->
</div>
@endsection
@section('scripts')
<!-- Modal for Appointment Details -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
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
                <!-- Custom Info Section -->
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
                        <div><span>Payment ID:</span> <span id="payment-id"></span></div>
                        <div><span>Platform Fee:</span> <span id="platform_fee"></span></div>
                        <div><span>GST (%):</span> <span id="gst-percent"></span></div>
                        <div><span>GST Amount:</span> <span id="gst-amount"></span></div>
                        <div><span>Commission Rate (%):</span> <span id="comission-rate"></span></div>
                        <div><span>Commission Amount:</span> <span id="comission-amount"></span></div>
                        <div><span>Total Amount:</span> <span id="total-amount"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer custom-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



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
    var commissionRate = $(this).data('commission-rate');
    var commissionAmount = $(this).data('commission-amount');
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
    $('#comission-rate').text(commissionRate);
    $('#comission-amount').text(commissionAmount);
    $('#total-amount').text(totalAmount);
    $('#apId').text(id);
    $('#createdAt').text(created);

   
});

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
    // Pagination Script
    const element = document.querySelector(".pagination ul");
    const totalPages = {{ $appointments->lastPage() }};
    const currentPage = {{ $appointments->currentPage() }};
    element.innerHTML = createPagination(totalPages, currentPage);

    function changePage(page) {
        const perPage = document.getElementById('per_page').value;
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    }

    function createPagination(totalPages, currentPage) {
        let liTag = '';
        let beforePage = currentPage - 1;
        let afterPage = currentPage + 1;

        if (currentPage > 1) {
            liTag += `<li class="btn prev" onclick="changePage(${currentPage - 1})"><span><i class="fas fa-angle-left"></i> Prev</span></li>`;
        }
        if (currentPage > 2) {
            liTag += `<li class="numb" onclick="changePage(1)"><span>1</span></li>`;
            if (currentPage > 3) liTag += `<li class="dots"><span>...</span></li>`;
        }
        if (currentPage === totalPages) beforePage -= 2;
        if (currentPage === 1) afterPage += 2;

        for (let plength = beforePage; plength <= afterPage; plength++) {
            if (plength > totalPages || plength < 1) continue;
            liTag += `<li class="numb ${currentPage === plength ? "active" : ""}" onclick="changePage(${plength})"><span>${plength}</span></li>`;
        }
        if (currentPage < totalPages - 1) {
            if (currentPage < totalPages - 2) liTag += `<li class="dots"><span>...</span></li>`;
            liTag += `<li class="numb" onclick="changePage(${totalPages})"><span>${totalPages}</span></li>`;
        }
        if (currentPage < totalPages) {
            liTag += `<li class="btn next" onclick="changePage(${currentPage + 1})"><span>Next <i class="fas fa-angle-right"></i></span></li>`;
        }
        return liTag;
    }
</script>
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
@endsection