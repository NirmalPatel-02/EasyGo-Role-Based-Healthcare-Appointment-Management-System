@extends('admin.admin_layout')
@section('title', 'Withdrawals List')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{request()->has('status')?request()->status:""}} Withdrawals</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Withdrawals</li>
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
                            <form action="{{ route('admin.withdrawals') }}" method="GET" class="form-inline mb-3">
                                <div class="form-group mb-2">
                                    <label for="transaction_id" class="mr-2">Transaction ID:</label>
                                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ request('transaction_id') }}">
                                </div>
                                <div class="form-group mb-2">
                                  <label for="doctor_id" class="mr-2">Doctor ID:</label>
                                  <input type="text" class="form-control" id="doctor_id" name="doctor_id" value="{{ request('doctor_id') }}">
                              </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="from_date" class="mr-2">From:</label>
                                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="to_date" class="mr-2">To:</label>
                                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
                                </div><div class="form-group mb-2">
                                    <label for="processed" class="mr-2">Procesed:</label>
                                    <input type="date" class="form-control" id="processed" name="processed" value="{{ request('processed') }}">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                            </form>
                            <div class="ml-auto mb-2 d-flex">
                                <a href="{{ url()->current() }}?export=excel&{{ request()->getQueryString() }}" class="btn btn-success btn-sm">Export Excel</a>


                                </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Doctor</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Bank</th>
                                        <th>Account</th>
                                        <th>IFSC</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $withdrawal->id }}</td>
                                        <td>
                                            <a href="{{ route('doctorView', ['id' => $withdrawal->doctor->id]) }}">
                                                {{ $withdrawal->doctor->first_name }} {{ $withdrawal->doctor->last_name }}
                                            </a>
                                        </td>
                                        <td>{{ $withdrawal->transaction_id }}</td>
                                        <td>{{ $withdrawal->amount }}</td>
                                        <td>{{ $withdrawal->bank_name }}</td>
                                        <td>{{ $withdrawal->account_no }}</td>
                                        <td>{{ $withdrawal->ifsc }}</td>
                                        <td>{{ $withdrawal->branch_name }}</td>
                                        <td>
                                            <span class="badge badge-{{ $withdrawal->status === 'Processed' ? 'success' : ($withdrawal->status === 'Rejected' ? 'danger' : 'warning') }}">
                                                {{ $withdrawal->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($withdrawal->status==="Processed")

                                            @else
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#processModal" data-id="{{ $withdrawal->id }}" data-status="Processed" data-remarks="{{ $withdrawal->remarks }}" data-amount="{{ $withdrawal->amount }}" data-bank="{{ $withdrawal->bank_name }}" data-transaction-id="{{ $withdrawal->transaction_id }}">
                                                Process
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#processModal" data-id="{{ $withdrawal->id }}" data-status="Rejected" data-remarks="{{ $withdrawal->remarks }}" data-amount="{{ $withdrawal->amount }}" data-bank="{{ $withdrawal->bank_name }}" data-transaction-id="{{ $withdrawal->transaction_id }}">
                                                Reject
                                            </button>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Process/Reject -->
<div class="modal fade" id="processModal" tabindex="-1" role="dialog" aria-labelledby="processModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="processModalLabel">Process Withdrawal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('withdrawals.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="withdrawal_id" name="withdrawal_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="transaction_id_modal">Transaction ID</label>
                        <input type="text" class="form-control" id="transaction_id_modal" name="transaction_id" >
                    </div>
                    <div class="form-group">
                        <label for="amount_modal">Amount</label>
                        <input type="text" class="form-control" id="amount_modal" name="amount" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bank_modal">Bank</label>
                        <input type="text" class="form-control" id="bank_modal" name="bank" readonly>
                    </div>
                    <div class="form-group">
                        <label for="file">File Upload</label>
                        <input type="file" class="form-control" id="file" name="file" >
                    </div>
                    <div class="form-group">
                        <label for="remarks_modal">Remarks</label>
                        <textarea class="form-control" id="remarks_modal" name="remarks" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status_modal">Status</label>
                        <select class="form-control" id="status_modal" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Processed">Processed</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="modal_submit_btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('#processModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var withdrawalId = button.data('id');
        var status = button.data('status');
        var remarks = button.data('remarks');
        var amount = button.data('amount');
        var bank = button.data('bank');
        var transactionId = button.data('transaction-id');

        var modal = $(this);
        modal.find('#withdrawal_id').val(withdrawalId);
        modal.find('#transaction_id_modal').val(transactionId);
        modal.find('#amount_modal').val(amount);
        modal.find('#bank_modal').val(bank);
        modal.find('#remarks_modal').val(remarks);
        modal.find('#status_modal').val(status);
    });
</script>
<script>
    // Pagination Script
    const element = document.querySelector(".pagination ul");
    const totalPages = {{ $withdrawals->lastPage() }};
    const currentPage = {{ $withdrawals->currentPage() }};
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
