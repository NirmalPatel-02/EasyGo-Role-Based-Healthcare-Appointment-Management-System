<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Easygo</title>
    <meta name="description" content="{{ 'Default description for the site.' }}">
    <meta property="og:image" content="{{ asset('asset/img/EasyGo_logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/media.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('asset/img/EasyGo_logo.svg') }}">
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
            <a class="navbar-brand" href="{{route('index')}}">
                <img src="{{ asset('asset/img/EasyGo_logo.svg') }}" alt="">
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
                        <a class="nav-link" href="#" id="fav"><span><svg width="18" height="14" class="me-2" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.5225 13.9998L8.12918 13.7637C7.79838 13.5651 0.0313717 8.85288 0.0313717 4.60391C-0.00784573 4.01064 0.0835658 3.41614 0.299928 2.85733C0.516291 2.29854 0.852984 1.78739 1.2891 1.35563C1.72521 0.923863 2.25141 0.58071 2.83506 0.347479C3.41869 0.114249 4.04729 -0.00407712 4.68179 -0.000149175C5.41815 0.00548101 6.14411 0.163175 6.80796 0.461698C7.47183 0.760219 8.05725 1.19222 8.5225 1.72693C8.98791 1.19224 9.57346 0.760259 10.2374 0.461744C10.9014 0.163227 11.6274 0.00551942 12.3639 -0.000149175C12.9984 -0.00408311 13.6269 0.114244 14.2105 0.347481C14.7941 0.580718 15.3203 0.923883 15.7564 1.35566C16.1924 1.78743 16.529 2.2986 16.7453 2.85739C16.9616 3.41618 17.0529 4.01066 17.0136 4.60391C17.0136 8.85288 9.24661 13.5651 8.91649 13.7637L8.5225 13.9998Z" fill="#01A601"></path>
                                </svg> Doctors</span></a>
                    </li>
                    @guest
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('login') }}">
                                <div class="custone_book_appoin_btn d-flex align-items-center">Login / Sign
                                    Up</div>
                            </a>
                        </li>
                    @endguest


                    @auth
                    
                        <li class="nav-item ">
                            <a class="nav-link" aria-current="page" href="#">
                                <div class="User_admin">
                                    <div class="dropdown">
                                        <button class="btn w-100" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="dr_user_img">
                                                    <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" class="w-100 h-100"
                                                        alt="">
                                                </div>
                                                <div class="text-start">

                                                    <h4 class="mb-0"> {{ ucwords(strtolower(Auth::user()->first_name)) }} {{ ucwords(strtolower(Auth::user()->last_name)) }}
                                                    </h4>
                                                    <p class="mb-0">{{ Auth::user()->role }}</p>


                                                </div>
                                                <div>
                                                    <svg width="11" height="7" class="ms-2" viewBox="0 0 11 7" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M0.293031 1.29308C0.480558 1.10561 0.734866 1.00029 1.00003 1.00029C1.26519 1.00029 1.5195 1.10561 1.70703 1.29308L5.00003 4.58608L8.29303 1.29308C8.38528 1.19757 8.49562 1.12139 8.61763 1.06898C8.73963 1.01657 8.87085 0.988985 9.00363 0.987831C9.13641 0.986677 9.26809 1.01198 9.39098 1.06226C9.51388 1.11254 9.62553 1.18679 9.71943 1.28069C9.81332 1.37458 9.88757 1.48623 9.93785 1.60913C9.98813 1.73202 10.0134 1.8637 10.0123 1.99648C10.0111 2.12926 9.98354 2.26048 9.93113 2.38249C9.87872 2.50449 9.80254 2.61483 9.70703 2.70708L5.70703 6.70708C5.5195 6.89455 5.26519 6.99987 5.00003 6.99987C4.73487 6.99987 4.48056 6.89455 4.29303 6.70708L0.293031 2.70708C0.10556 2.51955 0.000244141 2.26525 0.000244141 2.00008C0.000244141 1.73492 0.10556 1.48061 0.293031 1.29308Z"
                                                            fill="#302C36" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item " type="button"
                                                onclick="window.location.href='{{ route('client.profile') }}'">
                                                    <div class="d-flex align-items-center py-2">
                                                        <svg width="16" height="20" class="me-2" viewBox="0 0 16 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10.8284 7.82843C11.5786 7.07828 12 6.06087 12 5C12 3.93913 11.5786 2.92172 10.8284 2.17157C10.0783 1.42143 9.06087 1 8 1C6.93913 1 5.92172 1.42143 5.17157 2.17157C4.42143 2.92172 4 3.93913 4 5C4 6.06087 4.42143 7.07828 5.17157 7.82843C5.92172 8.57857 6.93913 9 8 9C9.06087 9 10.0783 8.57857 10.8284 7.82843Z"
                                                                stroke="#0A0101" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M3.05025 14.0503C4.36301 12.7375 6.14348 12 8 12C9.85652 12 11.637 12.7375 12.9497 14.0503C14.2625 15.363 15 17.1435 15 19H1C1 17.1435 1.7375 15.363 3.05025 14.0503Z"
                                                                stroke="#0A0101" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>Manage Profile
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item " type="button"
                                                onclick="window.location.href='{{ route('client.appointments') }}'">
                                                    <div class="d-flex align-items-center py-2">
                                                        <svg width="20" height="20" class="me-2" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M10 6V10L13 13M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                                                stroke="#0A0101" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>Booking / Scheduled
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item " type="button"
                                                    onclick="document.location.href='logout'">
                                                    <div class="d-flex align-items-center py-2">
                                                        <svg width="20" height="20" class="me-2" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14 15.0001L19 10.0001M19 10.0001L14 5.00006M19 10.0001H7M10 15.0001C10 15.2956 10 15.4434 9.98901 15.5715C9.87482 16.902 8.89486 17.9969 7.58503 18.2573C7.45903 18.2824 7.31202 18.2987 7.01835 18.3314L5.99694 18.4448C4.46248 18.6153 3.69521 18.7006 3.08566 18.5055C2.27293 18.2455 1.60942 17.6516 1.26118 16.8725C1 16.2883 1 15.5163 1 13.9724V6.02776C1 4.48383 1 3.71186 1.26118 3.12758C1.60942 2.34854 2.27293 1.75467 3.08566 1.49459C3.69521 1.29953 4.46246 1.38478 5.99694 1.55528L7.01835 1.66877C7.31212 1.70141 7.45901 1.71773 7.58503 1.74279C8.89486 2.00322 9.87482 3.0981 9.98901 4.42867C10 4.5567 10 4.70449 10 5.00006"
                                                                stroke="#333333" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>Log out
                                                    </div>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    @php
    // Use DB facade to query the pages table
    $pages = DB::table('pages')
                ->where('show_nav', 1)
                ->where('published', 'Published')
                ->get();
        @endphp



    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-6 py-3">
                    <div>
                        <img src="{{asset('asset/img/EasyGo_logo.svg')}}" alt="">
                        <p class="grey_f">We ara a lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat<span class="dots">...</span><span class="more" style="display: none;">,
                                erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor
                                vitae massa.</span> <span onclick="myFunction(this)" class="myBtn blue_f"
                                style="cursor: pointer;">Read more</span></p>
                        <div class="d-flex gap-3">
                            <a href="#">
                                <div class="social_icon d-flex justify-content-center align-items-center">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.97942 5.71991C5.59787 6.10188 5.24802 6.57042 5.02182 6.97841C4.73771 7.47707 4.52797 8.02389 4.40152 8.59241L4.33572 8.93592C3.29871 14.1972 4.6157 18.9038 8.96325 23.2204C11.8158 26.0526 13.9788 27.2164 16.9406 27.6413C17.4205 27.7102 17.9218 27.7619 18.5183 27.8061L19.7446 27.8806C20.429 27.916 21.5693 27.9728 21.9586 27.995C22.4713 28.0242 23.1496 27.9261 24.0612 27.7126L24.1993 27.6721C24.9951 27.391 25.7217 26.9349 26.3301 26.3258C28.5566 24.0969 28.5566 20.4831 26.3301 18.2542L26.1318 18.0648C23.9795 16.1049 20.6882 16.087 18.5158 18.0207L18.2582 18.2538L16.8817 19.6318C16.5801 19.9337 16.1051 19.9746 15.7564 19.7287C15.0309 19.217 13.1032 17.3304 12.6327 16.6874C12.3769 16.3378 12.414 15.8537 12.7201 15.5474L13.9329 14.3341L14.0366 14.2497L14.1906 14.107C14.2184 14.0802 14.2467 14.0524 14.2748 14.0244C16.5655 11.7311 16.5655 8.01312 14.2748 5.71991C11.9841 3.4267 8.27012 3.4267 5.97942 5.71991ZM7.84006 7.58259C9.10315 6.31811 11.151 6.31811 12.4141 7.58259C13.6772 8.84707 13.6772 10.8972 12.4141 12.1617C12.336 12.2399 12.2546 12.3136 12.1701 12.3827L10.86 13.6843C9.63541 14.9097 9.48685 16.846 10.51 18.2442C11.1504 19.1192 13.2835 21.2069 14.2409 21.8822L14.4256 22.004C15.7998 22.8498 17.5882 22.6499 18.7424 21.4944L20.0149 20.2201L20.0323 20.2113L20.1549 20.0913C21.3559 18.9159 23.2803 18.9263 24.4695 20.1169C25.6684 21.3171 25.6684 23.2629 24.4695 24.4631L24.265 24.6505C24.0536 24.8276 23.822 24.9735 23.5753 25.0863L23.3762 25.1664L23.0379 25.2409L22.6807 25.3078C22.412 25.3528 22.2173 25.3712 22.1082 25.365L19.4364 25.2262L18.7286 25.1802L18.1146 25.1285C17.8268 25.1007 17.5647 25.0697 17.3138 25.0337C14.9428 24.6936 13.2858 23.802 10.8162 21.35C7.2278 17.7872 6.11555 14.1017 6.84874 9.81688L6.92544 9.40033C6.99495 8.9737 7.12368 8.60608 7.3151 8.27002C7.43164 8.05999 7.63432 7.78856 7.84006 7.58259Z"
                                            fill="#A0ABBB" />
                                    </svg>
                                </div>
                            </a>
                            <a href="#">
                                <div class="social_icon d-flex justify-content-center align-items-center">
                                    <svg width="28" height="22" viewBox="0 0 28 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.66663 0.333252C2.45749 0.333252 0.666626 2.12411 0.666626 4.33325V17.6666C0.666626 19.8757 2.45749 21.6666 4.66663 21.6666H23.3333C25.5424 21.6666 27.3333 19.8757 27.3333 17.6666V4.33325C27.3333 2.12411 25.5424 0.333252 23.3333 0.333252H4.66663ZM4.43398 3.02015C4.50953 3.00685 4.58727 2.99992 4.66663 2.99992H23.3333C23.4127 2.99992 23.4904 3.00685 23.566 3.02015L14 9.39748L4.43398 3.02015ZM3.33329 5.49129V17.6666C3.33329 18.403 3.93025 18.9999 4.66663 18.9999H23.3333C24.0697 18.9999 24.6666 18.403 24.6666 17.6666V5.49131L14.7396 12.1093C14.2917 12.4079 13.7082 12.4079 13.2604 12.1093L3.33329 5.49129Z"
                                            fill="#A0ABBB" />
                                    </svg>
                                </div>
                            </a>
                            <a href="#">
                                <div class="social_icon d-flex justify-content-center align-items-center">
                                    <svg width="20" height="28" viewBox="0 0 20 28" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10 3.33341C6.31812 3.33341 3.33335 6.31818 3.33335 10.0001C3.33335 13.7173 5.48228 19.1565 10 24.0738C14.5178 19.1565 16.6667 13.7173 16.6667 10.0001C16.6667 6.31818 13.6819 3.33341 10 3.33341ZM0.666687 10.0001C0.666687 4.84542 4.84536 0.666748 10 0.666748C15.1547 0.666748 19.3334 4.84542 19.3334 10.0001C19.3334 14.8697 16.4474 21.4383 10.9428 26.9429C10.4221 27.4636 9.57791 27.4636 9.05721 26.9429C3.55261 21.4383 0.666687 14.8697 0.666687 10.0001Z"
                                            fill="#A0ABBB" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10 11.3334C10.7364 11.3334 11.3334 10.7365 11.3334 10.0001C11.3334 9.2637 10.7364 8.66675 10 8.66675C9.26364 8.66675 8.66669 9.2637 8.66669 10.0001C8.66669 10.7365 9.26364 11.3334 10 11.3334ZM10 14.0001C12.2092 14.0001 14 12.2092 14 10.0001C14 7.79094 12.2092 6.00008 10 6.00008C7.79088 6.00008 6.00002 7.79094 6.00002 10.0001C6.00002 12.2092 7.79088 14.0001 10 14.0001Z"
                                            fill="#A0ABBB" />
                                    </svg>
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
                      
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 py-3">
                    <div>
                        <h3>About</h3>
                        @foreach($pages as $page)
                        <a href="{{ route('pages.show', $page->slug) }}" class="link-underline link-underline-opacity-0">
                                    <p class="mb-2">{{ ucfirst(strtolower($page->name)) }}</p>
                                </a>

                       @endforeach
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 py-3">
                    <div>
                        <h3>Support</h3>
                        <a href="{{ route('contact') }}" class="link-underline link-underline-opacity-0">
                            <p class="mb-2">Contact Us</p>
                        </a>
                        
                    </div>
                </div>
            </div>
            <div class="rightes_line pt-3 text-center">
                <p class="mb-0">© 2000-2024, All Rights Reserved - Easy Go</p>
            </div>
        </div>
    </footer>

    <!-- BOOSTRAP SCRIPT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <!-- jquery script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    @if (request()->routeIs('index') )
   
