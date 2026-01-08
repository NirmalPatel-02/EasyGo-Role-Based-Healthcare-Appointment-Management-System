@extends('admin.admin_layout')
@section('title', 'View Doctor Details')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid text-center mb-3">
            <h1 class="display-5">Doctor Details</h1>
        </div>
    </section>

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
                                     alt="Doctor Picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>
                            <p class="text-muted text-center">{{ ucfirst($user->role) }}</p>
                            <div class="text-center">
                            <p class="text-success text-center border border-info">Commission: {{ ucfirst($user->commission_rate) }}%</p>
                            <a href="{{route('admin.wallets',['doctor_id'=>$user->id])}}" class="btn btn-info btn-xs ">View Wallet</a>
</div>
                            <div class="text-center w-100 mt-3">
                            <form method="POST" action="{{ route('userUpdate') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="hidden" name="status" value="Approved">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('userUpdate') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="hidden" name="status" value="Rejected">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
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
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editDoctorModal">Edit</button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-secondary mt-3">
                        <div class="card-header">
                            <h5>View Appointments</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4" role="group" aria-label="Appointment Status Buttons">
                                <a href="{{ route('admin.appointmentList', ['status' => 'Pending', 'doctor_id'=>$user->id]) }}" class="btn btn-warning btn-sm">Pending</a>
                                <a href="{{ route('admin.appointmentList', ['status' => 'Confirmed', 'doctor_id'=>$user->id]) }}" class="btn btn-success btn-sm">Confirmed</a>
                                <a href="{{ route('admin.appointmentList', ['status' => 'Completed', 'doctor_id'=>$user->id]) }}" class="btn btn-info btn-sm">Completed</a>
                            </div>
                            <div class="text-center mb-4" role="group" aria-label="Appointment Status Buttons">
                                <a href="{{ route('admin.appointmentList', ['status' => 'Rejected', 'doctor_id'=>$user->id]) }}" class="btn btn-danger btn-sm">Rejected</a>
                                <a href="{{ route('admin.appointmentList', ['status' => 'Cancelled', 'doctor_id'=>$user->id]) }}" class="btn btn-secondary btn-sm">Cancelled</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Section -->
                <div class="col-md-9">
                    <div class="card shadow">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal Information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                                <li class="nav-item"><a class="nav-link" href="#education" data-toggle="tab">Education & Experience</a></li>
                                <li class="nav-item"><a class="nav-link" href="#certificates" data-toggle="tab">Certificates</a></li>
                                <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a></li>
                                <li class="nav-item"><a class="nav-link" href="#slots" data-toggle="tab">Slots</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Personal Information Tab -->
                                <div class="tab-pane active" id="personal" style="min-height: 300px;">
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
                                                <th class="col-3">Fee</th>
                                                <td class="col-9">{{ $user->price }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Gender</th>
                                                <td class="col-9">{{ ucfirst($user->gender) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Speciality</th>
                                                <td class="col-9">{{ $user->speciality }}</td>
                                            </tr>
                                            <tr>
                                            <th class="col-3">Bio</th>
                                            <td class="col-9" style="white-space: normal; word-wrap: break-word;">{{ $user->bio }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Account Status</th>
                                                <td class="col-9">
    @if ($user->status === 'Approved')
        <span class="badge bg-success">{{ $user->status }}</span>
    @elseif ($user->status === 'Rejected')
        <span class="badge bg-danger">{{ $user->status }}</span>
    @elseif ($user->status === 'Pending')
        <span class="badge bg-warning">{{ $user->status }}</span>
    @else
        <span class="badge bg-secondary">{{ $user->status }}</span>
    @endif
</td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    <h5>Account Information</h5>
                                    <table class="table table-borderd table-stripped">
                                        <tr>
                                            <th>Total Earnings</th>
                                            <th>Total Withdrwals</th>
                                            <th>Wallet Balance</th>
                                        </tr>
                                        <tr>
                                            
                                            <td>{{ $wallet["totalEarning"] }}</td>
                                            <td>{{ $wallet["totalwithdrawal"] }}</td>
                                            <td>{{ $wallet["balance"] }}</td>

                                        </tr>
                                    </table>
                                </div>

                                <!-- Address Tab -->
                                <div class="tab-pane" id="address" style="min-height: 300px;">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th class="col-3">Country</th>
                                                <td class="col-9">{{ $user->country }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">State</th>
                                                <td class="col-9">{{ $user->state }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">City</th>
                                                <td class="col-9">{{ $user->city }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Locality</th>
                                                <td class="col-9">{{ $user->locality }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Zipcode</th>
                                                <td class="col-9">{{ $user->zipcode }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Address</th>
                                                <td class="col-9">{{ $user->address }}</td>
                                            </tr>

                                            <tr>
    <th class="col-3">Latitude, Longitude</th>
    <td class="col-9">
        <a href="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}" target="_blank">
            {{ $user->latitude }}, {{ $user->longitude }}
        </a>
        <!-- Responsive map -->
        <div style="margin-top: 10px; position: relative; overflow: hidden; padding-bottom: 56.25%; height: 0;">
            <iframe 
                src="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}&output=embed" 
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                allowfullscreen 
                loading="lazy">
            </iframe>
        </div>
    </td>
</tr>

                                        </tbody>
                                    </table>
                                </div>

                                <!-- Education & Experience Tab -->
                                <div class="tab-pane" id="education" style="min-height: 300px;">
                                    <h5>Education</h5>
                                    <ul>
                                    <li>{{ $user->education }}</li>
                                        </ul>
                                    <h5>Experience</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->experiences as $experience)
                                                <tr>
                                                    <td>{{ $experience->name }}</td>
                                                    <td>{{ $experience->from }}</td>
                                                    <td>{{ $experience->to }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <h5>Languages</h5>
                                    <ul>
                                        @foreach ($user->languages as $language)
                                            <li>{{ $language->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Certificates Tab -->
                                <div class="tab-pane" id="certificates" style="min-height: 300px;">
                                 
                                    <h5>Certificates</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Issued By</th>
                                                <th>View Document</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->certificates as $certificate)
                                                <tr>
                                                    <td>{{ $certificate->name }}</td>
                                                    <td>{{ $certificate->by }}</td>
                                                    <td>
                                                <a href="{{ asset('certificates/'.$certificate->file) }}" download="{{ $certificate->file }}">
                                                    Download Certificate
                                                </a>
                                            </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No certificates uploaded</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    
                                </div>

                                <!-- Gallery Tab -->
                                <div class="tab-pane" id="gallery" style="min-height: 300px;">
                                <div class="row">
    @forelse ($user->galleries as $gallery)
        <div class="col-6 col-md-3">
            <div class="gallery-item">
                <a href="{{ asset('galleries/' . $gallery->name) }}" data-toggle="lightbox" data-gallery="gallery" class="gallery-link">
                    <img src="{{ asset('galleries/' . $gallery->name) }}" class="img-fluid mb-3 gallery-img" alt="Gallery Image">
                </a>
            </div>
        </div>
    @empty
        <p>Gallery is empty for now.</p>
    @endforelse
</div>
                                      </div>


                                <!-- Slots Tab -->
                                <div class="tab-pane" id="slots" style="min-height: 300px;">
                                    @if ($user->slots()->count())
                                        <div class="list-container p-3 rounded bg-light">
                                            <ul class="list-group list-group-striped">
                                                {{-- Morning Section --}}
                                                <li class="list-group-item list-group-item-primary text-center font-weight-bold">
                                                    Morning
                                                </li>
                                                @foreach ($user->slots as $slot)
                                                    @if (str_contains(strtoupper($slot->time_slot), 'AM'))
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>{{ $slot->time_slot }}</span>
                                                        </li>
                                                    @endif
                                                @endforeach

                                                {{-- Afternoon Section --}}
                                                <li class="list-group-item list-group-item-secondary text-center font-weight-bold mt-3">
                                                    Afternoon
                                                </li>
                                                @foreach ($user->slots as $slot)
                                                    @if (!str_contains(strtoupper($slot->time_slot), 'AM'))
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <span>{{ $slot->time_slot }}</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <p>No slots available for this doctor.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<style>



.gallery-item {
    position: relative;
    overflow: hidden; /* Prevent images from overflowing */
    border: 1px solid #ddd; /* Optional border for gallery item */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px; /* Optional rounded corners */
}

.gallery-img {
    width: 100%;
    height: 150px; /* Set fixed height */
    object-fit: cover; /* Maintain aspect ratio while covering the container */
    transition: transform 0.2s ease-in-out;
    border-radius: 6px; /* Optional rounded corners for images */
}

.gallery-img:hover {
    transform: scale(1.05); /* Slight zoom on hover */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.9.0/dist/index.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.9.0/dist/index.bundle.min.js"></script>
<!-- Modal for Image Zoom -->
<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" id="zoomImage" class="img-fluid" alt="Zoomed Image">
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to open the modal and set the image source
    document.querySelectorAll('.gallery-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const imgSrc = this.getAttribute('href');
            document.getElementById('zoomImage').src = imgSrc;
            new bootstrap.Modal(document.getElementById('zoomModal')).show();
        });
    });
</script>
<!-- Edit Client Modal -->
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('userUpdate') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- First Name -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" required>
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            <!-- Last Name -->
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
                            </div>
                           
                        </div>
                        <div class="col-md-12">
                            <!-- Last Name -->
                            <div class="mb-3 border-2">
                                <label for="commssion_rate" class="form-label">Commission Rate %</label>
                                <input type="text" class="form-control" name="commission_rate" id="commission_rate" value="{{ $user->commission_rate }}" required>
                            </div>
                            </div>
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
