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

    .client-search-section { background: #fff; border-bottom: 1px solid #edf0f3; }
    .client-search-form .search_field {
        height: 48px;
        background: #fff;
        border-color: #d7dee6;
        border-radius: 8px;
        box-shadow: none;
    }
    .client-search-form .custum_search_btn {
        width: 100%;
        height: 48px;
        border: 0;
        border-radius: 8px;
        background: #075ca8;
        box-shadow: none;
    }
    .client-search-form .custum_search_btn:hover { background: #064d8d; }

    .doctor-discovery { padding: 24px 0 48px; background: #fafbfc; }
    .doctor-discovery .doctor-toolbar {
        background: #fff;
        border: 1px solid #e5edf5;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(20, 49, 78, .04);
    }
    .doctor-toolbar { min-height: 62px; }
    .doctor-toolbar #msg { margin-right: auto; font-size: 14px; color: #56677a; }
    .doctor-view-control { display: flex; align-items: center; gap: 8px; margin-left: auto; padding-right: 8px; }
    .doctor-view-control label { font-size: 13px; color: #65758a; white-space: nowrap; }
    .doctor-view-control select { border: 1px solid #d7e0ea; border-radius: 7px; padding: 7px 28px 7px 9px; color: #31465e; background: #fff; font-size: 13px; }

    .All_Dr_details { display: grid; grid-template-columns: 1fr; gap: 16px; margin-top: 16px; }
    .All_Dr_details .Dr_details { margin: 0 !important; padding: 18px !important; background: #fff; border: 1px solid #e2e9f0 !important; box-shadow: 0 4px 14px rgba(20, 49, 78, .04) !important; }
    .All_Dr_details .Dr_details > .row { align-items: center; }
    .All_Dr_details .Dr_details > .row > div { padding-top: 0 !important; padding-bottom: 0 !important; }
    .All_Dr_details .Dr_details img { width: 220px !important; height: 220px; object-fit: cover; border: 4px solid #fff; border-radius: 12px; box-shadow: 0 5px 14px rgba(24, 55, 86, .16); }
    .All_Dr_details .Dr_details h3 { font-size: 19px !important; margin-bottom: 8px; }
    .All_Dr_details .Dr_details h5, .All_Dr_details .Dr_details li, .All_Dr_details .Dr_details .location { font-size: 14px !important; }
    .All_Dr_details .Dr_details .location { margin: 8px 0 !important; }
    .All_Dr_details .Dr_details .location svg { width: 18px; height: 18px; }
    .All_Dr_details .Dr_details .grey_f { font-size: 14px; margin: 12px 0; }
    .All_Dr_details .Dr_details .row.mt-3 { margin-top: 10px !important; }
    .All_Dr_details .Dr_details .Book_Appointment_btn, .All_Dr_details .Dr_details .Call_Doctor_btn { height: 40px !important; font-size: 14px !important; }
    .doctor-grid--2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .doctor-grid--2 .Dr_details > .row { display: block; }
    .doctor-grid--2 .Dr_details > .row > div { width: 100%; max-width: 100%; }
    .doctor-grid--2 .Dr_details img {
        width: 100% !important;
        height: 210px;
        margin-bottom: 14px;
        border: 0;
        border-radius: 12px;
        background: #f3f6f8;
        box-shadow: 0 4px 12px rgba(24, 55, 86, .12);
    }
    .doctor-grid--2 .Dr_details .row.mt-3 {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        width: 100%;
        margin: 12px 0 0 !important;
    }
    .doctor-grid--2 .Dr_details .row.mt-3 > div {
        width: auto !important;
        max-width: none !important;
        flex: none !important;
        padding: 0 !important;
    }
    .doctor-grid--2 .Dr_details .row.mt-3 > div:first-child { grid-column: 1 / -1; }
    .doctor-grid--2 .Dr_details .Book_Appointment_btn,
    .doctor-grid--2 .Dr_details .Call_Doctor_btn { width: 100%; }
    .doctor-discovery .pagination { display: flex; justify-content: center; width: 100%; }
    .doctor-discovery .pagination ul { width: auto !important; margin: 0 auto !important; justify-content: center; }
    .doctor-discovery .table_page_list { width: 100%; }
    .All_Dr_details > .py-4 { grid-column: 1 / -1; }
    @media (max-width: 767.98px) {
        .doctor-toolbar { justify-content: flex-start !important; }
        .doctor-toolbar #msg { width: 100%; order: 3; }
        .doctor-view-control { margin-left: 0; }
        .doctor-grid--2 { grid-template-columns: 1fr; }
        .All_Dr_details .Dr_details > .row > div { width: 100%; max-width: 100%; }
        .All_Dr_details .Dr_details img { width: 130px !important; height: 130px; }
    }
</style>
@endsection

@section('content')
@include('search')


<!-- DOCTORE LIST SECTION STRAT -->
<section class="Docter_Section dataTable doctor-discovery">
    <div class="container">
        <div class="row g-4">
            <div class="col-12">
                <div class="left_part">
                    <div class="filter_part doctor-toolbar d-flex flex-wrap justify-content-md-start justify-content-center gap-3 p-2">
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

<div class="doctor-view-control">
    <label for="doctor-view">View</label>
    <select id="doctor-view" aria-label="Doctor list view">
        <option value="1">1 per row</option>
        <option value="2">2 per row</option>
    </select>
</div>


                    </div>

                    <div id="doctor-list" class="All_Dr_details Appointment_page">
                        
                    @foreach($doctors as $doctor)
                                    @include('doctor', ['showAppointmentButton' => true])
                                   
                                    @endforeach



    <!-- Pagination Links -->
    <div class="py-4">
            <div class="d-flex justify-content-center flex-wrap">
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
        </div>
    </div>
</section>

@endsection

@section('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const doctorList = document.getElementById('doctor-list');
        const viewSelect = document.getElementById('doctor-view');
        if (!doctorList || !viewSelect) return;

        const savedView = localStorage.getItem('doctor-list-view') === '2' ? '2' : '1';
        viewSelect.value = savedView;
        const currentUrl = new URL(window.location.href);
        const expectedPerPage = savedView === '2' ? '16' : '10';
        if (currentUrl.searchParams.get('per_page') !== expectedPerPage) {
            currentUrl.searchParams.set('per_page', expectedPerPage);
            currentUrl.searchParams.delete('page');
            window.location.replace(currentUrl.toString());
            return;
        }
        const applyView = function (value) {
            doctorList.className = 'All_Dr_details Appointment_page doctor-grid--' + value;
        };
        applyView(savedView);
        viewSelect.addEventListener('change', function () {
            localStorage.setItem('doctor-list-view', this.value);
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', this.value === '2' ? '16' : '10');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('nearby-location');
        const list = document.getElementById('nearby-location-list');
        const form = document.getElementById('search-form');
        const city = document.getElementById('city');
        const latitude = document.getElementById('latitude');
        const longitude = document.getElementById('longitude');
        let debounce;

        if (!input || !list || !form) return;

        input.addEventListener('input', function () {
            clearTimeout(debounce);
            latitude.value = '';
            longitude.value = '';
            input.setCustomValidity('');
            list.innerHTML = '';
            list.style.display = 'none';

            const query = input.value.trim();
            if (query.length < 3) return;

            const searchQuery = city.value.trim()
                ? query + ', ' + city.value.trim()
                : query;

            debounce = setTimeout(async function () {
                try {
                    const response = await fetch('https://nominatim.openstreetmap.org/search?format=jsonv2&limit=5&countrycodes=in&q=' + encodeURIComponent(searchQuery));
                    if (!response.ok) throw new Error('Location search request failed');

                    const places = await response.json();
                    if (!places.length) {
                        list.textContent = 'No locations found';
                        list.style.display = 'block';
                        return;
                    }

                    list.style.display = 'block';
                    places.forEach(function (place) {
                        const item = document.createElement('button');
                        item.type = 'button';
                        item.className = 'locality-item w-100 text-start border-0 bg-white';
                        item.textContent = place.display_name;
                        item.addEventListener('click', function () {
                            input.value = place.display_name;
                            latitude.value = place.lat;
                            longitude.value = place.lon;
                            input.setCustomValidity('');
                            list.innerHTML = '';
                            list.style.display = 'none';
                        });
                        list.appendChild(item);
                    });
                } catch (error) {
                    list.textContent = 'Location search is unavailable. Please try again.';
                    console.error('Location search failed', error);
                }
            }, 350);
        });

        form.addEventListener('submit', function (event) {
            if (input.value.trim() && (!latitude.value || !longitude.value)) {
                event.preventDefault();
                input.setCustomValidity('Choose a location from the suggestions before searching.');
                input.reportValidity();
            }
        });

        document.addEventListener('click', function (event) {
            if (!input.parentNode.contains(event.target)) {
                list.innerHTML = '';
                list.style.display = 'none';
            }
        });
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
</script>

@endsection
