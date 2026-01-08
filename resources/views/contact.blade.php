@extends('layout.client')
@section('title', 'Contact Us')

@section('content')
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
<section class="contact-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Contact Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="row">
                    <!-- Boxed Layout -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow border-0 p-4 h-100">
                            <h5 class="mb-4">Reach Us</h5>
                            <!-- Address Section -->
                            <div class="mb-3">
                                <h6 class="fw-bold">Address</h6>
                                <p class="text-muted">123 EasyGo Street<br>City, State, ZIP<br>Country</p>
                            </div>
                            <!-- Support/Sales Contacts Section -->
                            <div class="mb-3">
                                <h6 class="fw-bold">Support/Sales Contacts</h6>
                                <p class="text-muted">
                                    Support: +1-800-123-4567<br>
                                    Sales: +1-800-987-6543
                                </p>
                            </div>
                            <!-- Emails Section -->
                            <div>
                                <h6 class="fw-bold">Emails</h6>
                                <p class="text-muted">
                                    Support: <a href="mailto:support@easygo.com" class="text-primary">support@easygo.com</a><br>
                                    Sales: <a href="mailto:sales@easygo.com" class="text-primary">sales@easygo.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Form Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow border-0 p-4 h-100">
                            <h5 class="mb-4">Send Us a Message</h5>
                            <div id="successMessage" class="alert alert-success mt-4 d-none" role="alert">
                                Thank you for contacting us! We will get back to you shortly.
                            </div>
                            <form method="POST" action="{{ route('contact.submit') }}" id="contactForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your Phone Number"  maxlength="10" required 
                                    oninput="this.value = this.value.replace(/\D/g, '')" >
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </form>
                           
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
    document.getElementById('contactForm').addEventListener('submit', function (event) {
        event.preventDefault();

        // Simulate form submission
        const form = event.target;
        const formData = new FormData(form);

        fetch("{{ route('contact.submit') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // If submission is successful
            if (data.success) {
                form.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'We have recieved your query. We will call back to you soon. Have a nice day',
                    timer: 3000,
                    showConfirmButton: false
                });
            } else if (data.errors) {
                // If there are validation errors
                let errorText = 'There were some errors with your submission:<br>';
                // Display each error message
                for (let field in data.errors) {
                    errorText += `${data.errors[field].join('<br>')}<br>`;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    html: errorText,
                    timer: 5000,
                    showConfirmButton: true
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong. Please try again.',
                timer: 5000,
                showConfirmButton: true
            });
        });
    });
</script>


@endsection
