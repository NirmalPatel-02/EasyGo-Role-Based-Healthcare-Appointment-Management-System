<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Go - Verify Your Email</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.scss')}}">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/media.css')}}">
    <link rel="icon" type="image/png" href="{{asset('asset/img/medisync_logo.png')}}">
    <!-- BOOSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FONTS FAMILY -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- LOGIN SECTION STRAT -->
     <section class="Login_Form">
        <div class="row m-0 h-100">
            <div class="col-lg-6 p-0">
                <div class="left_part h-100 d-flex justify-content-center align-items-center">
                    <img src="{{asset('asset/img/dr_image.png')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="h-100 d-flex justify-content-between flex-column">
                    <div class="right_part  h-100">
                        <div class="mb-3 text-center text-lg-start">
                            <img src="{{asset('asset/img/medisync_logo.png')}}" alt="">
                        </div>
                        <div class="text-center text-lg-start">
                            <h3>Set New Password</h3>
                            <p>No worries, we’ll send you reset instruction.</p>
                        </div>
                        <form action="">
                            <div class="py-2">
                                <label for="" class="mb-2">Email Id</label>
                                <div class="form_fild px-3 d-flex align-items-center justify-content-between">
                                    <div class="w-100">
                                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 3.5L8.89 8.76C9.21866 8.97928 9.6049 9.0963 10 9.0963C10.3951 9.0963 10.7813 8.97928 11.11 8.76L19 3.5M3 14.5H17C17.5304 14.5 18.0391 14.2893 18.4142 13.9142C18.7893 13.5391 19 13.0304 19 12.5V2.5C19 1.96957 18.7893 1.46086 18.4142 1.08579C18.0391 0.710714 17.5304 0.5 17 0.5H3C2.46957 0.5 1.96086 0.710714 1.58579 1.08579C1.21071 1.46086 1 1.96957 1 2.5V12.5C1 13.0304 1.21071 13.5391 1.58579 13.9142C1.96086 14.2893 2.46957 14.5 3 14.5Z" stroke="#828282" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <input type="email" class=" ms-2 w-75 border-0" placeholder="Enter email id">
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{route('setNewPassword')}}" class="link-underline link-underline-opacity-0">
                                <div class="custome_login_btn d-flex justify-content-center align-items-center mt-4">Continue</div>
                            </a>
                        </form>
                        
                        <div class="back_to_login text-center mt-3">
                            <a href="{{route('login')}}">
                                <svg width="16" height="15" class="me-2" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.70679 14.2069C7.51926 14.3944 7.26495 14.4997 6.99979 14.4997C6.73462 14.4997 6.48031 14.3944 6.29279 14.2069L0.292786 8.20692C0.105315 8.01939 0 7.76508 0 7.49992C0 7.23475 0.105315 6.98045 0.292786 6.79292L6.29279 0.792919C6.48139 0.610761 6.73399 0.509966 6.99619 0.512245C7.25838 0.514523 7.5092 0.619692 7.6946 0.8051C7.88001 0.990508 7.98518 1.24132 7.98746 1.50352C7.98974 1.76571 7.88894 2.01832 7.70679 2.20692L3.41379 6.49992H14.9998C15.265 6.49992 15.5194 6.60528 15.7069 6.79281C15.8944 6.98035 15.9998 7.2347 15.9998 7.49992C15.9998 7.76514 15.8944 8.01949 15.7069 8.20703C15.5194 8.39456 15.265 8.49992 14.9998 8.49992H3.41379L7.70679 12.7929C7.89426 12.9804 7.99957 13.2348 7.99957 13.4999C7.99957 13.7651 7.89426 14.0194 7.70679 14.2069Z" fill="#828282"/>
                                </svg>
                                Back to login
                            </a>
                        </div>
                    </div>
                    <div class="Copyright text-center pb-3">
                        <p class="mb-0">© Copyright 2024.  - All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- LOGIN SECTION END -->


    <!-- BOOSTRAP SCRIPT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        var verificationCode = [];
        $(".verification-code input[type=text]").keyup(function(e) {
            $(".verification-code input[type=text]").each(function(i) {
                verificationCode[i] = $(".verification-code input[type=text]")[i].value;
                $('#verificationCode').val(Number(verificationCode.join('')));
            });
            if ($(this).val() > 0) {
                if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event
                    .key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
                    $(this).next().focus();
                }
            } else {
                if (event.key == 'Backspace') {
                    $(this).prev().focus();
                }
            }
        });
    </script>
</body>
</html>