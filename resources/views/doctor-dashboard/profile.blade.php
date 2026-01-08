@extends('doctor-dashboard.layout')
@section('title','Doctors Profile')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main id="main" class="main">
  <div class="d-flex justify-content-between">
    <!-- <div class="pagetitle">
      <h1 class="mb-2">Dashboard</h1>
    </div> -->

    <!-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="./asset/icon/more.png" class="mt-2" alt="" style="width: 30px"></a> -->
  </div>
  <section class="section dashboard">
    <div class="page_title_link">
      <div class="desbord_card d-flex gap-2 align-items-center p-3">
        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 8.5L3.16667 6.83333M3.16667 6.83333L9 1L14.8333 6.83333M3.16667 6.83333V15.1667C3.16667 15.3877 3.25446 15.5996 3.41074 15.7559C3.56702 15.9122 3.77899 16 4 16H6.5M14.8333 6.83333L16.5 8.5M14.8333 6.83333V15.1667C14.8333 15.3877 14.7455 15.5996 14.5893 15.7559C14.433 15.9122 14.221 16 14 16H11.5M6.5 16C6.72101 16 6.93298 15.9122 7.08926 15.7559C7.24554 15.5996 7.33333 15.3877 7.33333 15.1667V11.8333C7.33333 11.6123 7.42113 11.4004 7.57741 11.2441C7.73369 11.0878 7.94565 11 8.16667 11H9.83333C10.0543 11 10.2663 11.0878 10.4226 11.2441C10.5789 11.4004 10.6667 11.6123 10.6667 11.8333V15.1667C10.6667 15.3877 10.7545 15.5996 10.9107 15.7559C11.067 15.9122 11.279 16 11.5 16M6.5 16H11.5" stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="mb-0">
          <span>Home</span>
        </p>
        <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="mb-0">Edit Profile</p>
      </div>
    </div>

    

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <section class="profile_title">
            <div class="container">
            <div class="py-3">
  <div class="d-flex justify-content-between align-items-center">
    <!-- User Name Section -->
    <h3>Dr. {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
    
    <!-- Edit Profile Link Section -->
    <a href="editprofile" class="btn btn-primary ">
      
      Edit Profile
    </a>
  </div>
</div>

              <div class="profile_details pb-5">
                <div class="row">
               
    <div class="col-md-6 col-lg-4 py-3">
    <form id="updateProfileForm" method="POST" enctype="multipart/form-data" action="{{ route('doctor.update') }}">
    @csrf
    <!-- Include your form fields here -->

    <!-- Avatar Upload -->
        <div class="profile_img_bg w-100">
            <div class="circle">
            <img class="profile-pic" src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Profile Picture">


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
                    <form id="updateForm" enctype="multipart/form-data" method="POST" action="{{ route('doctor.update') }}">
                    @csrf

                        <div class="row">
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">First Name <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Jane">
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Last Name <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Cooper">
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Gender <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="gender" value="{{$user->gender}}" placeholder="Male/Female">
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                            <label for="" class="mb-2">Speciality <span class="red_f">*</span></label>
                            <input type="text" class="form-control" name="speciality" value="{{$user->speciality}}"  placeholder="Add Experience">
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Experience <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="experience" value="{{$user->experience}}"  placeholder="Add Experience">
                            </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex">
                            <div class="pb-4">
                              <h4 class="mb-0">Contact Details</h4>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Email <span class="red_f">*</span></label>
                              <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Enter email Id">
                            </div>  
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Phone Number <span class="red_f">*</span></label>
                              <input type="number" class="form-control" value="{{$user->phone}}" name="phone" placeholder="Enter phone number">
                            </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex">
                            <div class="pb-4">
                              <h4 class="mb-0">Address Details</h4>
                            </div>
                          </div>
                          <div class="col-lg-12 py-2">
                            <div>
                              <label for="" class="mb-2">Address <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->address}}" name="address" placeholder="Enter Address">
                            </div>
                          </div>
                         <div class="col-lg-12 py-2">
                            <div>
                              <label for="" class="mb-2">Locality <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->locality}}" name="locality" placeholder="Enter Address">
                            </div>
                          </div><div class="col-lg-12 py-2">
                            <div>
     

                              <label for="" class="mb-2">Latitude, Longitude <span class="red_f">*</span></label>
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
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Country <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->country}}" >
                            </div>
                          </div>
                          
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">State <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->state}}" >
                            </div>
                          </div>
                          
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">City <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->city}}" >
                            </div>
                          </div>
                          
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Zip Code <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->zipcode}}" name="zipcode" placeholder="Enter Zip Code">
                            </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex">
                            <div class="pb-4">
                              <h4 class="mb-0">Other Details</h4>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Language Spoken  <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value=" {{ implode(', ', array_column($languages, 'name')) }}" name="language" placeholder="Hindi, English">
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Education Level <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->education}}" name="education" placeholder="MBBS, MD">
                            </div>
                          </div>
                          <div class="col-lg-12 py-2">
                            <div>
                              <label for="" class="mb-2">Bio </label>
                              <textarea name="" class="form-control" name="bio" placeholder="Write About Yourself" id="">{{$user->bio}}</textarea>
                            </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex align-items-center justify-content-between pb-4">
                            <div class="">
                              <h4 class="mb-0">Experiences</h4>
                            </div>
                            <!-- List of experiences -->
                            </div>
                            <div class="col-lg-12 py-2">
                            <div>
                            <table class="table table-striped table-bordered">
                              <tr>
                              <th>Organisation Name</th>
                              <th>From</th>
                              <th>To</th>
                            </tr>

                            @foreach ($experiences as $index => $experience)
                            <tr>
                                
                                   <td> {{ htmlspecialchars($experience->name) }}</td>
                                   <td> {{ htmlspecialchars($experience->from) }}</td>
                                   <td> {{ htmlspecialchars($experience->to) }}</td>
                            </tr>
                               
                            @endforeach

                      </table>
                          </div>
                          </div>
                           <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex align-items-center justify-content-between pb-4">
                            <div class="">
                              <h4 class="mb-0">Certificates</h4>
                            </div>
                            <!-- List of experiences -->
                            </div>
                            <div class="col-lg-12 py-2">
                            <div>
                            <table class="table table-striped table-bordered">
                              <tr>
                              <th>Certificate Name</th>
                              <th>Issued By</th>
                              <th>File</th>
                            </tr>

                            @foreach ($certificates as $index => $certificate)
                            <tr>
                                
                                   <td> {{ htmlspecialchars($certificate->name) }}</td>
                                   <td> {{ htmlspecialchars($certificate->by) }}</td>
                                   <td> <a href="/certificates/{{ $certificate->file }}" target="_blank">View File</a></td>
                            </tr>
                               
                            @endforeach

                      </table>
                          </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Fee <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->price}}" >
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="" class="mb-2">Status <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->status}}" >
                            </div>
                          </div>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</main>


@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Replace '#your-form-id' with the actual ID of your form
    $('input').prop('readonly', true);
});
</script>
<style>.btn-primary {
    background: #000066;
    border-color: #000066;
}</style>
  @endsection