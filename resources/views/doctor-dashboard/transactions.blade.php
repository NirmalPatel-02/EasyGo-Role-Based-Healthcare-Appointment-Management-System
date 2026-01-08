@extends('doctor-dashboard.layout')
@section('title','Doctors Transaction')
@section('content')

<main id="main" class="main">
  <div class="d-flex justify-content-between">
    
  </div>
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
        <p class="mb-0">Transactions</p>
      </div>
    </div>

    <div class="row">
      
      <div class="col-lg-4 col-md-4 col-sm-6 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-2">Today's Earning</p>
              <h4 class="fw-bold">{{$todaysEarnings}}</h4>
            </div>
            <div>
              <img src="{{asset('doctor-asset/img/Today_Earning.svg')}}" class="w-100" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-2">Withdraw</p>
              <h4 class="fw-bold">{{$withdrawnAmount}}</h4>
            </div>
            <div>
              <img src="{{asset('doctor-asset/img/Withdraw.svg')}}" class="w-100" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-2">Remaining Balance</p>
              <div class="d-flex gap-2 align-items-center">
                <h4 class="fw-bold mb-0">{{$remainingBalance}}</h4>
                <a href="#" data-bs-toggle="modal" data-bs-target="#WithdrawModal">
                  <div class="Withdraw_btn px-3 py-2">Withdraw</div>
                </a>
              </div>
            </div>
            <div>
              <img src="{{asset('doctor-asset/img/Remaining_Balance.svg')}}" class="w-100" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Withdraw Modal-->
  <!-- Modal Withdraw Modal-->
  <div class="modal fade" id="WithdrawModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Withdraw</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="withdrow_form">
                            <form action="{{ route('withdraw') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 py-3">
                                        <div>
                                            <label for="amount" class="mb-2">Amount</label>
                                            <div class="input_fild px-3 d-flex align-items-center">
                                            <input type="text" 
       id="amount" 
       name="amount" 
       placeholder="Enter amount Max 10000 in / day" 
       class="border-0 w-100" 
       required 
       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
       maxlength="20">

                                                <svg width="20" height="20" class="ms-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11 14H10V10H9M10 6H10.01M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z" stroke="#0A0101" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 py-3">
                                        <div>
                                            <label for="bank" class="mb-2">Select Bank</label>
                                            <div class="input_fild px-3 d-flex align-items-center">
                                                <select name="bank_id" id="bank" class="border-0 w-100" required>
                                                    <option value="" disabled selected>Select Bank</option>
                                                    @foreach($banks as $bank)
                                                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                    @endforeach
                                                </select>
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 7.00002V15M7.5 7.00002V15M12.5 7.00002V15M17 7.00002V15M1 16.6L1 17.4C1 17.9601 1 18.2401 1.10899 18.454C1.20487 18.6422 1.35785 18.7952 1.54601 18.891C1.75992 19 2.03995 19 2.6 19H17.4C17.9601 19 18.2401 19 18.454 18.891C18.6422 18.7952 18.7951 18.6422 18.891 18.454C19 18.2401 19 17.9601 19 17.4V16.6C19 16.04 19 15.7599 18.891 15.546C18.7951 15.3579 18.6422 15.2049 18.454 15.109C18.2401 15 17.9601 15 17.4 15H2.6C2.03995 15 1.75992 15 1.54601 15.109C1.35785 15.2049 1.20487 15.3579 1.10899 15.546C1 15.7599 1 16.04 1 16.6ZM9.65291 1.07715L2.25291 2.7216C1.80585 2.82094 1.58232 2.87062 1.41546 2.99082C1.26829 3.09685 1.15273 3.24092 1.08115 3.40759C1 3.59654 1 3.82553 1 4.28349L1 5.40002C1 5.96007 1 6.2401 1.10899 6.45401C1.20487 6.64217 1.35785 6.79515 1.54601 6.89103C1.75992 7.00002 2.03995 7.00002 2.6 7.00002H17.4C17.9601 7.00002 18.2401 7.00002 18.454 6.89103C18.6422 6.79515 18.7951 6.64217 18.891 6.45401C19 6.2401 19 5.96007 19 5.40002V4.2835C19 3.82553 19 3.59655 18.9188 3.40759C18.8473 3.24092 18.7317 3.09685 18.5845 2.99082C18.4177 2.87062 18.1942 2.82094 17.7471 2.7216L10.3471 1.07715C9.8475 1.07715 9.78241 1.04837 9.65291 1.07715Z" stroke="#0A0101" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between py-2">
                                    <button type="submit" class="btn btn-primary px-5">Withdraw</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-body">
        <div class="Slot_Book_model">
            <div class="text-end">
                <svg width="22" height="22" data-bs-dismiss="modal" aria-label="Close" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 8L8 14M8 8L14 14M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="success_icon_bg d-flex align-items-center justify-content-center">
                <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5478 4.67395C14.3489 4.53014 16.0587 3.82172 17.4338 2.64955C18.9868 1.3268 20.9602 0.600342 23.0002 0.600342C25.0402 0.600342 27.0135 1.3268 28.5666 2.64955C29.9416 3.82172 31.6515 4.53014 33.4526 4.67395C35.4866 4.83651 37.3962 5.71824 38.839 7.16109C40.2819 8.60394 41.1636 10.5135 41.3262 12.5475C41.469 14.3479 42.1774 16.0587 43.3506 17.4335C44.6733 18.9866 45.3998 20.9599 45.3998 22.9999C45.3998 25.04 44.6733 27.0133 43.3506 28.5663C42.1784 29.9414 41.47 31.6512 41.3262 33.4523C41.1636 35.4864 40.2819 37.396 38.839 38.8388C37.3962 40.2817 35.4866 41.1634 33.4526 41.3259C31.6515 41.4697 29.9416 42.1782 28.5666 43.3503C27.0135 44.6731 25.0402 45.3996 23.0002 45.3996C20.9602 45.3996 18.9868 44.6731 17.4338 43.3503C16.0587 42.1782 14.3489 41.4697 12.5478 41.3259C10.5138 41.1634 8.60418 40.2817 7.16134 38.8388C5.71849 37.396 4.83675 35.4864 4.67419 33.4523C4.53039 31.6512 3.82196 29.9414 2.64979 28.5663C1.32705 27.0133 0.600586 25.04 0.600586 22.9999C0.600586 20.9599 1.32705 18.9866 2.64979 17.4335C3.82196 16.0585 4.53039 14.3487 4.67419 12.5475C4.83675 10.5135 5.71849 8.60394 7.16134 7.16109C8.60418 5.71824 10.5138 4.83651 12.5478 4.67395ZM33.3798 19.3795C33.8898 18.8515 34.1721 18.1442 34.1657 17.41C34.1593 16.6759 33.8648 15.9736 33.3457 15.4545C32.8265 14.9353 32.1243 14.6408 31.3901 14.6345C30.656 14.6281 29.9487 14.9103 29.4206 15.4203L20.2002 24.6407L16.5798 21.0203C16.0517 20.5103 15.3444 20.2281 14.6103 20.2345C13.8761 20.2408 13.1738 20.5353 12.6547 21.0545C12.1356 21.5736 11.8411 22.2759 11.8347 23.01C11.8283 23.7442 12.1105 24.4515 12.6206 24.9795L18.2206 30.5795C18.7457 31.1045 19.4577 31.3993 20.2002 31.3993C20.9427 31.3993 21.6547 31.1045 22.1798 30.5795L33.3798 19.3795Z" fill="#13DEB9"/>
                </svg>
            </div>
            <div class="text-center mt-3 mb-4">
                <h4 class="mb-1">Withdraw request of 5,0000$!</h4>
                <p>Your request has been sent to the admin wait 20-24 hours for the approval Thank you!</p>
                
            </div>
        </div>
      </div>
    
    </div>
  </div>
