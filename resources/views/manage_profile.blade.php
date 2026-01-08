@extends('layout.client')
@section('title','Simple Steps to Manage Your Profile')
@section('content')


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
                    <div class="profile_img_bg w-100">
                        <div class="circle">
                            <img class="profile-pic" src="{{ asset('avatars/' . Auth::user()->avatar) }}">

                            </div>
                            <div class="p-image">
                                <div class="upload-button">
                                    <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.14008 17.2201C5.04871 17.2213 3.99527 16.8198 3.18157 16.0925C2.36787 15.3652 1.85114 14.3632 1.73036 13.2785C1.60958 12.1939 1.89326 11.1028 2.52704 10.2143C3.16082 9.32581 4.10014 8.70241 5.16504 8.46353C4.85692 7.02655 5.13227 5.52603 5.93049 4.29207C6.72872 3.05811 7.98444 2.19178 9.42142 1.88367C10.8584 1.57556 12.3589 1.8509 13.5929 2.64913C14.8268 3.44735 15.6932 4.70308 16.0013 6.14005H16.1121C17.4859 6.13867 18.8113 6.64783 19.8309 7.56868C20.8505 8.48953 21.4915 9.75637 21.6296 11.1233C21.7677 12.4902 21.3929 13.8596 20.5781 14.9658C19.7632 16.0719 18.5665 16.8359 17.2201 17.1093M15.0041 13.8961L11.6801 10.5721M11.6801 10.5721L8.35608 13.8961M11.6801 10.5721V23.868" stroke="#302C36" stroke-width="2.216" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> Upload Profile
                                </div>
                            <!-- <i class="fa fa-camera upload-button"></i> -->
                                <input class="file-upload" type="file" accept="image/*"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 d-flex align-items-center py-3">
                    <div class="right_part">
                        <div class="d-flex">
                            <div>
                                <h4>Personal Details</h4>
                            </div>
                        </div>
                        
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6 py-2">
                                    <div>
                                        <label for="" class="mb-2">First Name</label>
                                        <input type="text" class="form-control" placeholder="Jane">
                                    </div>
                                </div>
                                <div class="col-lg-6 py-2">
                                    <div>
                                        <label for="" class="mb-2">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Cooper">
                                    </div>
                                </div>
                                <div class="col-lg-6 py-2">
                                    <div>
                                        <label for="" class="mb-2">Email ID</label>
                                        <input type="text" class="form-control" placeholder="abcd@google.com">
                                    </div>
                                </div>
                                <div class="col-lg-6 py-2">
                                    <div>
                                        <label for="" class="mb-2">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your phone number">
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
<!-- PROFILE TITLE SECTION END -->

@endsection