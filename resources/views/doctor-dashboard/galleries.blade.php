@extends('doctor-dashboard.layout')
@section('title', 'Gallery Management')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="page_title_link">
            <div class="desbord_card d-flex gap-2 align-items-center p-3">
                <p class="mb-0"><span>Home</span></p>
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p class="mb-0">Gallery Management</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 my-3">
                <div class="desbord_card p-3 h-100">
                    <h3 class="mb-0">Manage Your Gallery</h3>

                    <div class="mt-3">
                        <form id="gallery-form" enctype="multipart/form-data">
                            <div class="gallery mt-3 row g-2">
                                <!-- Loop through gallery or show empty boxes -->
                                @php
                                    $maxBoxes = 4;
                                    $imagesCount = count($doctorData["galleries"]);
                                @endphp

                                @for ($i = 0; $i < $maxBoxes; $i++)
                                    <div class="col-6 col-md-3">
                                        <div class="image-container position-relative">
                                            @if ($i < $imagesCount)
                                                <img src="{{ url('galleries/' . $doctorData['galleries'][$i]->name) }}" 
                                                     alt="Image {{ $i + 1 }}" 
                                                     class="img-fluid">
                                                <button type="button" class="btn btn-danger btn-sm delete-image" 
                                                        data-id="{{ $doctorData['galleries'][$i]->id }}" 
                                                        style="position: absolute; top: 5px; right: 5px;">
                                                    &times;
                                                </button>
                                            @else
                                                <label class="upload-box d-flex align-items-center justify-content-center" for="gallery-input-{{ $i }}">
                                                    <input type="file" id="gallery-input-{{ $i }}" 
                                                           class="form-control d-none" 
                                                           data-index="{{ $i }}" accept="image/*"/>
                                                    <span>+</span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <button id="save-gallery" class="btn btn-success mt-3" disabled type="button">Save Gallery</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    const maxFileSize = 2 * 1024 * 1024; // 2 MB
    let galleryUpdates = {}; // To track updates (additions)

    $('.galleries').addClass('active_side');

    // Handle file input change
    $('input[type="file"]').on('change', function () {
        const index = $(this).data('index');
        const file = this.files[0];

        if (file && file.size <= maxFileSize && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $(`label[for="gallery-input-${index}"]`).replaceWith(`
                    <img src="${e.target.result}" alt="New Image" class="img-fluid">
                `);

                galleryUpdates[index] = file; // Track the file for submission
                $('#save-gallery').prop('disabled', false); // Enable save button
            };

            reader.readAsDataURL(file);
        } else {
            alert('Invalid file. Please upload an image file of size up to 2MB.');
            $(this).val(''); // Reset the input
        }
    });

    // Handle save
    $('#save-gallery').click(function () {
    const formData = new FormData();
    let validFiles = true;

    // Append files as an array of images
    Object.keys(galleryUpdates).forEach(index => {
        formData.append('images[]', galleryUpdates[index]);
    });

    // Send the form data to the backend
    $.ajax({
        url: "{{ route('galleries') }}", // Ensure this route is correct
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            Swal.fire({
                icon: response.success ? 'success' : 'error',
                title: response.message,
                timer: 2000,
                
            }).then(function(){
                window.location.reload();
            });
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to save gallery. Please try again.',
                timer: 2000,
                confirmButtonText: "Okay"
            });
            console.error(xhr.responseJSON);
        }
    });
});


    // Handle delete
$('.delete-image').click(function () {
    const imageId = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'This will permanently delete the image.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('gallery.delete', ['id' => '__id__']) }}".replace('__id__', imageId), // Use route name
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        
                        timer: 5000,
                    }).then(function(){
                window.location.reload();
            });

                    // Optionally, remove the image element from the UI
                    $(`#image-${imageId}`).remove(); // Assuming image elements have IDs like image-21
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        timer: 5000,
                        title: 'Failed to delete image.',
                        confirmButtonText: "Okay"
                    });
                }
            });
        }
    });
});


});
</script>

<style>
.upload-box {
    width: 100%;
    height: 100%;
    border: 2px dashed #ccc;
    border-radius: 8px;
    cursor: pointer;
    position: relative;
}

.upload-box span {
    font-size: 2rem;
    color: #7C7C7C;
}

.image-container {
    position: relative;
    border: 2px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    height: 150px;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.delete-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: rgba(255, 0, 0, 0.8);
    color: #fff;
    border: none;
    border-radius: 50%;
    padding: 5px 8px;
    cursor: pointer;
}
</style>
@endsection
