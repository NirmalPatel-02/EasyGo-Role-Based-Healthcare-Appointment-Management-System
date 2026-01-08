@extends('layout.client')
@section('title', 'Simple Steps to Manage Your Profile')

@section('content')
<section class="Option_section py-3">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{ asset('asset/img/Book_Appointment.svg') }}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Book Appointment</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-0">
                        <img src="{{ asset('asset/img/Treatment.svg') }}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Treatment</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{ asset('asset/img/Plan_surgery.svg') }}" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 black_f">Plan my Surgery</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{ asset('asset/img/Ask_Question.svg') }}" alt="">
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

<!-- PROFILE TITLE SECTION START -->
<section class="profile_title">
    <div class="container">
        <div class="py-3">
            <div>
                <h3>{!! ucfirst(strtolower($page->name)) !!}</h3>
            </div>
        </div>
        
            <div class="row">
                <div class="col-md-qw col-lg-qw py-3">
                    <!-- Content loaded from $page -->
                    <div>
                        {!! $page->text !!} <!-- Render the HTML content of $page -->
                    </div>
                </div>
            </div>
        
    </div>
 </section>
<!-- PROFILE TITLE SECTION END -->

@endsection
@section('scripts')
<script>
// You can add any additional scripts if necessary
</script>
@endsection
