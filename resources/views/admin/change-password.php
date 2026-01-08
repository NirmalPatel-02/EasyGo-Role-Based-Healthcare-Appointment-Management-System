@extends('admin.admin_layout')
@section('title', 'Pages')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header d-flex justify-content-end">
    </section>

    <!-- Main content -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: #000050;">
                <h3 class="card-title" style="color: white;">Change Password</h3>
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
                
                <form method="POST" action="{{ route('admin.change-password.update') }}">
                    @csrf

                    <div class="row">
                        <!-- Current Password -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn" style="background-color:#000050; color:white;">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
