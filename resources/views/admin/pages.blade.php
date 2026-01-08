@extends('admin.admin_layout')
@section('title', 'Pages')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content dataTable" >
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                   <!-- Search Form -->
<form action="{{ route('admin.pages') }}" method="GET" class="form-inline mb-3">
    <div class="form-group mb-2">
        <label for="title" class="mr-2">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ request('title') }}">
    </div>
    <div class="form-group mb-2">
        <label for="show_nav" class="mr-2">Show in Navigation:</label>
        <select class="form-control" id="show_nav" name="show_nav">
            <option value="">All</option>
            <option value="1" {{ request('show_nav') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ request('show_nav') == '0' ? 'selected' : '' }}>No</option>
        </select>
    </div>
    <div class="form-group mb-2">
        <label for="show_tips" class="mr-2">Show in Tips:</label>
        <select class="form-control" id="show_tips" name="show_tips">
            <option value="">All</option>
            <option value="1" {{ request('show_tips') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ request('show_tips') == '0' ? 'selected' : '' }}>No</option>
        </select>
    </div>
    <div class="form-group mb-2">
        <label for="status" class="mr-2">Status:</label>
        <select class="form-control" id="status" name="status">
            <option value="">All</option>
            <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
            <option value="Unpublished" {{ request('status') == 'Unpublished' ? 'selected' : '' }}>Unpublished</option>
        </select>
    </div>
    
   

    <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>


                    <a href="{{ route('pages.create') }}" class="btn btn-primary btn-sm float-right">Add Page</a>
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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Published</th>
                            <th>Show in Nav</th>
                            <th>Show in Tips</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
    <tr>
        <td>{{ $page->id }}</td>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>{{ $page->published }}</td>
        <td>{{ $page->show_nav ? 'Yes' : 'No' }}</td>
        <td>{{ $page->show_tips ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-info btn-sm">Edit</a>
            @if($page->name !== 'Conditions')
                <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="delete-form" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                </form>
            @endif
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
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Attach click event listener to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            // Get the closest form to the button (which corresponds to the specific page)
            var form = this.closest('form');

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                }
            });
        });
    });
</script>

<script>

    // Pagination Script
    const element = document.querySelector(".pagination ul");
    const totalPages = {{ $pages->lastPage() }};
    const currentPage = {{ $pages->currentPage() }};
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