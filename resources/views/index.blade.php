@extends('layout.client')

@section('title', 'Ready for Better Health? Find Your Doctor Here')

@section('navbar_logo', asset('asset/img/medisync_logo.png'))

@section('page_head')
<style>
    .navbar-brand img {
        width: 150px;
        height: auto;
        max-height: 56px;
        object-fit: contain;
    }
</style>
@endsection

@section('content')
@include('search')


<!-- DOCTORE LIST SECTION STRAT -->
<section class="Docter_Section dataTable">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8">
                <div class="left_part">
                    <div class="filter_part d-flex flex-wrap justify-content-md-start justify-content-center gap-3 p-2">
                        <div class="filter_fild ">
                            <div class="dropdown-center">
                                <button class="border-0 outline-0 bg-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <svg width="12" height="10" class="me-2" viewBox="0 0 12 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.75012 8C7.16436 8 7.50012 8.33576 7.50012 8.75C7.50012 9.16424 7.16436 9.5 6.75012 9.5H5.25012C4.83588 9.5 4.50012 9.16424 4.50012 8.75C4.50012 8.33576 4.83588 8 5.25012 8H6.75012ZM9.00012 4.25C9.41436 4.25 9.75012 4.58576 9.75012 5C9.75012 5.41424 9.41436 5.75 9.00012 5.75H3.00012C2.58588 5.75 2.25012 5.41424 2.25012 5C2.25012 4.58576 2.58588 4.25 3.00012 4.25H9.00012ZM11.2501 0.5C11.6643 0.5 12.0001 0.83576 12.0001 1.25C12.0001 1.66424 11.6643 2 11.2501 2H0.750122C0.335882 2 0.00012207 1.66424 0.00012207 1.25C0.00012207 0.83576 0.335882 0.5 0.750122 0.5H11.2501Z"
                                            fill="black" />
                                    </svg>
                                    Filter
                                </button>

                            </div>
                        </div>

                       
  <!-- Price Filter Dropdown -->
<div id="price-filter" class="filter_fild">
    <div class="dropdown-center">
        <button class="border-0 outline-0 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Price
            <svg width="14" height="8" class="ms-2" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.77042 0.303668C1.36532 -0.101223 0.708922 -0.101223 0.303722 0.303668C-0.101078 0.708764 -0.101079 1.36517 0.303722 1.77031L6.22979 7.69633C6.63488 8.10122 7.29129 8.10122 7.69643 7.69633L13.6224 1.77031C14.0273 1.36521 14.0273 0.708807 13.6224 0.303668C13.2173 -0.101222 12.5609 -0.101222 12.1558 0.303668L6.96022 5.49926L1.77042 0.303668Z" fill="#6C6A6A"/>
            </svg>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-sort_price="asc">Low to High</a></li>
            <li><a class="dropdown-item" href="#" data-sort_price="desc">High to Low</a></li>
        </ul>
    </div>
</div>

<!-- Gender Filter Dropdown -->
<div id="gender-filter" class="filter_fild">
    <div class="dropdown-center">
        <button class="border-0 outline-0 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gender
            <svg width="14" height="8" class="ms-2" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.77042 0.303668C1.36532 -0.101223 0.708922 -0.101223 0.303722 0.303668C-0.101078 0.708764 -0.101079 1.36517 0.303722 1.77031L6.22979 7.69633C6.63488 8.10122 7.29129 8.10122 7.69643 7.69633L13.6224 1.77031C14.0273 1.36521 14.0273 0.708807 13.6224 0.303668C13.2173 -0.101222 12.5609 -0.101222 12.1558 0.303668L6.96022 5.49926L1.77042 0.303668Z" fill="#6C6A6A"/>
            </svg>
        </button>
        <ul class="dropdown-menu" id="gender-options">
            <li><a class="dropdown-item" href="#" data-gender="all">All</a></li>
            <li><a class="dropdown-item" href="#" data-gender="male">Male</a></li>
            <li><a class="dropdown-item" href="#" data-gender="female">Female</a></li>
        </ul>
    </div>
</div>



<div id="msg" class="pt-2">
    <?php
    // Check for sorting parameter and display the sorting message
    if (isset($_GET['sort_price'])) {
        $sortMessage = ($_GET['sort_price'] === 'asc') ? 'Price Low to High' : 'Price High to Low';
        echo $sortMessage;
    }

    // Check for gender parameter and display the gender message
    if (isset($_GET['gender'])) {
        if ($_GET['gender'] === 'male') {
            echo (isset($_GET['sort_price']) ? ' / ' : '') . 'Male';
        } elseif ($_GET['gender'] === 'female') {
            echo (isset($_GET['sort_price']) ? ' / ' : '') . 'Female';
        } elseif ($_GET['gender'] === 'all') {
            echo (isset($_GET['sort_price']) ? ' / ' : '') . 'All';
        }
    }

    // Display the number of available doctors
    echo (isset($_GET['sort_price']) || isset($_GET['gender'])) ? ' / ' : '';
    echo $doctors->count() . ' Doctors Available';
    ?>
