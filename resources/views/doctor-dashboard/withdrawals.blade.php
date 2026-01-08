@extends('doctor-dashboard.layout')
@section('title','Withdrawal History')
@section('content')

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
          <path d="M1.5 8.5L3.16667 6.83333M3.16667 6.83333L9 1L14.8333 6.83333M3.16667 6.83333V15.1667C3.16667 15.3877 3.25446 15.5996 3.41074 15.7559C3.56702 15.9122 3.77899 16 4 16H6.5M14.8333 6.83333L16.5 8.5M14.8333 6.83333V15.1667C14.8333 15.3877 14.7455 15.5996 14.5893 15.7559C14.433 15.9122 14.221 16 14 16H11.5M6.5 16C6.72101 16 6.93298 15.9122 7.08926 15.7559C7.24554 15.5996 7.33333 15.3877 7.33333 15.1667V11.8333C7.33333 11.6123 7.42113 11.4004 7.57741 11.2441C7.73369 11.0878 7.94565 11 8.16667 11H9.83333C10.0543 11 10.2663 11.0878 10.4226 11.2441C10.5789 11.4004 10.6667 11.6123 10.6667 11.8333V15.1667C10.6667 15.3877 10.7545 15.5996 10.9107 15.7559C11.067 15.9122 11.279 16 11.5 16M6.5 16H11.5" stroke="#302C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">
          <span>Home</span>
        </p>
        <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.5 11.5L6.5 6.5L1.5 1.5" stroke="#7C7C7C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="mb-0">Withdrawals History</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
            <div>
              <h3 class="mb-0">All Withdrawal History</h3>
            </div>
            <div class="d-flex flex-wrap gap-2">
    <!-- Search Bar Form -->
    <div class="search-bar ms-auto px-3 py-2">
        <form class="d-flex align-items-center" method="GET" action="{{ route('withdrawals') }}">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            <input type="text" name="bank_name" placeholder="Search by Bank name" title="Enter search keyword" value="{{ request()->query('bank_name') }}">
        </form>
    </div>

    <!-- Date Filter Form -->
    <div class="input_fild px-3">
        <form class="d-flex align-items-center" method="GET" action="{{ route('withdrawals') }}">
            <input type="date" class="w-100 border-0" name="created_at" onchange="this.form.submit()" value="{{ request()->query('created_at') }}">
        </form>
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
          <table class="table table-striped" id="example">
    <thead>
        <tr>
            <th scope="col">Amount</th>
            <th scope="col">Bank Name</th>
            <th scope="col">Account No</th>
            <th scope="col">IFSC Code</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">View Receipt</th>
        </tr>
    </thead>
    <tbody>
      
        @foreach($withdrawals as $withdrawal)
            <tr>
                <td>{{ $withdrawal->amount }}</td>
                <td>{{ $withdrawal->bank_name }}</td>
                <td>{{ $withdrawal->account_no }}</td>
                <td>{{ $withdrawal->ifsc }}</td>
                <td>{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('d/m/Y') }}</td>
                <td>{{ $withdrawal->status }}</td>
                <td>
                    @if($withdrawal->file)
                        <a href="{{ asset('withdrawals/'.$withdrawal->file) }}" download>Download File</a>
                    @else
                        No File Uploaded
                    @endif
                </td>

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
        $('.withdrawals').addClass('active_side');
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
const totalPages = {{ $withdrawals->lastPage() }};  // Get total pages from the pagination data
const currentPage = {{ $withdrawals->currentPage() }};  // Get current page from the pagination data

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
