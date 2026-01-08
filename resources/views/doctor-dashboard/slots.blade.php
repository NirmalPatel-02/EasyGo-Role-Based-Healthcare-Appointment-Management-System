@extends('doctor-dashboard.layout')
@section('title','Slots List')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

<main id="main" class="main">
  
  <section class="section dashboard">
    <div class="page_title_link">
      <div class="desbord_card d-flex gap-2 align-items-center p-3">
        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 8.5L3.16667 6.83333M3.16667 6.83333L9 1L14.8333 6.83333M3.16667 6.83333V15.1667C3.16667 15.3877 3.25446 15.5996 3.41074 15.7559C3.56702 15.9122 3.77899 16 4 16H6.5M14.8333 6.83333L16.5 8.5M14.8333 6.83333V15.1667C14.8333 15.3877 14.7455 15.5996 14.5893 15.7559C14.433 15.9122 14.221 16 14 16H11.5M6.5 16C6.72101 16 6.93298 15.9122 7.08926 15.7559C7.24554 15.5996 7.33333 15.3877 7.33333 15.1667V11.8333C7.33333 11.6123 7.42113 11.4004 7.57741 11.2441C7.73369 11.0878 7.94565 11 8.16667 11H9.83333C10.0543 11 10.2663 11.0878 10.4226 11.2441C10.5789 11.4004 10.6667 11.6123 10.6667 11.8333V15.1667C10.6667 15.3877 10.7545 15.5996 10.9107 15.7559C11.067 15.9122 11.279 16 11.5 16M6.5 16H11.5" stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">
          <span>Home</span>
        </p>
        <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">Slots List</p>
       
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
            <div>
              <h3 class="mb-0">All Slots List</h3>
            </div>
            <div class="d-flex flex-wrap gap-2">
            <div class="ms-auto px-3 py-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSlotModal">
        Add Slot
    </button>
               
            </div>
             
            </div>
          </div>

          <div class="table_scroll mt-3">
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
          <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($slots as $slot)
                <tr>
                    <td>{{ $slot->time_slot }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSlotModal" data-id="{{ $slot->id }}" data-time="{{ $slot->time_slot }}">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm delete-slot" data-id="{{ $slot->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No slots found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        </div>

        

        </div>
      </div>
    </div>
    
  </section>
</main>
@endsection
@section('scripts')

<div class="modal fade" id="addSlotModal" tabindex="-1" aria-labelledby="addSlotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('addSlot') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSlotModalLabel">Add Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="time_slot" class="form-label">Time Slot (HH:MM AM/PM)</label>
                        <input type="text" class="form-control" id="time_slot" name="time_slot" required >
                        
                    </div>
                    <input type="hidden" name="doctor_id" value="{{ Auth::id() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Slot</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Slot Modal -->
<div class="modal fade" id="editSlotModal" tabindex="-1" aria-labelledby="editSlotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="editSlotForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSlotModalLabel">Edit Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_time_slot" class="form-label">Time Slot (HH:MM AM/PM)</label>
                        <input type="text" class="form-control" id="edit_time_slot" name="time_slot" required 
                               >
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function () {
        // Add 'active_side' class to '.slots'
        $('.slots').addClass('active_side');

        // Initialize Flatpickr for time pickers
        flatpickr("#time_slot", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // h for hours, i for minutes, K for AM/PM
            time_24hr: false // Ensures AM/PM is used
        });

        const editTimePicker = flatpickr("#edit_time_slot", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // h for hours, i for minutes, K for AM/PM
            time_24hr: false // Ensures AM/PM is used
        });

        // Pass slot data to the edit modal
        $('#editSlotModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget); // Use jQuery to get the button
            const slotId = button.data('id'); // Get 'data-id' attribute
            const timeSlot = button.data('time'); // Get 'data-time' attribute

            const form = $('#editSlotForm');
            form.attr('action', "{{ route('slot.update', ':id') }}".replace(':id', slotId));

            // Set the value of the time slot in the input field
            $('#edit_time_slot').val(timeSlot);
            // Update Flatpickr instance with the new value
            editTimePicker.setDate(timeSlot, true);
        });

        // Handle delete action
        $('.delete-slot').on('click', function () {
            const slotId = $(this).data('id'); // Get 'data-id' attribute

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Construct the delete URL
                    const deleteUrl = "{{ route('slots.destroy', ':id') }}".replace(':id', slotId);

                    // Perform the delete request
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.success) {
                                Swal.fire('Deleted!', 'The slot has been deleted.', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Error!', data.message || 'An error occurred.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'An error occurred during the request.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>

@endsection