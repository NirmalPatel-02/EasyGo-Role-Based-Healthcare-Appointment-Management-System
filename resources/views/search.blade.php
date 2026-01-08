<section class="Option_section py-3">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Book_Appointment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Book Appointment</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-0">
                        <img src="{{asset('asset/img/Treatment.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Treatment</h5>

                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Plan_surgery.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Plan my Surgery</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{asset('asset/img/Ask_Question.svg')}}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Ask a Question</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- OPTIONS SECTION END -->

<!-- SEARCH SECTION STRAT -->
<form id="search-form" method="GET" action="{{ route('searchDoctors') }}">
@csrf
<section class="search_section py-3">
    
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-lg-3 py-2 py-lg-0">
    <div class="search_field d-flex align-items-center position-relative px-3">
        <input type="text" placeholder="Enter City" id="city" name="city" data-city-id="" value="{{old('city')}}" autocomplete="off">
        <div class="search_svg">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M17.657 16.657L13.414 20.9C13.2284 21.0857 13.0081 21.233 12.7656 21.3336C12.523 21.4341 12.2631 21.4859 12.0005 21.4859C11.738 21.4859 11.478 21.4341 11.2354 21.3336C10.9929 21.233 10.7726 21.0857 10.587 20.9L6.343 16.657C5.22422 15.5381 4.46234 14.1127 4.15369 12.5608C3.84504 11.009 4.00349 9.40047 4.60901 7.93868C5.21452 6.4769 6.2399 5.22749 7.55548 4.34846C8.87107 3.46943 10.4178 3.00024 12 3.00024C13.5822 3.00024 15.1289 3.46943 16.4445 4.34846C17.7601 5.22749 18.7855 6.4769 19.391 7.93868C19.9965 9.40047 20.155 11.009 19.8463 12.5608C19.5377 14.1127 18.7758 15.5381 17.657 16.657V16.657Z"
                stroke="#0A0101" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M14.1213 13.1213C14.6839 12.5587 15 11.7956 15 11C15 10.2044 14.6839 9.44129 14.1213 8.87868C13.5587 8.31607 12.7956 8 12 8C11.2044 8 10.4413 8.31607 9.87868 8.87868C9.31607 9.44129 9 10.2044 9 11C9 11.7956 9.31607 12.5587 9.87868 13.1213C10.4413 13.6839 11.2044 14 12 14C12.7956 14 13.5587 13.6839 14.1213 13.1213Z"
                stroke="#0A0101" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        </div>
        <div id="city-list" class="city-list">
            <!-- City suggestions will be displayed here -->
        </div>
    </div>
</div>

<div class="col-md-4 col-lg-3 py-2 py-lg-0">
    <div class="search_field d-flex align-items-center position-relative px-3">
        <input type="text" id="locality-search"  placeholder="Search Locality"  autocomplete="off">
        <div class="search_svg">
          <!-- SVG Icon -->
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 14.2864C3.14864 15.1031 2 16.2412 2 17.5C2 19.9853 6.47715 22 12 22C17.5228 22 22 19.9853 22 17.5C22 16.2412 20.8514 15.1031 19 14.2864M18 8C18 12.0637 13.5 14 12 17C10.5 14 6 12.0637 6 8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8ZM13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44772 13 8Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
        </div>
        <div id="locality-list" class="locality-list">
            <!-- Locality suggestions will be displayed here -->
        </div>
    </div>
</div>

<input type="hidden" name="longitude" id="longitude">
<input type="hidden" name="latitude" id="latitude">
<div class="col-md-4 col-lg-4 py-2 py-lg-0">
    <div class="search_field d-flex align-items-center position-relative px-3">
        <!-- Speciality search input field -->
        <div class="form-group"  >
            <input type="text" id="speciality" name="speciality" 
                placeholder="Type to search speciality..." 
                value="{{ request('speciality') }}" 
                style="width: 100%" autocomplete="off">
            <div id="specialitySuggestions" 
                class="suggestions-list" 
                style="position: absolute; top: 100%; left: 0; width: 100%; z-index: 1000; display: none;">
            </div>
        </div>
    </div>
</div>



            <div class="col-md-4 col-lg-2 py-2 py-lg-0">
                <div class="">
                    
                        <button type="submit"  class="btn btn-danger custum_search_btn d-flex align-items-center justify-content-center" id="search-btn">Search</button>
                    
                </div>
            </div>
        </div>
    </div>
</section>
</form>
<!-- SEARCH SECTION END -->
 <style>
.suggestions-list {
    background: white;
    border: 1px solid #ddd;
    font-size: 12px;
    max-height: 200px; /* Add scroll for long lists */
    overflow-y: auto;
    
}

.suggestions-list div {
    padding: 8px;
    cursor: pointer;
    border-bottom: 1px solid #ddd; /* Separator line */
}

.suggestions-list div:last-child {
    border-bottom: none; /* Remove separator from last item */
}

.suggestions-list div:hover {
    background-color: #f0f0f0;
}


 </style>
 