</div>


                    </div>

                    <div class="All_Dr_details Appointment_page  .">
                        
                    @foreach($doctors as $doctor)
                                    @include('doctor', ['showAppointmentButton' => true])
                                   
                                    @endforeach



    <!-- Pagination Links -->
    <div class="py-4">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="py-3">
             
                </div>
                <div class="table_page_list py-3">
                    <div class="pagination">
                        <ul> <!--pages or li are comes from javascript --> </ul>
                    </div>
                </div>
            </div>
        </div>
</div>

                </div>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="right_part">

                <div class="top_health_tips my-3 py-5 px-4">
    <div class="text-center">
        <h3 class="red_f">Health Tips</h3>
    </div>
    @php
        // Use DB facade to query the pages table
        $pages = DB::table('pages')
                    ->where('show_tips', 1)
                    ->where('published', 'Published')
                    ->get();
    @endphp
    <hr>
    <div id="health-tips-container">
        @foreach($pages as $key => $page)
        <a href="{{ route('pages.show', $page->slug) }}" 
           class="link-underline link-underline-opacity-0 text-dark health-tip-item {{ $key >= 10 ? 'hidden-tip' : '' }}">
            <h5>{{ ucfirst(strtolower($page->title)) }}</h5>
        </a>
        <hr class="{{ $key >= 10 ? 'hidden-tip' : '' }}">
        @endforeach
    </div>
    @if(count($pages) > 10)
    <div class="text-center">
        <button id="view-more-btn" class="btn btn-primary">View More</button>
    </div>
    @endif
</div>

<!-- Optional styling for hidden tips -->
<style>
    .hidden-tip {
        display: none;
    }
</style>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkVY54ZKvhxyMy9fJzcK2LS1uIUxVdwEU&libraries=places"></script>
    <script>
        function initializeAutocomplete() {
            const input = document.getElementById('locality-search');
            const autocomplete = new google.maps.places.Autocomplete(input);

            // Listen for the event when the user selects a suggestion
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();

                // Check if the place has a geometry (location)
                if (place.geometry) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    $("#longitude").val(lng);
                    $("#latitude").val(lat);
                   
                   
                    
                } else {
                  
                }
            });
        }

        // Initialize Autocomplete when the page loads
        google.maps.event.addDomListener(window, 'load', initializeAutocomplete);


    
    let cityInput = document.getElementById('city');
   
    // Initialize Google Places Autocomplete
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(cityInput, {
            types: ['(cities)'],  // Only cities
            componentRestrictions: { country: 'IN' }, // Restrict to India (adjust as needed)
        });

        // Listen for when the user selects a place from the autocomplete suggestions
        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();
            
            // Check if the place has a geometry (location)
            if (place.geometry) {
                // Initialize city, state, and zip code variables
                let city = '';
             
                // Loop through the address components to extract city, state, and zip code
                for (let i = 0; i < place.address_components.length; i++) {
                    const component = place.address_components[i];

                    // Extract city
                    if (component.types.includes('locality')) {
                        city = component.long_name;
                    }

                
                }

                // Populate the #city field
                cityInput.value = city;

               

            } else {
              
            }
        });
    }

    // Initialize the autocomplete after the page loads
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewMoreBtn = document.getElementById('view-more-btn');
        const hiddenTips = document.querySelectorAll('.hidden-tip');

        if (viewMoreBtn) {
            viewMoreBtn.addEventListener('click', function () {
                hiddenTips.forEach(function (tip) {
                    tip.style.display = 'block';
                });
                viewMoreBtn.style.display = 'none'; // Hide the "View More" button after showing tips
            });
        }
    });

    $(document).ready(function () {
    // Function to update the URL with selected filters
    function updateURLParams(params) {
        var currentUrl = new URL(window.location.href);

        // Default gender to 'all' if undefined
        var gender = params.gender || 'all';  // Default to 'all' if gender is undefined
        var sort_price = params.sort_price || 'asc';  // Default to 'asc' if sort_price is undefined

        currentUrl.searchParams.set('gender', gender);
        currentUrl.searchParams.set('sort_price', sort_price);
        window.location.href = currentUrl;  // Reload the page with the new URL
    }

    // Function to set filters from URL when the page loads
    function setFiltersFromURL() {
        var urlParams = new URLSearchParams(window.location.search);
        
        // Get gender from URL or default to 'all' if not present
        var gender = urlParams.get('gender') || 'all';
        var sort_price = urlParams.get('sort_price') || 'asc';

        // Set selected gender filter in the dropdown
        $('#gender-options a').removeClass('active');
        $('#gender-options a[data-gender="' + gender + '"]').addClass('active');

        // Set selected price filter in the dropdown
        $('#price-filter .dropdown-item').removeClass('active');
        $('#price-filter .dropdown-item[data-sort_price="' + sort_price + '"]').addClass('active');
    }

    // Trigger filter change and update the URL
    $('#price-filter .dropdown-item').on('click', function () {
        var sortPrice = $(this).data('sort_price');
        var selectedGender = $('#gender-options .active').data('gender');
        
        // Update URL
        updateURLParams({ gender: selectedGender, sort_price: sortPrice });
    });

    // Gender filter change
    $('#gender-options a').on('click', function () {
        var selectedGender = $(this).data('gender');
        var selectedPrice = $('#price-filter .active').data('sort_price');
        
        // Update URL
        updateURLParams({ gender: selectedGender, sort_price: selectedPrice });
    });

    // Call the setFiltersFromURL function to apply the filters when the page loads
    setFiltersFromURL();
});


