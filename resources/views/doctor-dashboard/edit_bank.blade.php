@extends('doctor-dashboard.layout')
@section('title','Edit Bank Details')
@section('content')

<main id="main" class="main">
  <div class="d-flex justify-content-between">
  
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
        <p class="mb-0">Edit Bank Details</p>
      </div>
    </div>

    

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <section class="profile_title">
            <div class="container">
             
              <div class="profile_details pb-5">
                <div class="row">
                 
                  <div class="col-md-12 align-items-center">
                    <div class="right_part">
                    
                    <form action="">
  <div class="row">
  

    <div class="col-lg-6 py-2">
      <div>
        <label for="HolderName" class="mb-2">Holder Name<span class="red_f">*</span></label>
        <input type="text"  class="form-control" placeholder="Sarrgun" required>
      </div>
    </div>
 <div class="col-lg-6 py-2">
      <div>
        <label for="BankName" class="mb-2">Bank Name<span class="red_f">*</span></label>
        <input type="text"  class="form-control" placeholder="SBI" required>
      </div>
    </div>
<div class="col-lg-6 py-2">
      <div>
        <label for="account_no" class="mb-2">Account No<span class="red_f">*</span></label>
        <input type="text"  class="form-control" placeholder="123456789" required>
      </div>
    </div>
<div class="col-lg-6 py-2">
      <div>
        <label for="ifsc" class="mb-2">IFSC Code<span class="red_f">*</span></label>
        <input type="text"  placeholder="Sbi0000" class="form-control" required>
      </div>
    </div>
<div class="col-lg-6 py-2">
      <div>
        <label for="branch" class="mb-2">Branch Name<span class="red_f">*</span></label>
        <input type="text" placeholder="Delhi" class="form-control" required>
      </div>
    </div>

   
    
    <!-- Buttons Section -->
    <div class="d-flex gap-3 py-4">
      <a href="#">
        <div class="Cancel_custome_btn">Cancel</div>
      </a>
      <a href="#" data-bs-toggle="modal" data-bs-target="#Profile_editModel">
        <div class="Submit_custome_btn">Update</div>
      </a>
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

<!-- Modal Slot Book Successfully -->
<div class="modal fade" id="Profile_editModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4 class="mb-1">Slot Added Successfully</h4>
                <p>Slots has been edit successfully</p>
                
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection