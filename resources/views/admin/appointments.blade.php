@extends('admin.admin_layout')
@section('title', 'Appointments List')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Appointments List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appointments List</li>
                    </ol>
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
                            <!-- Search Form -->
                            <form action="{{ url()->current() }}" method="GET" class="form-inline">
    @foreach(request()->except('per_page') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <!-- Created At From Date Filter -->
    <div class="form-group mx-sm-3 mb-2">
        <label for="created_at_from" class="mr-2">CreatedFrom:</label>
        <input type="date" class="form-control" id="created_at_from" name="created_at_from" value="{{ request('created_at_from') }}">
    </div>

    <!-- Created At To Date Filter -->
    <div class="form-group mx-sm-3 mb-2">
        <label for="created_at_to" class="mr-2">CreatedTo:</label>
        <input type="date" class="form-control" id="created_at_to" name="created_at_to" value="{{ request('created_at_to') }}">
    </div>

    <!-- Dated From Date Filter -->
    <div class="form-group mx-sm-3 mb-2">
        <label for="dated_from" class="mr-2">DatedFrom:</label>
        <input type="date" class="form-control" id="dated_from" name="dated_from" value="{{ request('dated_from') }}">
    </div>

    <!-- Dated To Date Filter -->
    <div class="form-group mx-sm-3 mb-2">
        <label for="dated_to" class="mr-2">DatedTo:</label>
        <input type="date" class="form-control" id="dated_to" name="dated_to" value="{{ request('dated_to') }}">
    </div>

    <!-- Status Filter (Dropdown) -->
    <div class="form-group mx-sm-3 mb-2">
        <label for="status" class="mr-2">Status:</label>
        <select class="form-control" id="status" name="status">
            <option value="">Select Status</option>
            <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <!-- Payment ID Filter -->
    <div class="form-group mx-sm-3 mb-2">
        <label for="payment_id" class="mr-2">Payment ID:</label>
        <input type="text" class="form-control" id="payment_id" name="payment_id" value="{{ request('payment_id') }}">
    </div>

    
    <div class="form-group mx-sm-3 mb-2">
        <label for="doctor_name" class="mr-2">Doctor Name</label>
        <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="{{ request('doctor_name') }}">
    </div>
 
 <div class="form-group mx-sm-3 mb-2">
        <label for="doctor_phone" class="mr-2">Doctor Phone</label>
        <input type="text" class="form-control" id="doctor_phone" name="doctor_phone" value="{{ request('doctor_phone') }}">
    </div>

 
    <div class="form-group mx-sm-3 mb-2">
        <label for="client_name" class="mr-2">Client Name</label>
        <input type="text" class="form-control" id="client_name" name="client_name" value="{{ request('client_name') }}">
    </div>
 
 <div class="form-group mx-sm-3 mb-2">
        <label for="client_phone" class="mr-2">Client Phone</label>
        <input type="text" class="form-control" id="client_phone" name="client_phone" value="{{ request('client_phone') }}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Search</button>

    <!-- Export Buttons -->
    <div class="ml-auto mb-2 d-flex">
        <a href="{{ url()->current() }}?export=excel&{{ request()->getQueryString() }}" class="btn btn-success btn-sm">Export Excel</a>
    </div>
</form>

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
</div>
@endsection

@section('scripts')
<!-- Modal for Appointment Details -->
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
