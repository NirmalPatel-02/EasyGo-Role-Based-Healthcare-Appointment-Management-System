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
    <link rel="icon" type="image/png" href="{{ asset('asset/img/EasyGo_logo.svg') }}">
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
                            <a href="/"><img src="{{ asset('asset/img/EasyGo_logo.svg') }}" alt="" /></a>
                        </div>
                        <div class="text-center text-lg-start">
                            <h3>Welcome to Easy Go!</h3>
                            <p>Create your account as</p>
                        </div>
                        <form id="signup-form" action="{{ route('clientRegister') }}" method="POST">
    <!-- Toggle for Client/Doctor -->
    <div class="form-switch-container mb-2 pb-3">
        <button id="client-btn" class="form-switch-btn active" type="button">Client</button>
        <button id="doctor-btn" class="form-switch-btn" type="button">Doctor</button>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="py-2">
                <label for="first_name" class="mb-2">First Name</label>
                <div class="form_fild px-3 d-flex align-items-center justify-content-between">
                    <input type="text" name="first_name" class="w-100 border-0" placeholder="Enter your first name" required />
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="py-2">
                <label for="last_name" class="mb-2">Last Name</label>
                <div class="form_fild px-3 d-flex align-items-center justify-content-between">
                    <input type="text" name="last_name" class="w-100 border-0" placeholder="Enter your last name" required />
                </div>
            </div>
        </div>
    </div>

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
            <input type="text" name="otp[]" maxlength="1" class="form-control w-100 form_fild text-center"  />
            <input type="text" name="otp[]" maxlength="1" class="form-control w-100 form_fild text-center"  />
            <input type="text" name="otp[]" maxlength="1" class="form-control w-100 form_fild text-center"  />
            <input type="text" name="otp[]" maxlength="1" class="form-control w-100 form_fild text-center"  />
        </div>
    </div>
    <div class="text-end">
        <a href="#" class="link-underline link-underline-opacity-0" id="timer">
            <span>Resend OTP? <span id="time">00:00</span> Seconds</span>
        </a>
    </div>
</div>
    <button type="submit" id="signup-btn" class="custome_login_btn w-100 mt-4">
        <span id="signup-btn-text">Sign Up</span>
        <span id="signup-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    </button>
</form>

                        <div class="pt-3 text-center">
                            <p class="mb-0">Already have an account? <a href="login"
                                    class="link-underline link-underline-opacity-0"><span>Sign In</span></a>
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
                    canResend = true; // Allow resend
                } else {
                    $('#time').text(countdown); // Update countdown
                    $('#timer').show(); 
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
                            action: 'register'
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

                                    $otpMsg.html(errorMessages.join("<br>")) // Display errors as a list
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
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessages = '';
                                $.each(errors, function (key, value) {
                                    errorMessages += value[0] + '<br>'; 
                                });

                                $("#otp-msg").html(errorMessages)
                                    .addClass("text-danger")
                                    .removeClass("text-success")
                                    .show();
                            } else {
                                $("#otp-msg").text("An unexpected error occurred. Please try again.")
                                    .addClass("text-danger")
                                    .removeClass("text-success")
                                    .show();
                            }
                        }
                    });
                } else {
                    $("#otp-msg").text("Please enter a valid phone number.")
                        .addClass("text-danger")
                        .removeClass("text-success")
                        .show();
                }
            }
        });

        // Collect OTP from the inputs
        function getOtpFromInputs() {
            let otp = "";
            $('input[name="otp[]"]').each(function () {
                otp += $(this).val(); // Concatenate the values
            });
            return otp;
        }

        // Handle OTP verification input
        $('input[name="otp[]"]').on('input', function () {
            var currentInput = $(this);

            if (currentInput.val().length === parseInt(currentInput.attr('maxlength'), 10)) {
                var nextInput = currentInput.next('input[name="otp[]"]');
                if (nextInput.length > 0) {
                    setTimeout(function () {
                        nextInput.focus();
                    }, 10); 
                }
            }
        }).on('keydown', function (e) {
            var currentInput = $(this);

            if (e.key === 'Backspace' && currentInput.val().length === 0) {
                var prevInput = currentInput.prev('input[name="otp[]"]');
                if (prevInput.length > 0) {
                    prevInput.focus();
                }
            }
        });

        $('#signup-form').submit(function (event) {
            event.preventDefault();
            if ($("#otp-section").is(":hidden")) {
        // Show error alert using SweetAlert
        Swal.fire({
            title: "Error!",
            text: "Please click 'Send OTP' before logging in.",
            icon: "error",
            confirmButtonText: "Okay"
        });
        return; // Stop further execution of form submission
    }

    // Dynamically toggle the 'required' attribute for OTP fields
    $('input[name="otp[]"]').each(function () {
        if ($("#otp-section").is(":visible")) {
            $(this).attr('required', true); // Make required if visible
        } else {
            $(this).removeAttr('required'); // Remove required if hidden
        }
    });

            const otp = getOtpFromInputs();

            if (otp.length !== 4) {
                Swal.fire({
                    title: "Error!",
                    text: "Please enter a valid 4-digit OTP.",
                    icon: "error",
                    confirmButtonText: "Okay"
                });
                return;
            }

            const formData = {};
            $(this).serializeArray().forEach(function (item) {
                formData[item.name] = item.value;
            });
            formData.otp = otp;

            $('#signup-btn-text').addClass('d-none');
            $('#spinner').removeClass('d-none');

            $.ajax({
                url: $('#signup-form').attr("action"),
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function (response) {
                    $('#signup-btn-text').removeClass('d-none');
                    $('#spinner').addClass('d-none');

                    if (response.success) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false, 
                            timer: 1000
                        }).then(function () {
                            // console.log(response.redirect_to);
                            window.location.href = response.redirect_to;
                        });
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
                    $('#signup-btn-text').removeClass('d-none');
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
                            text: "Failed to register. Please try again.",
                            icon: "error",
                            confirmButtonText: "Okay"
                        });
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        const form = $('#signup-form');
        const clientBtn = $('#client-btn');
        const doctorBtn = $('#doctor-btn');

        // Default action is for Client
        form.attr('action', "{{ route('registerClient') }}");
        clientBtn.addClass('active'); // Set Client as active initially
        doctorBtn.removeClass('active'); // Ensure Doctor is inactive

        // Toggle between Client and Doctor on button click
        clientBtn.click(function () {
            form.attr('action', "{{ route('registerClient') }}");
            clientBtn.addClass('active'); // Highlight Client
            doctorBtn.removeClass('active'); // De-highlight Doctor
        });

        doctorBtn.click(function () {
            form.attr('action', "{{ route('registerDoctor') }}");
            doctorBtn.addClass('active'); // Highlight Doctor
            clientBtn.removeClass('active'); // De-highlight Client
        });
    });
</script>
<style>
    /* Custom styling for the Client/Doctor buttons */
    .form-switch-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 20px; /* Add spacing if needed */
    }

    .form-switch-btn {
        flex: 1;
        padding: 10px;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        border: 2px solid #000066;
        background-color: transparent;
        color:#000066;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .form-switch-btn.active {
        background-color: #000066;
        color: #fff;
        border-color: #000066;
    }
    .disabled {
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}
</style>

</body>

</html>