@extends('doctor-dashboard.layout')
@section('title','Doctors Profile')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main id="main" class="main">
  <div class="d-flex justify-content-between">
    <!-- <div class="pagetitle">
      <h1 class="mb-2">Dashboard</h1>
    </div> -->

    <!-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="./asset/icon/more.png" class="mt-2" alt="" style="width: 30px"></a> -->
  </div>
  <section class="section dashboard">
    <div class="page_title_link">
      <div class="desbord_card d-flex gap-2 align-items-center p-3">
        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 8.5L3.16667 6.83333M3.16667 6.83333L9 1L14.8333 6.83333M3.16667 6.83333V15.1667C3.16667 15.3877 3.25446 15.5996 3.41074 15.7559C3.56702 15.9122 3.77899 16 4 16H6.5M14.8333 6.83333L16.5 8.5M14.8333 6.83333V15.1667C14.8333 15.3877 14.7455 15.5996 14.5893 15.7559C14.433 15.9122 14.221 16 14 16H11.5M6.5 16C6.72101 16 6.93298 15.9122 7.08926 15.7559C7.24554 15.5996 7.33333 15.3877 7.33333 15.1667V11.8333C7.33333 11.6123 7.42113 11.4004 7.57741 11.2441C7.73369 11.0878 7.94565 11 8.16667 11H9.83333C10.0543 11 10.2663 11.0878 10.4226 11.2441C10.5789 11.4004 10.6667 11.6123 10.6667 11.8333V15.1667C10.6667 15.3877 10.7545 15.5996 10.9107 15.7559C11.067 15.9122 11.279 16 11.5 16M6.5 16H11.5" stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="mb-0">
          <span>Home</span>
        </p>
        <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="mb-0">Edit Profile</p>
      </div>
    </div>

    

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <section class="profile_title">
            <div class="container">
              <div class="py-3">
                <div>
                  <h3>Dr. {{ Auth::user()->first_name }}
                  {{ Auth::user()->last_name }}</h3>
                </div>
              </div>
              <div class="profile_details pb-5">
                <div class="row">
               
    <div class="col-md-6 col-lg-4 py-3">
    <form id="updateProfileForm" class="formData" method="POST" enctype="multipart/form-data" action="{{ route('doctor.update') }}">
    @csrf
    <!-- Include your form fields here -->

    <!-- Avatar Upload -->
        <div class="profile_img_bg w-100">
            <div class="circle">
            <img class="profile-pic" src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Profile Picture">


            </div>
            <div class="p-image">
                <div class="upload-button">
                    <svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.14008 17.2201C5.04871 17.2213 3.99527 16.8198 3.18157 16.0925C2.36787 15.3652 1.85114 14.3632 1.73036 13.2785C1.60958 12.1939 1.89326 11.1028 2.52704 10.2143C3.16082 9.32581 4.10014 8.70241 5.16504 8.46353C4.85692 7.02655 5.13227 5.52603 5.93049 4.29207C6.72872 3.05811 7.98444 2.19178 9.42142 1.88367C10.8584 1.57556 12.3589 1.8509 13.5929 2.64913C14.8268 3.44735 15.6932 4.70308 16.0013 6.14005H16.1121C17.4859 6.13867 18.8113 6.64783 19.8309 7.56868C20.8505 8.48953 21.4915 9.75637 21.6296 11.1233C21.7677 12.4902 21.3929 13.8596 20.5781 14.9658C19.7632 16.0719 18.5665 16.8359 17.2201 17.1093M15.0041 13.8961L11.6801 10.5721M11.6801 10.5721L8.35608 13.8961M11.6801 10.5721V23.868" stroke="#302C36" stroke-width="2.216" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> Upload Avatar
                </div>
                <input class="file-upload" type="file" accept="image/*" name="avatar" onchange="this.form.submit()"/>
            </div>
        </div>
        </form>
    </div>

    



                  <div class="col-md-6 col-lg-8 d-flex align-items-center py-3">
                    <div class="right_part">
                      <div class="d-flex">
                        <div>
                          <h4>Personal Details</h4>
                        </div>
                      </div>
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
                    <form id="updateForm"  class="formData" enctype="multipart/form-data" method="POST" action="{{ route('doctor.update') }}">
                    @csrf

                        <div class="row">
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="first_name" class="mb-2">First Name <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Enter your first name" id="first_name" required>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="first_name" class="mb-2">Last Name <span class="red_f">*</span></label>
                              <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Enter your Last name"  id="first_name" required>
                            </div>
                          </div>
