@extends('admin.admin_layout')
@section('title', 'Contact Forms')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Forms</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact Forms</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content dataTable">
        <div class="container-fluid">
            <div class="card shadow-lg">
                <div class="card-header  d-flex justify-content-between align-items-left">
                    <h5 class="m-0">Contact Forms</h5>
                    <!-- Search Form -->
                    <form action="{{ route('admin.contactForms') }}" method="GET" class="form-inline mb-0">
                        <div class="form-group mb-2">
                            <label for="search" class="mr-2">Search:</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-light mb-2 ml-2">Search</button>
                    </form>
                </div>
                <div class="card-body table-responsive">
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
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contactForms as $contactForm)
                                <tr>
                                    <td>{{ $contactForm->id }}</td>
                                    <td>{{ ucwords(strtolower($contactForm->first_name)) }} {{ ucwords(strtolower($contactForm->last_name)) }}</td>
                                    <td>{{ $contactForm->email }}</td>
                                    <td>{{ Str::limit($contactForm->message, 50) }}</td>
                                    <td>{{ $contactForm->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-btn" data-toggle="modal" data-target="#viewModal" data-name="{{ ucwords(strtolower($contactForm->first_name)) }} {{ ucwords(strtolower($contactForm->last_name)) }}" data-email="{{ $contactForm->email }}" data-message="{{ $contactForm->message }}" data-created_at="{{ $contactForm->created_at }}">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                </div>
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
    </section>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewModalLabel">Contact Form Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contactFormDetails">
                    <!-- Details will be populated dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Populate Modal with Data
    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('name');
        var email = button.data('email');
        var message = button.data('message');
        var created_at = button.data('created_at');

        var modal = $(this);
        modal.find('.modal-title').text('Contact Form Details');
        modal.find('#contactFormDetails').html(`
            <p><strong>Name:</strong> ${name}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Message:</strong> ${message}</p>
            <p><strong>Created At:</strong> ${created_at}</p>
        `);
    });
</script>
<script>

    // Pagination Script
    const element = document.querySelector(".pagination ul");
    const totalPages = {{ $contactForms->lastPage() }};
    const currentPage = {{ $contactForms->currentPage() }};
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
