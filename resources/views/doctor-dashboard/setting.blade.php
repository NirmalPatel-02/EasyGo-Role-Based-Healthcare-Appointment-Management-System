@extends('doctor-dashboard.layout')
@section('title','Doctors Settings')
@section('content')

<main id="main" class="main">
    <div class="d-flex justify-content-between">
        <div class="pagetitle">
            <h1 class="mb-2">Setting</h1>
        </div>

        <!-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="./asset/icon/more.png" class="mt-2" alt="" style="width: 30px"></a> -->
    </div>
    <section class="section dashboard">
        <div class="row desbord_card p-3">
            <div class="col-md-6">
                <div class="edit_profile">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="mb-0 fs-5">Edit Profile</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20.6997 6.75006L11.7559 15.6938C10.8653 16.5844 8.22151 16.9969 7.63089 16.4063C7.04026 15.8156 7.44339 13.1719 8.33401 12.2813L17.2872 3.32816C17.5079 3.08728 17.7752 2.89365 18.073 2.75893C18.3706 2.62421 18.6926 2.55118 19.0193 2.5443C19.3459 2.53743 19.6707 2.59681 19.9738 2.71888C20.2769 2.84095 20.5521 3.0232 20.7828 3.25458C21.0135 3.48595 21.195 3.76167 21.3163 4.0651C21.4375 4.36854 21.4961 4.69338 21.4883 5.02006C21.4805 5.34673 21.4065 5.66847 21.2711 5.9658C21.1355 6.26312 20.9412 6.52993 20.6997 6.75006Z" stroke="#EE6659" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.0625 4.50003H6.375C5.38043 4.50003 4.42667 4.89511 3.7234 5.59838C3.02015 6.30164 2.625 7.25546 2.625 8.25003V17.625C2.625 18.6196 3.02015 19.5734 3.7234 20.2767C4.42667 20.98 5.38043 21.375 6.375 21.375H16.6875C18.7594 21.375 19.5 19.6875 19.5 17.625V12.9375" stroke="#EE6659" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="edit_profile_form p-3">
                        <form action="">
                            <div>
                                <label for="" class="mb-2">User Name</label>
                                <div class="input_fild">
                                    <input type="text" class="form-control py-2" placeholder="Enter User Name">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="" class="mb-2 ">Email</label>
                                <div class="input_fild">
                                    <input type="email" class="form-control py-2" placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="" class="mb-2 ">Contact number</label>
                                <div class="input_fild">
                                    <input type="number" class="form-control py-2" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="" class="mb-2 ">Address</label>
                                <div class="input_fild">
                                    <textarea name="" class="w-100" id="" cols="30" rows="5" placeholder="Enter Address"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="edit_profile pt-4 pt-md-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="mb-0 fs-5">Change Password</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20.6997 6.75006L11.7559 15.6938C10.8653 16.5844 8.22151 16.9969 7.63089 16.4063C7.04026 15.8156 7.44339 13.1719 8.33401 12.2813L17.2872 3.32816C17.5079 3.08728 17.7752 2.89365 18.073 2.75893C18.3706 2.62421 18.6926 2.55118 19.0193 2.5443C19.3459 2.53743 19.6707 2.59681 19.9738 2.71888C20.2769 2.84095 20.5521 3.0232 20.7828 3.25458C21.0135 3.48595 21.195 3.76167 21.3163 4.0651C21.4375 4.36854 21.4961 4.69338 21.4883 5.02006C21.4805 5.34673 21.4065 5.66847 21.2711 5.9658C21.1355 6.26312 20.9412 6.52993 20.6997 6.75006Z" stroke="#EE6659" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.0625 4.50003H6.375C5.38043 4.50003 4.42667 4.89511 3.7234 5.59838C3.02015 6.30164 2.625 7.25546 2.625 8.25003V17.625C2.625 18.6196 3.02015 19.5734 3.7234 20.2767C4.42667 20.98 5.38043 21.375 6.375 21.375H16.6875C18.7594 21.375 19.5 19.6875 19.5 17.625V12.9375" stroke="#EE6659" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="edit_profile_form p-3">
                        <form action="">
                            <div>
                                <label for="" class="mb-2">Current Password</label>
                                <div class="input_fild d-flex align-items-center">
                                    <input type="password" class="form-control py-2" placeholder="Enter Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-2" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                        <path d="M15.0009 12.5C15.0009 14.1569 13.6578 15.5 12.0009 15.5C10.3441 15.5 9.00098 14.1569 9.00098 12.5C9.00098 10.8431 10.3441 9.5 12.0009 9.5C13.6578 9.5 15.0009 10.8431 15.0009 12.5Z" stroke="#EE6659" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.0012 5.5C7.52354 5.5 3.73326 8.44288 2.45898 12.5C3.73324 16.5571 7.52354 19.5 12.0012 19.5C16.4788 19.5 20.2691 16.5571 21.5434 12.5C20.2691 8.44291 16.4788 5.5 12.0012 5.5Z" stroke="#EE6659" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="" class="mb-2 ">New Password</label>
                                <div class="input_fild d-flex align-items-center">
                                    <input type="password" class="form-control py-2" placeholder="Enter New Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-2" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                        <path d="M2.99902 3.5L20.999 21.5M9.8433 10.4136C9.32066 10.9536 8.99902 11.6892 8.99902 12.5C8.99902 14.1569 10.3422 15.5 11.999 15.5C12.8215 15.5 13.5667 15.169 14.1086 14.633M6.49902 7.14715C4.59972 8.40034 3.15305 10.2839 2.45703 12.5C3.73128 16.5571 7.52159 19.5 11.9992 19.5C13.9881 19.5 15.8414 18.9194 17.3988 17.9184M10.999 5.54939C11.328 5.51673 11.6617 5.5 11.9992 5.5C16.4769 5.5 20.2672 8.44291 21.5414 12.5C21.2607 13.394 20.8577 14.2338 20.3522 15" stroke="#EE6659" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="" class="mb-2 ">Confirm Password</label>
                                <div class="input_fild d-flex align-items-center">
                                    <input type="password" class="form-control py-2" placeholder="Enter Confirm Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-2" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                        <path d="M15.0009 12.5C15.0009 14.1569 13.6578 15.5 12.0009 15.5C10.3441 15.5 9.00098 14.1569 9.00098 12.5C9.00098 10.8431 10.3441 9.5 12.0009 9.5C13.6578 9.5 15.0009 10.8431 15.0009 12.5Z" stroke="#EE6659" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.0012 5.5C7.52354 5.5 3.73326 8.44288 2.45898 12.5C3.73324 16.5571 7.52354 19.5 12.0012 19.5C16.4788 19.5 20.2691 16.5571 21.5434 12.5C20.2691 8.44291 16.4788 5.5 12.0012 5.5Z" stroke="#EE6659" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="py-3">
                        Notification & Security
                    </div>
                    <div class="edit_profile_form p-3">
                        <form action="">
                            <div class="on_off p-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <span>Email Notification</span>
                                    <p class="mb-0">Turn on email notification to get updates through email</p>
                                </div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="on_off p-2 mt-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <span>Multiple User Login</span>
                                    <p class="mb-0">Turn on multiple login to access multiple login for same user</p>
                                </div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end mt-4">
                <div class="btn save_btn">Save</div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('scripts')
<script>
      $('.setting').addClass('active_side');
    </script>
@endsection