<div class="col-lg-6 py-2">
                            <div>
                              <label for="gender" class="mb-2">Gender <span class="red_f">*</span></label>
                              <select class="form-control" name="gender" id="gender" required>
    <option value=""  selected>Selected Gender</option>
    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
</select>

                            </div>
                          </div>


                          <div class="col-lg-6 py-2">
    <div>
        <label for="speciality" class="mb-2">Specialist <span class="red_f">*</span></label>
        <select class="form-select" name="speciality" aria-label="Select Speciality" id="speciality" required>
            <option value=""  selected>Select Speciality</option> <!-- Ensure placeholder option -->
            @foreach($specialities as $speciality)
                <option value="{{ $speciality }}" 
                    @if($user->speciality == $speciality) selected @endif>
                    {{ $speciality }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="experience" class="mb-2">Experience <span class="red_f">*</span></label>
                              <input 
                            type="text" 
                            class="form-control" 
                            name="experience" 
                            id="experience" 

                            value="{{$user->experience}}" 
                            placeholder="Add Experience" 
                            required 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);">
                            
                            </div>
                          </div>
                          <div class="col-lg-12 py-2">
                            <div>
                              <label for="bio" class="mb-2">Bio </label>
                              <textarea   class="form-control" name="bio" id="bio" placeholder="Write About Yourself"  required>{{$user->bio}}</textarea>
                            </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex">
                            <div class="pb-4">
                              <h4 class="mb-0">Contact Details</h4>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="email" class="mb-2">Email <span class="red_f">*</span></label>
                              <input type="email" value="{{$user->email}}" name="email"  id="email" class="form-control" placeholder="Enter email Id" required>
                            </div>  
                          </div>
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="phone" class="mb-2">Phone Number <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->phone}}" name="phone" placeholder="Enter phone number"   id="phone" readonly="readonly">
                            </div>
                          </div>
                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex">
                            <div class="pb-4">
                              <h4 class="mb-0">Address Details</h4>
                            </div>
                          </div>
                         
                          <input type="hidden" name="longitude" value="{{$user->longitude}}" id="longitude">
                          <input type="hidden" name="latitude" value="{{$user->latitude}}" id="latitude">
                          
                    <div class="col-lg-12 py-2">
                            <div>
                              <label for="address" class="mb-2">Hospital/Clinic Name,Address <span class="red_f">*</span></label>
                              <input class="form-control" id="address" name="address" id="autocomplete" placeholder="Enter Address" required value="{{$user->address}}">
                            </div>
                          </div>
                        <div class="col-lg-6 py-2">
                            <div>
                                <label for="city" class="mb-2">City <span class="red_f">*</span></label>
                                <input type="text" class="form-control" value="{{$user->city}}" name="city" id="city" required>
                            </div>
                        </div>
                      <div class="col-lg-12 py-2">
                            <div>
                            <label for="addressInput" class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
    <span>Locality <span class="red_f">*</span></span>
    <span class="d-none">(Lat: <span id="lat">{{$user->latitude}}</span>, Long: <span id="lng">{{$user->longitude}}</span>)</span>
    <button id="viewMapBtn" type="button" class="btn btn-primary btn-sm">View Map</button>
