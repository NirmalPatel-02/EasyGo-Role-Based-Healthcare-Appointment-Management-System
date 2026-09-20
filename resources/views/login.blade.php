<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>It's Quick to Sign Up – Join Us Now!</title>
    <meta name="description"
        content="Sign up for the Easy Go Doctors App to connect with patients, manage your schedule, and enhance your healthcare practice. Join our community of professionals today!">
    <meta property="og:title" content="It's Quick to Sign Up – Join Us Now!" />
    <meta property="og:site_name" content="Easy Go" />
    <meta property="og:url" content="{{ url('sign_up') }}" />
    <meta property="og:description"
        content="Sign up for the Easy Go Doctors App to connect with patients, manage your schedule, and enhance your healthcare practice. Join our community of professionals today!" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('asset/img/easy_go_og.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('asset/img/medisync_logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/media.css') }}">

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- LOGIN SECTION START -->
    <section class="Login_Form">
        <div class="row m-0 h-100">
            <div class="col-lg-6 p-0">
                <div class="left_part h-100 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('asset/img/dr_image.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="h-100 d-flex justify-content-between flex-column">
                    <div class="right_part h-100">
                        <div class="mb-3 text-center text-lg-start">
                        <a href="/"><img src="{{ asset('asset/img/medisync_logo.png') }}" alt="" /></a>
                        </div>
                        <div class="text-center text-lg-start">
                            <h3>Login</h3>
                            <p>Enter Details</p>
                        </div>
                        <form id="login-form" action="{{ route('login.post') }}" method="POST">
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

                            <div class="py-2">
                                <label for="phone" class="mb-2">Phone Number</label>
                                <div class="form_fild px-3 d-flex align-items-center justify-content-between">
                                <input type="text" name="phone" id="phone-input" 
       class="number_fild ms-2 w-75 border-0" 
       placeholder="Enter Phone Number" maxlength="10" required 
       oninput="this.value = this.value.replace(/\D/g, '')" />

                                        <a href="javascript:void(0)" class="link-underline link-underline-opacity-0 disabled" id="send-otp-button">
                                                    <div class="custome_otp_btn">Send OTP</div>
                                                </a>
                                </div>
                                <span id="otp-msg" class="text-success">&nbsp;</span>
                            </div>
                        <div id="otp-section">
                            <div class="py-2">
                                <label for="otp" class="mb-2">Enter OTP</label>
                                <div class="verification-code d-flex gap-4">
                                    <input type="text" name="otp[]" maxlength="1"
                                        class="form-control w-100 form_fild text-center"  />
                                    <input type="text" name="otp[]" maxlength="1"
                                        class="form-control w-100 form_fild text-center"  />
                                    <input type="text" name="otp[]" maxlength="1"
                                        class="form-control w-100 form_fild text-center"  />
                                    <input type="text" name="otp[]" maxlength="1"
                                        class="form-control w-100 form_fild text-center"  />
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="#" class="link-underline link-underline-opacity-0" id="timer">
                                    <span >Resend OTP?  <span id="time">00:00</span> Seconds</span>
                                </a>
                            </div>
</div>
                            <button type="submit" id="login-btn" class="custome_login_btn w-100 mt-4">
                                <span id="login-btn-text">Sign In</span>
                                <span id="signup-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </form>

                        <div class="pt-3 text-center">
                            <p class="mb-0">Don't have an account? <a href="signup"
                                    class="link-underline link-underline-opacity-0"><span>Sign Up</span></a>
                            </p>
                        </div>
                    </div>
                    <div class="Copyright text-center pb-3">
                        <p class="mb-0">© Copyright 2024. - All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- LOGIN SECTION END -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>.disabled {
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}</style>
    <script>
        $(document).ready(function () {
            var canResend = true;
            var countdown = 59;
            $("#timer").hide();
            $("#otp-section").hide(); // Initially hide OTP section
       

       // Enable "Send OTP" button only when a valid 10-digit phone number is entered
       $('input[name="phone"]').on('input', function () {
           const phone = $(this).val();
           if (/^\d{10}$/.test(phone)) {
               $('#send-otp-button').removeClass('disabled', false); // Enable button
           } else {
               $('#send-otp-button').addClass('disabled', true); // Disable button
           }
       });
            // Function to start the countdown timer
            function startTimer() {
                var timer = setInterval(function () {
                    if (countdown <= 0) {
                        clearInterval(timer);
                        $('#send-otp-button').text('Resend OTP'); // Reset button text
                        $('#send-otp-button').show();
                        $('#send-otp-button').css('color', "red");
                        $('#timer').hide();
                        // Enable resend button
                        canResend = true; // Allow resend
                    } else {

                        $('#time').text(countdown); // Update countdown
                        $('#timer').show(); // Update countdown
                        countdown--;
                    }
                }, 1000);
            }

            // Set CSRF token in the AJAX request header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle OTP request
            $('#send-otp-button').click(function (event) {
    event.preventDefault();

    if (canResend) {
        var phone = $('input[name="phone"]').val(); // Get phone number from input field
        if (phone) {
            $.ajax({
                url: "{{route('sendOtp')}}", // URL for the OTP API
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    phone: phone,
                    action: "login",
                }),
                success: function (data) {
                    let $otpMsg = $("#otp-msg");
                    if (data.success) {
                        $otpMsg.text(data.message)
                            .addClass("text-success")
                            .removeClass("text-danger")
                            .show();

                        $('#send-otp-button').hide(); // Disable button after sending OTP
                        canResend = false;
                        countdown = 59;
                        startTimer(); // Start countdown timer
                        $("#otp-section").show(); // Show OTP section
                    } else {
                        if (data.errors) {
                            let errorMessages = [];
                            $.each(data.errors, function (field, messages) {
                                errorMessages = errorMessages.concat(messages);
                            });

                            $otpMsg.text(errorMessages.join(" "))
                                .addClass("text-danger")
                                .removeClass("text-success")
                                .show();
                        } else if (data.message) {
                            $otpMsg.text(data.message)
                                .addClass("text-danger")
                                .removeClass("text-success")
                                .show();
                        }
                    }
                },
                error: function () {
                    $("#otp-msg").text("An unexpected error occurred.")
                        .addClass("text-danger")
                        .removeClass("text-success")
                        .show();
                }
            });
        } else {
            $("#otp-msg").text("Enter a valid mobile number.")
                .addClass("text-danger")
                .removeClass("text-success")
                .show();
        }
    }
});


            // Handle OTP verification input
            $('input[name="otp[]"]').on('input', function () {
                var currentInput = $(this);

                // Move to the next input if maxlength is reached
                if (currentInput.val().length === parseInt(currentInput.attr('maxlength'), 10)) {
                    var nextInput = currentInput.next('input[name="otp[]"]');
                    if (nextInput.length > 0) {
                        setTimeout(function () {
                            nextInput.focus();
                        }, 10); // Small delay to ensure input is registered
                    }
                }
            }).on('keydown', function (e) {
                var currentInput = $(this);

                // Move to the previous input on backspace if input is empty
                if (e.key === 'Backspace' && currentInput.val().length === 0) {
                    var prevInput = currentInput.prev('input[name="otp[]"]');
                    if (prevInput.length > 0) {
                        prevInput.focus();
                    }
                }
            });

            $('#login-form').submit(function (event) {
    event.preventDefault();
    if ($("#otp-section").is(":hidden")) {
        Swal.fire({
                    title: "Error!",
                    text: "Please click Send OTP before login",
                    icon: "error",
                    confirmButtonText: "Okay"
                });
                return;
            
    }
    else {
     

    // Dynamically toggle the 'required' attribute for OTP fields
    $('input[name="otp[]"]').each(function () {
        if ($("#otp-section").is(":visible")) {
            $(this).attr('required', true); // Make required if visible
        } else {
            $(this).removeAttr('required'); // Remove required if hidden
        }
    });

    // Concatenate OTP array values into a single string
    let otp = '';
    $('input[name="otp[]"]').each(function () {
        otp += $(this).val();
    });

    // Append the concatenated OTP to the form data
    let formData = $(this).serializeArray();
    formData.push({ name: 'otp', value: otp });

    // Show spinner and hide button text
    $('#login-btn-text').addClass('d-none');
    $('#spinner').removeClass('d-none');

    // Send AJAX request
    $.ajax({
        url: "{{ route('login.post') }}",
        method: 'POST',
        data: formData,
        success: function (response) {
            $('#login-btn-text').removeClass('d-none');
            $('#spinner').addClass('d-none');

            if (response.success) {
                window.location.href = response.redirect_to;
            } else {
                Swal.fire({
                    title: "Error!",
                    text: response.message,
                    icon: "error",
                    confirmButtonText: "Okay"
                });
            }
        },
        error: function (xhr) {
            $('#login-btn-text').removeClass('d-none');
            $('#spinner').addClass('d-none');

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                $.each(errors, function (key, value) {
                    errorMessages += value[0] + '<br>';
                });

                Swal.fire({
                    title: "Validation Error!",
                    html: errorMessages,
                    icon: "error",
                    confirmButtonText: "Okay"
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Failed to login. Please try again.",
                    icon: "error",
                    confirmButtonText: "Okay"
                });
            }
        }
    });
}
});



        });
    </script>
</body>

</html>