</div>




    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
        <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
            <div>
              <h3 class="mb-0">All Transactions</h3>
            </div>
            <div class="d-flex flex-wrap gap-2">
              <!-- Search Bar Form -->
              <div class="search-bar ms-auto px-3 py-2">
                  <form class="d-flex align-items-center" method="GET" action="{{ route('wallet.show') }}">
                      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                      <input type="text" name="payment_id" placeholder="Search by Payment ID" title="Enter search keyword" value="{{ request()->query('payment_id') }}">
                  </form>
              </div>

              <!-- Date Filter Form -->
              <div class="input_fild px-3">
                  <form class="d-flex align-items-center" method="GET" action="{{ route('wallet.show') }}">
                      <input type="date" class="w-100 border-0" name="created_at" onchange="this.form.submit()" value="{{ request()->query('created_at') }}">
                  </form>
              </div>
          </div>

                    </div>

          <div class="table_scroll mt-3">
            <table class="table  table-striped " id="example">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">AGE</th>
                        <th scope="col">PHONE NUMBER</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">DATE & TIME</th>
                        
                    </tr>
                </thead>
                <tbody>
               
                @foreach($walletsWithClients->filter(function ($wallet) {
                    return $wallet->credit > 0;
                }) as $row)
                <tr>
                    <td>{{ ucwords(strtolower($row->first_name)) }} {{ ucwords(strtolower($row->last_name)) }}</td>
                    <td>
    <!-- {{ \Carbon\Carbon::parse($row->dob)->format('d/m/Y') }}  -->
    {{ \Carbon\Carbon::parse($row->dob)->age }} years
