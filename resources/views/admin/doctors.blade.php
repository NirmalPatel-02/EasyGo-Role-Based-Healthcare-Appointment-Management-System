@extends('admin.admin_layout')
@section('title', 'Doctors List')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{request()->has('status')?request()->status:""}} Doctors List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Doctors List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content dataTable">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Search Form -->
                            <form action="{{ url()->current() }}" method="GET" class="form-inline">
                                @foreach(request()->except('per_page') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <div class="form-group mb-2">
                                    <label for="search_name" class="mr-2">Doctor Name:</label>
                                    <input type="text" class="form-control" id="search_name" name="search_name" value="{{ request('search_name') }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="phone" class="mr-2">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ request('phone') }}">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="search_date" class="mr-2">Date:</label>
                                    <input type="date" class="form-control" id="search_date" name="search_date" value="{{ request('search_date') }}">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Search</button>

                                <!-- Export Buttons -->
                                <div class="ml-auto mb-2 d-flex gap-2">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#doctorProfileModal">
  + Add Doctor Profile
</button>
    <a href="{{ url()->current() }}?export=excel&{{ request()->getQueryString() }}" class="btn btn-warning btn-sm">Export Excel</a>
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Speciality</th>
                                        <th>Experience</th>
                                        <th>Language</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>ZipCode</th>
                                        <th>Education</th>
                                        <th>LATLNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $doctor)
                                        <tr>
                                            <td>
                                                <span class="badge {{ $doctor->status === 'Approved' ? 'bg-success' : ($doctor->status === 'Pending' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($doctor->status) }}
                                                </span>
                                            </td>
                                            <td>
                                            <a href="{{ route('doctorView', ['id' => $doctor->id]) }}" class="btn btn-primary btn-sm">
    View Details
</a>


                                            </td>
                                            <td>{{ $doctor->id }}</td>
                                            <td>{{ $doctor->first_name }}</td>
                                            <td>{{ $doctor->last_name }}</td>
                                            <td>{{ $doctor->email }}</td>
                                            <td>{{ $doctor->phone }}</td>
                                            <td>{{ $doctor->gender }}</td>
                                            <td>{{ $doctor->speciality }}</td>
                                            <td>{{ $doctor->experience }}</td>
                                            <td>{{ $doctor->language }}</td>
                                            <td>{{ $doctor->address }}</td>
                                            <td>{{ $doctor->city }}</td>
                                            <td>{{ $doctor->state }}</td>
                                            <td>{{ $doctor->zipcode }}</td>
                                            <td>{{ $doctor->education }}</td>
                                            <td>
<a href="https://www.google.com/maps?q={{ $doctor->latitude }},{{ $doctor->longitude }}" target="_blank">
Latitude, Longitude: {{ $doctor->latitude }}, {{ $doctor->longitude }}
</a>

                                            </td>
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
<script>
    // Pagination Script
    const element = document.querySelector(".pagination ul");
    const totalPages = {{ $users->lastPage() }};
    const currentPage = {{ $users->currentPage() }};
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

<!-- Modal -->
<div class="modal fade" id="doctorProfileModal" tabindex="-1" role="dialog" aria-labelledby="doctorProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="doctorProfileModalLabel">Create Doctor Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <!-- Doctor Profile Form Fields -->
          <input type="hidden" name="role" value="doctor">
          <input type="hidden" name="status" value="Pending">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="speciality">Specialty</label>
                <input type="text" class="form-control" id="speciality" name="speciality" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="avatar">Avatar (Optional)</label>
                <input type="file" class="form-control-file" id="avatar" name="avatar">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city" required>
                  <option value="">Select City</option>
                  <!-- Populate cities dynamically -->
                  @foreach($cities as $city)
                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state" required>
                  <option value="">Select State</option>
                  <!-- Populate states dynamically -->
                  @foreach($states as $state)
                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Doctor Profile</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