</label>

                              <input class="form-control"  name="locality" id="addressInput"  placeholder="Search for locality"  required value="{{$user->locality}}">
                            </div>
                          </div>


                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="zipcode" class="mb-2">Zip Code <span class="red_f">*</span></label>
                              <input 
                              type="text" 
                              id="zipcode" 
                              class="form-control" 
                              value="{{$user->zipcode}}" 
                              name="zipcode" 
                              placeholder="Enter Zip Code" 
                              required 
                              oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);" 
                              pattern="\d{6}" 
                              title="Zip code must be 6 digits">

                            </div>
                          </div>


                          <div class="col-lg-6 py-2">
    <div>
        <label for="state" class="mb-2">State <span class="red_f">*</span></label>
        <select class="form-control" id="state" name="state" required>
            <option value=""  selected>Select State</option>
            @foreach($states as $state)
                <option value="{{ $state->name }}" 
                    {{ $user->state === $state->name ? 'selected' : '' }}>
                    {{ $state->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-lg-6 py-2">
                            <div>
                              <label for="country" class="mb-2">Country <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="INDIA" id="country" name="country" value="INDIA" readonly="readonly" required>
                            </div>
                          </div>
                       

                          <div class="my-3">
                            <hr>
                          </div>
                          <div class="d-flex">
                            <div class="pb-4">
                              <h4 class="mb-0">Other Details</h4>
                            </div>
                          </div>
                          
                          <div class="col-lg-6 py-2">
                            <div>
                              <label for="education" class="mb-2">Education Level <span class="red_f">*</span></label>
                              <input type="text" class="form-control" value="{{$user->education}}" id="education"  name="education" placeholder="MBBS, MD" required>
                            </div>
                          </div>
                          <div class="col-lg-6 py-2">
    <div>
        <label for="" class="mb-2">Languages <span class="red_f">*</span></label>
        
        <!-- Display Selected Languages -->
        <div id="selected-languages">
            <!-- Initially show selected languages here -->
            {{ implode(', ', array_column($languages, 'name')) }}
        </div>

     
        <!-- Hidden List of All Languages -->
        <div id="languages-list" class="languages-list-container" style="max-height: 200px; overflow-y: scroll; border: 1px solid #ccc; margin-top: 10px; padding: 10px;">

            @foreach($alllanguages as $alllanguage)
                <div class="language-item">
                    <input type="checkbox" 
                           class="language-checkbox" 
                           value="{{ $alllanguage }}" 
                           {{ in_array($alllanguage, array_column($languages, 'name')) ? 'checked' : '' }}>
                    <label>{{ $alllanguage }}</label>
                </div>
            @endforeach

        </div>
        
    </div>
</div>

<!-- Hidden Input Fields to submit languages -->
<div id="hidden-inputs">
    @foreach($languages as $language)
        <input type="hidden" name="languages[][name]" value="{{ $language->name }}">
    @endforeach
</div>


 <div class="my-3">
                            <hr>
                          </div>
                         
                          <div class="row">
    <!-- Input fields for adding new experiences -->
    <div class="col-lg-3 py-2">
        <div>
            <label for="experience-name">Experience Name</label>
            <input type="text" id="experience-name" class="form-control" placeholder="Enter Experience Name">
        </div>
    </div>
    <div class="col-lg-3 py-2">
        <div>
            <label for="experience-from">From</label>
            <input type="date" id="experience-from" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 py-2">
        <div>
            <label for="experience-to">To</label>
            <input type="date" id="experience-to" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 py-2">
        <button type="button" class="btn btn-primary btn-sm mt-4" id="add-experience-btn">Add Experience</button>
    </div>
</div>

<!-- List of experiences -->
<h4 class="mb-0">Experiences</h4>
<ul id="experience-list">
@foreach ($experiences as $index => $experience)
    <li id="experience-{{ $index }}">
        {{ htmlspecialchars($experience->name) }} ({{ htmlspecialchars($experience->from) }} to {{ htmlspecialchars($experience->to) }})
        
    </li>
    <button type="button" class="delete-btn badge bg-danger badge-sm" data-id="experience-{{ $index }}">Delete</button>
        <input type="hidden" name="experiences[{{ $index }}][name]" value="{{ htmlspecialchars($experience->name) }}">
        <input type="hidden" name="experiences[{{ $index }}][from]" value="{{ htmlspecialchars($experience->from) }}">
        <input type="hidden" name="experiences[{{ $index }}][to]" value="{{ htmlspecialchars($experience->to) }}">
@endforeach

</ul>
                          <div class="my-3">
                            <hr>
                          </div>
                         
                            <!-- Input fields for adding new certificates -->
                            <div class="col-lg-3 py-2">
                            <div>
    <div class="certificate-input">
        <label for="certificate-name">Certificate Name</label>
        <input type="text" id="certificate-name"  class="form-control"  placeholder="Enter Certificate Name">
    </div>
    </div>
    </div>
    <div class="col-lg-3 py-2">
    <div>
    <div class="certificate-input">
        <label for="certificate-by">Issued By</label>
        <input type="text" id="certificate-by" class="form-control"   placeholder="Enter Issued By">
    </div>
    </div>
    </div>
    <div class="col-lg-3 py-2">
    <div>
    <div class="certificate-input">
        <label for="certificate-file">Certificate File</label>
        <input type="file" id="certificate-file"  class="form-control"  accept="image/*,application/pdf">
    </div>
    </div>
    </div>
    <div class="col-lg-3 py-2">
    <div>
    <button type="button" class="btn btn-primary btn-sm mt-4" id="add-certificate-btn">Add Certificate</button>
</div></div>
    <!-- List of certificates -->
    <h4 class="mb-0">Certificates</h4>
   

    <!-- Existing certificates from the database -->
    <ul id="certificate-list">
    @foreach($certificates as $index => $certificate)
    <li id="certificate-{{ $index }}">
        {{ $certificate->name }} by {{ $certificate->by }} 
        (<a href="/certificates/{{ $certificate->file }}" target="_blank">View File</a>)
        <button type="button" class="delete-btn badge bg-danger badge-sm" data-id="certificate-{{ $index }}">Delete</button>
        <input type="hidden" name="certificates[{{ $index }}][name]" value="{{ $certificate->name }}">
        <input type="hidden" name="certificates[{{ $index }}][by]" value="{{ $certificate->by }}">
        <input type="hidden" name="certificates[{{ $index }}][file]" value="{{ $certificate->file }}">
        <input type="hidden" name="certificates[{{ $index }}][is_new]" value="0">
    </li>
@endforeach

    </ul>
                          <div class="my-3">
                            <hr>
                          </div>
                          
                          Note: Any change in profile details will require approval from administration.
                          <div class="col-lg-12 py-2">
                            <div>
                              <label for="" class="mb-2"><span class="red_f">*</span></label>

                              <input type="checkbox" id="terms" required> I Accept the terms and conditions.
                            </div>
                          </div>
                          
                          <div class="d-flex gap-3 py-4">
    <a href="#" id="cancelButton">
        <div class="Cancel_custome_btn">Cancel</div>
    </a>
    <button type="submit" class="Submit_custome_btn" id="submitForm">
        Submit
</button>
</div>

                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</main>


@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$(document).ready(function () {
  
    
    
      $('.profile').addClass('active_side');

      var readURL = function (input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }


      $(".file-upload").on('change', function () {
        readURL(this);
      });

      $(".upload-button").on('click', function () {
        $(".file-upload").click();
      });
   
    $('#cancelButton').on('click', function(e) {
        e.preventDefault(); // Prevent default action (i.e., link behavior)
        // Perform cancel actions here
        Swal.fire({
            title: 'Cancelled',
            text: 'Your action has been cancelled.',
            icon: 'info',
            confirmButtonText: 'Ok'
        });
    });

    
    let certificateIndex = {{ count($certificates) }}; // Start from existing certificates count

// Handle adding new certificates
$('#add-certificate-btn').on('click', function () {
    const name = $('#certificate-name').val().trim();
    const by = $('#certificate-by').val().trim();
    const fileInput = $('#certificate-file')[0];
    const file = fileInput.files[0];

    if (!name || !by || !file) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please fill in all fields and select a file.',
        });
        return;
    }

    const newId = `certificate-${certificateIndex}`;
    const listItem = `
        <li id="${newId}">
            ${name} by ${by} 
            (<span class="text-muted">New File</span>)
            <button type="button" class="delete-btn badge bg-danger badge-sm" data-id="${newId}">Delete</button>
            <input type="hidden" name="certificates[${certificateIndex}][name]" value="${name}">
            <input type="hidden" name="certificates[${certificateIndex}][by]" value="${by}">
            <input type="file" name="certificates[${certificateIndex}][file]" style="display: none;" />
            <input type="hidden" name="certificates[${certificateIndex}][is_new]" value="1">
        </li>
    `;
    $('#certificate-list').append(listItem);

    // Attach file to dynamically created input
    const hiddenFileInput = $(`#${newId}`).find('input[type="file"]')[0];
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    hiddenFileInput.files = dataTransfer.files;

    addDeleteFunctionality(`#${newId}`);

    // Reset the input fields
    $('#certificate-name').val('');
    $('#certificate-by').val('');
    $('#certificate-file').val('');

    certificateIndex++;
});

// Delete functionality for certificates
function addDeleteFunctionality(selector) {
    $(selector).find('.delete-btn').on('click', function () {
        const id = $(this).data('id');
        $(`#${id}`).remove();
    });
}

// Initialize delete buttons for existing certificates
$('#certificate-list .delete-btn').each(function () {
    addDeleteFunctionality(`#${$(this).data('id')}`);
});

});


  </script>