function changePage(page) {
   
    const url = new URL(window.location.href);
    url.searchParams.set('page', page); // Update the page parameter
   
    window.location.href = url.toString();  // Redirect to the updated URL
}

// Selecting required elements
const element = document.querySelector(".pagination ul");
const totalPages = {{ $doctors->lastPage() }};  // Get total pages from the pagination data
const currentPage = {{ $doctors->currentPage() }};  // Get current page from the pagination data

// Call function to generate pagination
element.innerHTML = createPagination(totalPages, currentPage);

function createPagination(totalPages, currentPage) {
    let liTag = '';
    let active;
    let beforePage = currentPage - 1;
    let afterPage = currentPage + 1;

    if (currentPage > 1) {
        liTag += `<li class="btn prev" onclick="changePage(${currentPage - 1})">
                    <span><i class="fas fa-angle-left"></i> Prev</span>
                  </li>`;
    }

    if (currentPage > 2) {
        liTag += `<li class="first numb" onclick="changePage(1)">
                    <span>1</span>
                  </li>`;
        if (currentPage > 3) {
            liTag += `<li class="dots"><span>...</span></li>`;
        }
    }

    if (currentPage == totalPages) {
        beforePage -= 2;
    } else if (currentPage == totalPages - 1) {
        beforePage -= 1;
    }

    if (currentPage == 1) {
        afterPage += 2;
    } else if (currentPage == 2) {
        afterPage += 1;
    }

    for (let plength = beforePage; plength <= afterPage; plength++) {
        if (plength > totalPages || plength < 1) {
            continue;
        }

        active = (currentPage == plength) ? "active" : "";

        liTag += `<li class="numb ${active}" onclick="changePage(${plength})">
                    <span>${plength}</span>
                  </li>`;
    }

    if (currentPage < totalPages - 1) {
        if (currentPage < totalPages - 2) {
            liTag += `<li class="dots"><span>...</span></li>`;
        }
        liTag += `<li class="last numb" onclick="changePage(${totalPages})">
                    <span>${totalPages}</span>
                  </li>`;
    }

    if (currentPage < totalPages) {
        liTag += `<li class="btn next" onclick="changePage(${currentPage + 1})">
                    <span>Next <i class="fas fa-angle-right"></i></span>
                  </li>`;
    }

    return liTag;
}
$(document).ready(function () {
    const specialities = @json($specialities); // Pass server-side array to JavaScript

    $('#speciality').on('input', function () {
        let query = $(this).val().toLowerCase();
        if (query) {
            let suggestions = specialities.filter(title => title.toLowerCase().includes(query));
            if (suggestions.length) {
                let suggestionsHTML = suggestions.map(speciality => {
                    // Highlight matching text
                    let regex = new RegExp(`(${query})`, 'gi');
                    let highlighted = speciality.replace(regex, '<strong>$1</strong>');
                    return `<div class="suggestion-item">${highlighted}</div>`;
                }).join('');
                $('#specialitySuggestions').html(suggestionsHTML).fadeIn();
            } else {
                $('#specialitySuggestions').fadeOut();
            }
        } else {
            $('#specialitySuggestions').fadeOut();
        }
    });

    // Select a suggestion and populate the input field
    $(document).on('click', '.suggestion-item', function () {
        let text = $(this).text();
        $('#speciality').val(text); // Fill the input with plain text
        $('#specialitySuggestions').fadeOut();
    });

    // Hide suggestions when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest('.form-group').length) {
            $('#specialitySuggestions').fadeOut();
        }
    });
});

</script>

@endsection
