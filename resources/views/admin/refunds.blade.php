@extends('admin.admin_layout')
@section('title', 'Refund Requests')
@section('content')
<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Refund Requests</h1></div></section>
    <section class="content"><div class="container-fluid"><div class="card">
        <div class="card-header">
            <form method="GET" class="form-inline">
                <label class="mr-2" for="status">Status</label>
                <select id="status" name="status" class="form-control mr-2">
                    <option value="">All</option>
                    @foreach(['Pending', 'Processing', 'Processed', 'Rejected', 'Failed'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Filter</button>
            </form>
        </div>
        <div class="card-body table-responsive">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            <table class="table table-bordered table-striped">
                <thead><tr><th>ID</th><th>Appointment</th><th>Client</th><th>Doctor</th><th>Payment</th><th>Amount</th><th>Reason</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                @forelse($refunds as $refund)
                    <tr>
                        <td>{{ $refund->id }}</td><td>#{{ $refund->appointment_id }}</td>
                        <td>{{ optional($refund->client)->first_name }} {{ optional($refund->client)->last_name }}</td>
                        <td>{{ optional($refund->doctor)->first_name }} {{ optional($refund->doctor)->last_name }}</td>
                        <td>{{ $refund->payment_id }}</td><td>₹{{ number_format($refund->amount, 2) }}</td>
                        <td>{{ $refund->reason }} @if($refund->failure_reason)<br><small class="text-danger">{{ $refund->failure_reason }}</small>@endif</td>
                        <td><span class="badge {{ $refund->status === 'Processed' ? 'bg-success' : ($refund->status === 'Pending' ? 'bg-warning' : 'bg-secondary') }}">{{ $refund->status }}</span></td>
                        <td>
                            @if(in_array($refund->status, ['Pending', 'Failed']))
                                <form method="POST" action="{{ route('admin.refunds.approve', $refund->id) }}" class="d-inline">@csrf<button class="btn btn-success btn-sm" onclick="return confirm('Process this refund in Razorpay?')">Approve & Refund</button></form>
                            @endif
                            @if($refund->status === 'Pending')
                                <form method="POST" action="{{ route('admin.refunds.reject', $refund->id) }}" class="d-inline">@csrf<button class="btn btn-danger btn-sm" onclick="return confirm('Reject this refund request?')">Reject</button></form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center">No refund requests found.</td></tr>
                @endforelse
                </tbody>
            </table>
            {{ $refunds->withQueryString()->links() }}
        </div>
    </div></div></section>
</div>
@endsection