<script>
$(document).ready(function () {
    // When the "Change Languages" button is clicked, toggle the language list visibility
    $('#change-languages-btn').on('click', function () {
        $('#languages-list').toggle();  // Toggle visibility of the language list
    });

    // When the user changes the checkbox selection, update the selected languages and hidden inputs
    $(".language-checkbox").on("change", function () {
        const selectedLanguages = [];
        const $languageList = $("#selected-languages");
        const $hiddenInputs = $("#hidden-inputs");

        // Clear existing languages in the list and hidden inputs
        $languageList.empty();
        $hiddenInputs.empty();

        // Loop through each selected checkbox
        $(".language-checkbox:checked").each(function () {
            const language = $(this).val();
            selectedLanguages.push(language);

            // Add selected language to the visible list
            $languageList.append(language + ", ");

            // Add hidden input field for submission
            $hiddenInputs.append(`<input type="hidden" name="languages[][name]" value="${language}">`);
        });

        // Remove the trailing comma and space from the displayed list
        $languageList.text($languageList.text().slice(0, -2));
    });

    // Trigger change event to initialize hidden fields on page load (if any languages are selected)
    $(".language-checkbox").trigger("change");
});
$('#add-experience-btn').on('click', function () {
    const name = $('#experience-name').val().trim();
    const from = $('#experience-from').val();
    const to = $('#experience-to').val();

    // Validate inputs
    if (!name || !from || !to) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please fill in all fields.',
        });
        return;
    }

    // Create a unique ID for the new experience
    const index = Date.now();

    // Add to the visible list
    const listItem = `
        <li id="experience-${index}">
            ${name} (${from} to ${to})
            <button type="button" class="delete-btn badge bg-danger badge-sm" data-id="experience-${index}">Delete</button>
            <input type="hidden" name="experiences[${index}][name]" value="${name}">
            <input type="hidden" name="experiences[${index}][from]" value="${from}">
            <input type="hidden" name="experiences[${index}][to]" value="${to}">
        </li>
    `;
    $('#experience-list').append(listItem);

    // Add delete functionality to the new button
    addExperienceDeleteFunctionality(`#experience-${index} .delete-btn`);

    // Clear input fields
    $('#experience-name').val('');
    $('#experience-from').val('');
    $('#experience-to').val('');
});

