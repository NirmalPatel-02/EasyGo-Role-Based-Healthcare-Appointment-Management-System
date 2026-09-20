<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'EASYGO - ' . @yield('title') }}</title>
    <meta name="description" content="{{ 'Default description for the site.' }}">
    <meta property="og:image" content="{{ asset('asset/img/medisync_logo.png') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/media.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('asset/img/medisync_logo.png') }}">
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('asset/img/medisync_logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#"><span>Get The App</span></a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#"><span>For Doctors</span></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('sign_up') }}"><span class="blue_f">Login / Sign
                                Up</span></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('book_appointment') }}">
                            <div class="custone_book_appoin_btn d-flex align-items-center">Book Free Appointment</div>
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#">
                            <div class="position-relative">
                                <div class="msg_count">6</div>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="..." fill="#302C36" />
                                </svg>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="User_admin">
                                <div class="dropdown">
                                    <button class="btn w-100" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="dr_user_img">
                                                <img src="{{ asset('asset/img/dr_user_img.png') }}" class="w-100 h-100"
                                                    alt="">
                                            </div>
                                            <div class="text-start">
                                                <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                                <p class="mb-0">{{ Auth::user()->role }}</p>
                                            </div>
                                            <div>
                                                <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="..." fill="#302C36" />
                                                </svg>
                                            </div>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item" type="button">
                                                <div class="d-flex align-items-center py-2">
                                                    <svg width="16" height="20" class="me-2" viewBox="0 0 16 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="..." stroke="#0A0101" />
                                                    </svg>Manage Profile
                                                </div>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="button">
                                                <div class="d-flex align-items-center py-2">
                                                    <svg width="20" height="20" class="me-2" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="..." stroke="#0A0101" />
                                                    </svg>Booking / Scheduled
                                                </div>
                                            </button>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="dropdown-item" type="submit">
                                                    <div class="d-flex align-items-center py-2">
                                                        <svg width="20" height="20" class="me-2" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="..." stroke="#333333" />
                                                        </svg>Log out
                                                    </div>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-6 py-3">
                    <div>
                        <img src="{{ asset('asset/img/medisync_logo.png') }}" alt="">
                        <p class="grey_f">
                            We are a lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat
                            <span class="dots">...</span><span class="more" style="display: none;">, erisque enim
                                ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae
                                massa.</span>
                            <span onclick="myFunction(this)" class="myBtn blue_f" style="cursor: pointer;">Read
                                more</span>
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#">
                                <div class="social_icon d-flex justify-content-center align-items-center">
                                    <!-- SVG icon code -->
                                </div>
                            </a>
                            <a href="#">
                                <div class="social_icon d-flex justify-content-center align-items-center">
                                    <!-- SVG icon code -->
                                </div>
                            </a>
                            <a href="#">
                                <div class="social_icon d-flex justify-content-center align-items-center">
                                    <!-- SVG icon code -->
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 py-3">
                    <div>
                        <h3>Services</h3>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Book Appointment</p>
                        </a>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Treatment</p>
                        </a>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Plan Surgery</p>
                        </a>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Doctors</p>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 py-3">
                    <div>
                        <h3>About</h3>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">About Us</p>
                        </a>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Contact Us</p>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 py-3">
                    <div>
                        <h3>Support</h3>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">FAQs</p>
                        </a>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Support</p>
                        </a>
                        <a href="#" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Terms & Conditions</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0b5Gv5Us3t5wK5Z9Bd6FP5lZy5tmgopQbEovDzVzF6TxFjS2" crossorigin="anonymous">
    </script>

    <script>
    function myFunction(btn) {
        var dots = btn.previousElementSibling;
        var moreText = dots.nextElementSibling;
        if (moreText.style.display === "none") {
            moreText.style.display = "inline";
            dots.style.display = "none";
            btn.innerHTML = "Read less";
        } else {
            moreText.style.display = "none";
            dots.style.display = "inline";
            btn.innerHTML = "Read more";
        }
    }
    </script>
</body>

</html>