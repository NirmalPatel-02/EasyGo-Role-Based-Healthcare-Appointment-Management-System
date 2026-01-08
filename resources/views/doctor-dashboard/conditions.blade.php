@extends('doctor-dashboard.layout')
@section('title','Conditions List')
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
                <p class="mb-0">Conditions List</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 my-3">
                <div class="desbord_card p-3 h-100 table-responsive">
                    <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-0">All Terms & Conditions List</h3>
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
                    <div class="mt-3">
                    <form>
    <div class="d-flex gap-2 align-items-center">
        
        <input type="text" id="condition-input" style="width:80%" placeholder="Add a condition">
        <button type="button" id="add-condition" class="btn btn-primary btn-sm">Add</button>

        
    </div>
    </form>
</div>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>Condition</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="conditions-table-body">
    @foreach($doctorData['conditions'] ?? [] as $condition)
        <tr data-id="{{ $condition->id }}">
            <td>{{ $condition->value }}</td>
            <td>
                <button class="btn btn-danger btn-sm delete-condition" data-id="{{ $condition->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button id="save-conditions" class="btn btn-success mt-3">Save</button>

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
    $('.conditions').addClass('active_side');
    // Initialize the local array with the PHP-provided conditions
    let conditionList = @json(collect($doctorData['conditions'] ?? [])->map(function ($condition) {
        return [
            'id' => $condition['id'], // Ensure you adjust these keys to match your data structure
            'value' => $condition['value'],
        ];
    }));

    // Add a new condition
    $('#add-condition').click(function () {
        const conditionValue = $('#condition-input').val().trim();
        if (!conditionValue) {
            Swal.fire({
                icon: 'warning',
                title: 'Condition cannot be empty!',
                text: 'Please enter a condition before adding.',
                showConfirmButton: true
            });
            return;
        }

        const tempId = `temp-${Math.random().toString(36).substring(7)}`;
        $('#conditions-table-body').append(`
            <tr data-id="${tempId}">
                <td>${conditionValue}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-condition" data-id="${tempId}">Delete</button>
                </td>
            </tr>
        `);

        // Update local array
        conditionList.push({ id: tempId, value: conditionValue });
        $('#condition-input').val(''); // Clear input
    });

    // Delete a condition
    $(document).on('click', '.delete-condition', function () {
        const id = $(this).data('id');
        $(this).closest('tr').remove();

        // Remove from local array
        conditionList = conditionList.filter(condition => condition.id !== id);
    });

    // Save all conditions
    $('#save-conditions').click(function () {
        const payload = conditionList.map(condition => ({
            id: condition.id,
            value: condition.value
        }));

        $.ajax({
            url: "/doctor-dashboard/doctor/update-data",
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { conditions: payload },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Conditions saved successfully!',
                    showConfirmButton: true,
                    timer: 2000 // Automatically closes the alert after 1.5 seconds
                });
                location.reload(); // Reload page to reflect updated conditions
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to save conditions. Please try again.',
                });
                console.error(xhr.responseJSON);
            }
        });
    });
});


</script>

@endsection