// Add delete functionality to existing buttons
$('#experience-list .delete-btn').each(function () {
    addExperienceDeleteFunctionality(this);
});

// Function to handle deleting experiences
function addExperienceDeleteFunctionality(button) {
    $(button).on('click', function () {
        const experienceId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This experience will be removed!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#${experienceId}`).remove();
                // Swal.fire('Deleted!', 'Experience has been removed.', 'success');
            }
        });
    });
}

</script>

<style>
  /* Modal styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.4); /* Fallback background */
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
  
.languages-list-container {
    border: 1px solid #ccc;
    padding: 10px;
    max-height: 200px;
    overflow-y: auto;
    margin-top: 10px;
}

.language-item {
    padding: 5px;
}

.language-item label {
    margin-left: 10px;
}
.btn-primary{
background:#000066;
border-color:#000066;
}
.btn-primary:hover{
  background:#000066;
border-color:#000066;
}

</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkVY54ZKvhxyMy9fJzcK2LS1uIUxVdwEU&libraries=places"></script>
    <script>
        function initializeAutocomplete() {
            const input = document.getElementById('addressInput');
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
                    $("#lng").text(lng);
                    $("#lat").text(lat);
                   
                    
                } else {
                    alert('Invalid address.');
                }
            });
        }

        // Initialize Autocomplete when the page loads
        google.maps.event.addDomListener(window, 'load', initializeAutocomplete);
    </script>
