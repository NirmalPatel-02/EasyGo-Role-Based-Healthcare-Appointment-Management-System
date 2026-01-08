@extends('admin.admin_layout')
@section('title', 'Edit Settings')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex justify-content-end">
    </section>

    <!-- Main content -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: #000050;">
                <h3 class="card-title" style="color: white;">Edit Settings</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                <form method="POST" action="{{ route('admin.update.settings') }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- GST -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="gst">GST (%)</label>
                                <input type="number" name="gst" class="form-control" id="gst" value="{{ $settings->gst }}" required>
                            </div>
                        </div>

                        <!-- Commission Rate -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="commission_rate">Commission Rate (%)</label>
                                <input type="number" name="commission_rate" class="form-control" id="commission_rate" value="{{ $settings->commission_rate }}" required>
                            </div>
                        </div>

                        <!-- Platform Fee -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="platform_fee">Platform Fee (in INR)</label>
                                <input type="number" name="platform_fee" class="form-control" id="platform_fee" value="{{ $settings->platform_fee }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn" style="background-color:#000050; color:white;">Update Settings</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
