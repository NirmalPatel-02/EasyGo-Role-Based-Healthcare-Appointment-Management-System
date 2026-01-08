@extends('doctor-dashboard.layout')
@section('title','Bank List')
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
                <p class="mb-0">Bank List</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 my-3">
                <div class="desbord_card p-3 h-100">
                    <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-0">All Bank List</h3>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <!-- Add Bank Button -->
<button class="btn btn-success" id="addBankButton" data-bs-toggle="modal" data-bs-target="#addBankModal">
    Add Bank
</button>
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
                                    <th>Holder Name</th>
                                    <th>Bank Name</th>
                                    <th>Account No</th>
                                    <th>IFSC Code</th>
                                    <th>BRANCH NAME</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banks as $bank)
                                    <tr>
                                        <td>{{ $bank->holder_name }}</td>
                                        <td>{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->account_no }}</td>
                                        <td>{{ $bank->ifsc }}</td>
                                        <td>{{ $bank->branch_name }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBankModal" data-id="{{ $bank->id }}" data-holder_name="{{ $bank->holder_name }}" data-bank_name="{{ $bank->bank_name }}" data-account_no="{{ $bank->account_no }}" data-ifsc="{{ $bank->ifsc }}" data-branch_name="{{ $bank->branch_name }}">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-bank" data-id="{{ $bank->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
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
<script>
    $('.banks').addClass('active_side');

    // Delete bank logic with SweetAlert
    $('.delete-bank').on('click', function() {
        const bankId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You will not be able to recover this bank information!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "{{ route('banks.destroy', ':id') }}".replace(':id', bankId),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                success: function(response) {
                    Swal.fire('Deleted!', 'The bank has been deleted.', 'success').then(function(){
                      location.reload();
                    });
                     // Reload to reflect changes
                },
                error: function(error) {
                    console.log(error); // Log error for debugging
                    Swal.fire('Error!', 'There was an issue deleting the bank.', 'error');
                }
            });

            }
        });
    });
</script>

<!-- Add Bank Modal -->
<div class="modal fade" id="addBankModal" tabindex="-1" aria-labelledby="addBankModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('banks.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBankModalLabel">Add Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="holder_name" class="form-label">Holder Name</label>
                        <input type="text" class="form-control" id="holder_name" name="holder_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_no" class="form-label">Account No</label>
                        <input type="text" class="form-control" id="account_no" name="account_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="ifsc" class="form-label">IFSC Code</label>
                        <input type="text" class="form-control" id="ifsc" name="ifsc" required>
                    </div>
                    <div class="mb-3">
                        <label for="branch_name" class="form-label">BRANCH NAME</label>
                        <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Bank</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Bank Modal -->
<div class="modal fade" id="editBankModal" tabindex="-1" aria-labelledby="editBankModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="editBankForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBankModalLabel">Edit Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_holder_name" class="form-label">Holder Name</label>
                        <input type="text" class="form-control" id="edit_holder_name" name="holder_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="edit_bank_name" name="bank_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_account_no" class="form-label">Account No</label>
                        <input type="text" class="form-control" id="edit_account_no" name="account_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_ifsc" class="form-label">IFSC Code</label>
                        <input type="text" class="form-control" id="edit_ifsc" name="ifsc" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_branch_name" class="form-label">branch_name</label>
                        <input type="text" class="form-control" id="edit_branch_name" name="branch_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Bank</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

<script>
    // Populate edit modal with bank details
    $('#editBankModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); 
        const bankId = button.data('id');
        const holderName = button.data('holder_name');
        const bankName = button.data('bank_name');
        const accountNo = button.data('account_no');
        const ifscCode = button.data('ifsc');
        const branch_name = button.data('branch_name');
        
        const form = $(this).find('form');
        form.attr('action',  "{{ route('banks.update', ':id') }}".replace(':id', bankId));

        form.find('#edit_holder_name').val(holderName);
        form.find('#edit_bank_name').val(bankName);
        form.find('#edit_account_no').val(accountNo);
        form.find('#edit_ifsc').val(ifscCode);
        form.find('#edit_branch_name').val(branch_name);
    });
    