@elseif(request()->routeIs('search') )
<script>
$('#city').val("{{$city}}");
$('#locality').val("{{$locality}}");

</script> 
@endif

    
    
@yield('scripts')

<style>.search_field {
    position: relative;  /* Ensure the list is positioned relative to the search field */
}

.city-list, .locality-list, #specialitiesList {
    display: none;  /* Initially hidden until user types */
    position: absolute;
    top: 100%;  /* Place it directly below the input field */
    left: 0;
    width: 100%;  /* Ensure the list is the same width as the input field */
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    max-height: 200px;
    overflow-y: auto;
    z-index: 10;  /* Ensure the list stays above other content */
}

.city-item, .locality-item, .speciality-item {
    padding: 8px;
    cursor: pointer;
}

.city-item:hover, .locality-item:hover, .speciality-item:hover {
    background-color: #f0f0f0;
}

.no-cities, .no-localities, .no-specialities {
    padding: 8px;
    color: #888;
    text-align: center;
}

#city, #locality-search, #speciality {
    width: 100%;
    padding: 8px;
    
    border-radius: 4px;
    font-size: 14px;
}

.btn-primary{
background:#000066;
border-color:#000066;
}
.btn-primary:hover{
  background:#000066;
border-color:#000066;
}
/* Style for Direction Button (Outlined Red) */
.btn-outline-danger {
    border: 2px solid red;  /* Red border */
    color: red;  /* Red text */
    padding: 10px 20px;
    border-radius: 4px;
    font-weight: bold;
    text-decoration: none;
}

/* Add hover effect for Direction button */
.btn-outline-danger:hover {
    background-color: red;  /* Red background on hover */
    color: white;  /* White text on hover */
}
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiperBooking_Slots", {
        loop: true,
        freeMode: true,
        spaceBetween: 60,
        grabCursor: true,
        slidesPerView: 2,
        slidesPerGroup: 1,
        // loop: true,
        // autoplay: {
        //     delay: 2000,
        //     disableOnInteraction: true
        // },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        freeMode: false,
        speed: 1000,
        freeModeMomentum: false,
        breakpoints: {
            220: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 5,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 10,
            },
            1330: {
                slidesPerView: 7,
                spaceBetween: 10,
            },
        },
    });
</script>
 <!-- READ MORE CODE -->
 <script>
        function myFunction(btn) {
            var dots = btn.previousElementSibling.previousElementSibling;
            var moreText = btn.previousElementSibling;
            
            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btn.innerHTML = "Read more"; 
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btn.innerHTML = "Read less"; 
                moreText.style.display = "inline";
            }
        }
    </script>
    
</body>

</html>