<script>
    let autocomplete;
    let cityInput = document.getElementById('city');
    let stateInput = document.getElementById('state');
    let zipcodeInput = document.getElementById('zipcode');

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
                let state = '';
                let zipCode = '';

                // Loop through the address components to extract city, state, and zip code
                for (let i = 0; i < place.address_components.length; i++) {
                    const component = place.address_components[i];

                    // Extract city
                    if (component.types.includes('locality')) {
                        city = component.long_name;
                    }

                    // Extract state
                    if (component.types.includes('administrative_area_level_1')) {
                        state = component.long_name.toUpperCase();
                        console.log(state);
                    }

                    // Extract zip code
                    if (component.types.includes('postal_code')) {
                        zipCode = component.long_name;
                    }
                }

                // Populate the #city field
                cityInput.value = city;

                // Auto-select the state, ensuring case-insensitive comparison
                const selectedState = stateInput.value;
                if (selectedState && state.toLowerCase() === selectedState.toLowerCase()) {
                    stateInput.value = state;
                } else {
                    stateInput.value = state;
                }

                // Populate the #zipcode field
                zipcodeInput.value = zipCode;

            } else {
                alert('Invalid address.');
            }
        });
    }

    // Initialize the autocomplete after the page loads
    google.maps.event.addDomListener(window, 'load', initAutocomplete);


    $(document).ready(function() {
    
        $("#viewMapBtn").on('click', function() {
          let lat = $("#latitude").val();
          let lng = $("#longitude").val();
            // Open modal if lat and lng are valid
            if (lat && lng) {
                // Initialize the map and open the modal
                openMapModal(lat, lng);
                // alert(la/t+" "+lng);
                $('#mapModal').modal('show'); // Show Bootstrap modal
            } else {
                alert("Invalid latitude and longitude.");
            }
        });
    

    // Function to open the map inside the modal
    function openMapModal(lat, lng) {
      
        // Initialize the map using Google Maps API
        const mapOptions = {
            center: new google.maps.LatLng(lat, lng),
            zoom: 10,
        };
        const map = new google.maps.Map(document.getElementById("map"), mapOptions);

        // Add a marker to the map
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map,
            title: "Selected Location",
        });
    }
});
$(document).ready(function () {
    $(".formData").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        Swal.fire({
            title: "Updating Profile",
            text: "Please do not click back or close this page while processing your request.",
            html: '<div class="spinner"></div>', // Add your spinner design here
            showConfirmButton: false,
            allowOutsideClick: false
        });

        // Collect all form data
        let formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            contentType: false, // Necessary for FormData
            processData: false, // Necessary for FormData
            success: function (response) {
                // Close the Swal modal
                Swal.close();

                if (response.success) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        // Redirect or reload page if necessary
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        confirmButtonText: "Try Again"
                    });
                }
            },
            error: function (xhr) {
                // Close the Swal modal
                Swal.close();

                let errorMessage = "An unexpected error occurred.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: "Error",
                    text: errorMessage,
                    icon: "error",
                    confirmButtonText: "Try Again"
                });
            }
        });
    });
});



</script>
                          
<!-- Bootstrap Modal for Showing Map -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true" style="z-index:999999">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel">Location Map</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="map" style="width: 100%; height: 400px;"></div>
      </div>
    </div>
  </div>
</div>
<style>
    .spinner {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 6px solid #f3f3f3; /* Light gray color */
        border-top: 6px solid blue; /* Blue color for the top */
        border-bottom: 6px solid red; /* Red color for the bottom */
        animation: spin 1.5s linear infinite;
        margin:0px auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
  @endsection