</script>
<script>
   $(document).ready(function () {
    // Convert IFSC code to uppercase automatically
    $('#edit_ifsc, #add_ifsc').on('input', function() {
        var inputValue = $(this).val();
        $(this).val(inputValue.toUpperCase()); // Convert the value to uppercase
    });

    // Validation for Add Bank Form
    $('#addBankModal form').validate({
        rules: {
            holder_name: {
                required: true,
                minlength: 3,
                maxlength: 50,
                pattern: /^[a-zA-Z ]+$/ // Only letters and spaces
            },
            bank_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            account_no: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 18
            },
            ifsc: {
                required: true,
                pattern: /^[A-Z]{4}0[A-Z0-9]{6}$/, // IFSC code format validation
                minlength: 11,
                maxlength: 11
            },
            branch_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            }
        },
        messages: {
            holder_name: {
                required: "Holder name is required.",
                minlength: "Holder name should be at least 3 characters.",
                maxlength: "Holder name cannot exceed 50 characters.",
                pattern: "Holder name should only contain letters and spaces."
            },
            bank_name: {
                required: "Bank name is required.",
                minlength: "Bank name should be at least 3 characters.",
                maxlength: "Bank name cannot exceed 50 characters."
            },
            account_no: {
                required: "Account number is required.",
                digits: "Account number should contain only digits.",
                minlength: "Account number should be between 9 and 18 digits.",
                maxlength: "Account number should be between 9 and 18 digits."
            },
            ifsc: {
                required: "IFSC code is required.",
                pattern: "Invalid IFSC code format. It should be like ABCD0123456.",
                minlength: "IFSC code should be exactly 11 characters.",
                maxlength: "IFSC code should be exactly 11 characters."
            },
            branch_name: {
                required: "Branch name is required.",
                minlength: "Branch name should be at least 3 characters.",
                maxlength: "Branch name cannot exceed 50 characters."
            }
        },
        errorPlacement: function(error, element) {
            // Insert error message directly after the element
            error.insertAfter(element);
            error.css("color", "red"); // Set error text color to red
        }
    });

    // Validation for Edit Bank Form
    $('#editBankForm').validate({
        rules: {
            holder_name: {
                required: true,
                minlength: 3,
                maxlength: 50,
                pattern: /^[a-zA-Z ]+$/ // Only letters and spaces
            },
            bank_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            account_no: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 18
            },
            ifsc: {
                required: true,
                pattern: /^[A-Z]{4}0[A-Z0-9]{6}$/, // IFSC code format validation
                minlength: 11,
                maxlength: 11
            },
            branch_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            }
        },
        messages: {
            holder_name: {
                required: "Holder name is required.",
                minlength: "Holder name should be at least 3 characters.",
                maxlength: "Holder name cannot exceed 50 characters.",
                pattern: "Holder name should only contain letters and spaces."
            },
            bank_name: {
                required: "Bank name is required.",
                minlength: "Bank name should be at least 3 characters.",
                maxlength: "Bank name cannot exceed 50 characters."
            },
            account_no: {
                required: "Account number is required.",
                digits: "Account number should contain only digits.",
                minlength: "Account number should be between 9 and 18 digits.",
                maxlength: "Account number should be between 9 and 18 digits."
            },
            ifsc: {
                required: "IFSC code is required.",
                pattern: "Invalid IFSC code format. It should be like ABCD0123456.",
                minlength: "IFSC code should be exactly 11 characters.",
                maxlength: "IFSC code should be exactly 11 characters."
            },
            branch_name: {
                required: "Branch name is required.",
                minlength: "Branch name should be at least 3 characters.",
                maxlength: "Branch name cannot exceed 50 characters."
            }
        },
        errorPlacement: function(error, element) {
            // Insert error message directly after the element
            error.insertAfter(element);
            error.css("color", "red"); // Set error text color to red
        }
    });
});

</script>
<script>
    $(document).ready(function () {
        $('#addBankButton').click(function () {
            // Reset the form fields
            $('#addBankForm')[0].reset();
        });
    });
</script>
@endsection