</td>
                    <td>{{ $row->phone }}</td>
                  
                    <td>{{ $row->credit }}</td>
                    
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y h:i:s a') }}</td>
                    
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>

        

        </div>
      </div>
    </div>
    <div class="desbord_card  px-3">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="py-3">
                <form method="GET" action="{{ url()->current() }}">
    <label for="per_page">Items per page:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
    </select>

    <!-- Add all other query parameters as hidden inputs -->
    @foreach(request()->except('per_page') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>


                </div>
                <div class="table_page_list py-3">
                    <div class="pagination">
                        <ul class="mb-0"> <!--pages or li are comes from javascript --> </ul>
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
        // Add 'active_side' class to '.slots'
        $('.transactions').addClass('active_side');
    });
    $(document).ready(function () {
    $('#WithdrawModal form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        const $form = $(this);
        const url = $form.attr('action');
        const formData = $form.serialize(); // Serialize form data

        // Show a loading spinner
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we process your withdrawal request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function (response) {
                Swal.close(); // Close the loading spinner

                if (response.success) {
                    // Show success message and redirect
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '{{route("withdrawals")}}'; // Redirect to withdrawals route
                    });
                } else {
                    // Show error message if the operation was not successful
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: response.message || 'Something went wrong. Please try again.'
                    });
                }
            },
            error: function (xhr) {
                Swal.close();
                const errorMessage = xhr.responseJSON?.message || 'An error occurred while processing your request.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage
                });
            }
        });
    });
});
function changePage(page) {
    const perPage = document.getElementById('per_page').value;  // Get selected per page value
    const url = new URL(window.location.href);
    url.searchParams.set('page', page); // Update the page parameter
    url.searchParams.set('per_page', perPage);  // Update the per_page parameter
    window.location.href = url.toString();  // Redirect to the updated URL
}

// Selecting required elements
const element = document.querySelector(".pagination ul");
const totalPages = {{ $walletsWithClients->lastPage() }};  // Get total pages from the pagination data
const currentPage = {{ $walletsWithClients->currentPage() }};  // Get current page from the pagination data

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