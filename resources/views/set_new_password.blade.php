<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Go</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.scss')}}">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/media.css')}}">
    <link rel="icon" type="image/png" href="{{asset('asset/img/EasyGo_logo.svg')}}">
    <meta property="og:image" content="https://easy-go.fruxinfo.co.in/{{asset('asset/img/easy_go_og.png')}}" />
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
                            <img src="{{asset('asset/img/EasyGo_logo.svg')}}" alt="">
                        </div>
                        <div class="text-center text-lg-start">
                            <h3>Set New Password</h3>
                            <p class="mb-2">Your new password must be different to previously used password</p>
                            <h6 class="blue_f">abcd@gmail.com</h6>
                        </div>
                        <form action="">
                            <div class="py-3">
                                <label for="" class="mb-2">Password</label>
                                <div class="form_fild px-3 d-flex align-items-center justify-content-between">
                                    <div class="w-100">
                                        <svg width="18" height="19" class="mb-1" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 7.5V5.5C14 2.73858 11.7614 0.5 9 0.5C6.23858 0.5 4 2.73858 4 5.5V7.5M9 12V14M5.8 18.5H12.2C13.8802 18.5 14.7202 18.5 15.362 18.173C15.9265 17.8854 16.3854 17.4265 16.673 16.862C17 16.2202 17 15.3802 17 13.7V12.3C17 10.6198 17 9.77976 16.673 9.13803C16.3854 8.57354 15.9265 8.1146 15.362 7.82698C14.7202 7.5 13.8802 7.5 12.2 7.5H5.8C4.11984 7.5 3.27976 7.5 2.63803 7.82698C2.07354 8.1146 1.6146 8.57354 1.32698 9.13803C1 9.77976 1 10.6198 1 12.3V13.7C1 15.3802 1 16.2202 1.32698 16.862C1.6146 17.4265 2.07354 17.8854 2.63803 18.173C3.27976 18.5 4.11984 18.5 5.8 18.5Z" stroke="#828282" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <input type="email" class=" ms-2 w-75 border-0" placeholder="Enter Password">
                                    </div>
                                    <div>
                                        <a href="#" class="link-underline link-underline-opacity-0">
                                            <div class=" custome_otp_btn">
                                                <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.74294 2.59232C10.1494 2.53223 10.5686 2.5 11.0004 2.5C16.1054 2.5 19.4553 7.00484 20.5807 8.78682C20.7169 9.0025 20.785 9.11034 20.8231 9.27667C20.8518 9.40159 20.8517 9.59866 20.8231 9.72358C20.7849 9.8899 20.7164 9.99846 20.5792 10.2156C20.2793 10.6901 19.8222 11.3571 19.2165 12.0805M5.72432 4.21504C3.56225 5.6817 2.09445 7.71938 1.42111 8.78528C1.28428 9.00187 1.21587 9.11016 1.17774 9.27648C1.1491 9.4014 1.14909 9.59844 1.17771 9.72336C1.21583 9.88968 1.28393 9.99751 1.42013 10.2132C2.54554 11.9952 5.89541 16.5 11.0004 16.5C13.0588 16.5 14.8319 15.7676 16.2888 14.7766M2.00042 0.5L20.0004 18.5M8.8791 7.37868C8.3362 7.92157 8.00042 8.67157 8.00042 9.5C8.00042 11.1569 9.34356 12.5 11.0004 12.5C11.8288 12.5 12.5788 12.1642 13.1217 11.6213" stroke="#828282" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3">
                                <label for="" class="mb-2">Confirm Password</label>
                                <div class="form_fild px-3 d-flex align-items-center justify-content-between">
                                    <div class="w-100">
                                        <svg width="18" height="19" class="mb-1" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 7.5V5.5C14 2.73858 11.7614 0.5 9 0.5C6.23858 0.5 4 2.73858 4 5.5V7.5M9 12V14M5.8 18.5H12.2C13.8802 18.5 14.7202 18.5 15.362 18.173C15.9265 17.8854 16.3854 17.4265 16.673 16.862C17 16.2202 17 15.3802 17 13.7V12.3C17 10.6198 17 9.77976 16.673 9.13803C16.3854 8.57354 15.9265 8.1146 15.362 7.82698C14.7202 7.5 13.8802 7.5 12.2 7.5H5.8C4.11984 7.5 3.27976 7.5 2.63803 7.82698C2.07354 8.1146 1.6146 8.57354 1.32698 9.13803C1 9.77976 1 10.6198 1 12.3V13.7C1 15.3802 1 16.2202 1.32698 16.862C1.6146 17.4265 2.07354 17.8854 2.63803 18.173C3.27976 18.5 4.11984 18.5 5.8 18.5Z" stroke="#828282" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <input type="email" class=" ms-2 w-75 border-0" placeholder="Confirm Password">
                                    </div>
                                    <div>
                                        <a href="#" class="link-underline link-underline-opacity-0">
                                            <div class=" custome_otp_btn">
                                                <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.74294 2.59232C10.1494 2.53223 10.5686 2.5 11.0004 2.5C16.1054 2.5 19.4553 7.00484 20.5807 8.78682C20.7169 9.0025 20.785 9.11034 20.8231 9.27667C20.8518 9.40159 20.8517 9.59866 20.8231 9.72358C20.7849 9.8899 20.7164 9.99846 20.5792 10.2156C20.2793 10.6901 19.8222 11.3571 19.2165 12.0805M5.72432 4.21504C3.56225 5.6817 2.09445 7.71938 1.42111 8.78528C1.28428 9.00187 1.21587 9.11016 1.17774 9.27648C1.1491 9.4014 1.14909 9.59844 1.17771 9.72336C1.21583 9.88968 1.28393 9.99751 1.42013 10.2132C2.54554 11.9952 5.89541 16.5 11.0004 16.5C13.0588 16.5 14.8319 15.7676 16.2888 14.7766M2.00042 0.5L20.0004 18.5M8.8791 7.37868C8.3362 7.92157 8.00042 8.67157 8.00042 9.5C8.00042 11.1569 9.34356 12.5 11.0004 12.5C11.8288 12.5 12.5788 12.1642 13.1217 11.6213" stroke="#828282" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{route('index')}}" class="link-underline link-underline-opacity-0">
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