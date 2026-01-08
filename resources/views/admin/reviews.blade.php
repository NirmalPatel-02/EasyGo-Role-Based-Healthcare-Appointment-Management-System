@extends('admin.admin_layout')
@section('title', 'Reviews List')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{request()->has('status')?request()->status:""}} Reviews</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content dataTable">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            
                               <!-- Search Form -->
                               <form action="{{ route('admin.reviews') }}" method="GET" class="form-inline mb-3">
    <div class="form-group mb-2">
        <label for="doctor_id" class="mr-2">Doctor ID:</label>
        <input type="text" class="form-control" id="doctor_id" name="doctor_id" value="{{ request('doctor_id') }}">
    </div>
    <div class="form-group mb-2">
        <label for="client_id" class="mr-2">Client ID:</label>
        <input type="text" class="form-control" id="client_id" name="client_id" value="{{ request('client_id') }}">
    </div>
    <div class="form-group mb-2">
        <label for="appointment_id" class="mr-2">Appointment ID:</label>
        <input type="text" class="form-control" id="appointment_id" name="appointment_id" value="{{ request('appointment_id') }}">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="from_date" class="mr-2">From:</label>
        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
    </div>
    <div class="form-group mb-2">
        <label for="to_date" class="mr-2">To:</label>
        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>

            <!-- Export Buttons -->
            <div class="ml-auto mb-2 d-flex">
                                <a href="{{ url()->current() }}?export=excel&{{ request()->getQueryString() }}" class="btn btn-success btn-sm">Export Excel</a>


                                </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Doctor</th>
                                        <th>Appointment ID</th>
                                        <th>Rating</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>
    <a href="{{ route('clientView', ['id' => $review->client->id]) }}">
        {{ $review->client->first_name }} {{ $review->client->last_name }}
    </a> 
    <br>
    <small>{{ $review->client->phone }}</small>
</td>
<td>
    <a href="{{ route('doctorView', ['id' => $review->doctor->id]) }}">
        {{ $review->doctor->first_name }} {{ $review->doctor->last_name }}
    </a> 
    <br>
    <small>{{ $review->doctor->phone }}</small>
</td>
<td>
    <a href="{{ route('admin.appointmentList', ['id' => $review->appointment->id]) }}">
        {{ $review->appointment_id }}
    </a>
</td>

                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa {{ $i <= $review->star ? 'fa-star text-warning' : 'fa-star-o' }}"></i>
                                            @endfor
                                        </td>
                                        <td>{{ $review->remarks }}</td>
                                        <td>
                                            <span class="badge badge-{{ $review->status === 'Approved' ? 'success' : ($review->status === 'Rejected' ? 'danger' : 'warning') }}">
                                                {{ $review->status }}
                                            </span>
                                        </td>
                                        <td>
                                         
                                                <form action="{{ route('reviews.update', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Approved">
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('reviews.update', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                          
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
    const totalPages = {{ $reviews->lastPage() }};
    const currentPage = {{ $reviews->currentPage() }};
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
@endsection
