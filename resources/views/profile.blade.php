@extends('layout.client')
@section('title','Simple Steps to Manage Your Profile')

@section('content')
<section class="Option_section py-3">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Book_Appointment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Book Appointment</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-0">
                        <img src="{{asset('asset/img/Treatment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Treatment</h5>

                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Plan_surgery.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Plan my Surgery</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Ask_Question.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Ask a Question</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- OPTIONS SECTION END -->

<!-- PROFILE TITLE SECTION START -->
<section class="profile_title">
    <div class="container">
        <div class="py-3">
            <div>
                <h3>Profile</h3>
            </div>
        </div>
        <div class="profile_details pb-5">
            <div class="row">
                <div class="col-md-6 col-lg-4 py-3">
                <form id="updateProfileForm" method="POST" enctype="multipart/form-data" action="{{ route('client.update') }}">
    @csrf
    <!-- Include your form fields here -->

    <!-- Avatar Upload -->
        <div class="profile_img_bg w-100">
            <div class="circle">
            <img class="profile-pic" src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Profile Picture">


            </div>
            <div class="p-image">
                <div class="upload-button">
                    <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.14008 17.2201C5.04871 17.2213 3.99527 16.8198 3.18157 16.0925C2.36787 15.3652 1.85114 14.3632 1.73036 13.2785C1.60958 12.1939 1.89326 11.1028 2.52704 10.2143C3.16082 9.32581 4.10014 8.70241 5.16504 8.46353C4.85692 7.02655 5.13227 5.52603 5.93049 4.29207C6.72872 3.05811 7.98444 2.19178 9.42142 1.88367C10.8584 1.57556 12.3589 1.8509 13.5929 2.64913C14.8268 3.44735 15.6932 4.70308 16.0013 6.14005H16.1121C17.4859 6.13867 18.8113 6.64783 19.8309 7.56868C20.8505 8.48953 21.4915 9.75637 21.6296 11.1233C21.7677 12.4902 21.3929 13.8596 20.5781 14.9658C19.7632 16.0719 18.5665 16.8359 17.2201 17.1093M15.0041 13.8961L11.6801 10.5721M11.6801 10.5721L8.35608 13.8961M11.6801 10.5721V23.868" stroke="#302C36" stroke-width="2.216" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> Upload Avatar
                </div>
                <input class="file-upload" type="file" accept="image/*" name="avatar" onchange="this.form.submit()"/>
            </div>
        </div>
        </form>
                </div>
                <div class="col-md-6 col-lg-8 d-flex align-items-center py-3">
                    <div class="right_part">
                        <div class="d-flex">
                            <div>
                                <h4>Personal Details</h4>
                            </div>
                        </div>
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
                    <form id="updateForm" enctype="multipart/form-data" method="POST" action="{{ route('client.update') }}">
                    @csrf
                            <div class="row">
                            <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">First Name <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Enter your first name" required>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Last Name <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Enter your last name" required>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Email <span class="red_f">*</span></label>
                              <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Enter email Id" required>
                            </div>  
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Phone Number <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->phone}}" name="phone" placeholder="Enter phone number" required readonly="readonly">
                            </div>
                          </div>
                          <div class="col-lg-12 py-2">
                            <div>
                              <label for="" class="mb-2">Note: Any change in profile details will require approval from administration.<span class="red_f">*</span></label>
                                <hr>
                                <input type="checkbox" required> I Accept the terms and conditions.
                              
                            </div>
                          </div>
                          
                          <div class="d-flex gap-3 py-4">
   
    <button type="submit" class="btn btn-success">
Update Details
</button>
</div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
<!-- PROFILE TITLE SECTION END -->

@endsection
@section('scripts')
<script>

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    // Load countries on page load
    $.getJSON("{{ route('countries') }}", function (data) {
        $('#country').append(data.map(country => `<option value="${country}">${country}</option>`));
    });

    // Load states when a country is selected
    $('#country').on('change', function () {
        const country = $(this).val();
        $('#state').empty().append('<option value="">Select State</option>');
        $('#city').val('');
        $('#city-list').empty();

        if (country) {
            $.getJSON("{{ route('states', '') }}/" + country, function (data) {
                $('#state').append(data.map(state => `<option value="${state}">${state}</option>`));
            });
        }
    });

    // Load cities when a state is selected
    $('#state').on('change', function () {
        const state = $(this).val();
        $('#city').val('');
        $('#city-list').empty();

        if (state) {
            $.getJSON("{{ route('cities', '') }}/" + state, function (data) {
                $('#city-list').append(data.map(city => `<option value="${city}">${city}</option>`));
            });
        }
    });

    
    
      $('.profile').addClass('active_side');

      var readURL = function (input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }


      $(".file-upload").on('change', function () {
        readURL(this);
      });

      $(".upload-button").on('click', function () {
        $(".file-upload").click();
      });
    });

    $(document).ready(function() {
    // Cancel button action
    $('#cancelButton').on('click', function(e) {
        e.preventDefault(); // Prevent default action (i.e., link behavior)
        // Perform cancel actions here
        Swal.fire({
            title: 'Cancelled',
            text: 'Your action has been cancelled.',
            icon: 'info',
            confirmButtonText: 'Ok'
        });
    });

    // Submit button action
    $('#submitForm').on('click', function(e) {
        e.preventDefault(); // Prevent default action (i.e., link behavior)
        // Execute your form submission logic here (e.g., jQuery Ajax)
        // Example: triggering form submission via Ajax
        $.ajax({
            url: '{{ route("doctor.update") }}',  // Replace with your submission URL
            type: 'POST',
            data: {
                // Form data goes here (can collect via FormData or manually)
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                // other fields as needed...
            },
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your form has been submitted successfully.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an issue with the submission.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });
});



  </script>
  @endsection