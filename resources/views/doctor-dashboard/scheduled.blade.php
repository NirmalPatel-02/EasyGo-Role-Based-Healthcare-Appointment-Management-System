@extends('doctor-dashboard.layout')
@section('title','Scheduled Appointment')
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
        <p class="mb-0">Scheduled</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-3">
        <div class="desbord_card p-3 h-100">
          <div class="DR_Name d-flex flex-wrap align-items-center justify-content-between">
            <div>
              <h3 class="mb-0">Scheduled</h3>
            </div>
            <div class="d-flex flex-wrap gap-2">
            <div class="search-bar ms-auto px-3 py-2">
              <form class="d-flex align-items-center" method="POST" action="#">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                <input type="text" name="query" placeholder="Search by name & time" title="Enter search keyword">
              </form>
            </div>
              <div class="input_fild  px-3">
              <input type="date" class="w-100 border-0" >
              </div>
            </div>
          </div>

          <div class="table_scroll mt-3">
            <table class="table  table-striped ">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">DOB</th>
                        <th scope="col">PHONE NUMBER</th>
                        <th scope="col">DATE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="">Sunjay Kumar</td>
                        <td>30/08/1999</td>
                        <td>9876543210</td>
                        <td>May 9, 2024</td>
                        <td>
                          <div class="d-flex gap-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ResheduledModal">
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" data-bs-target="#CancelBookingModal" data-bs-toggle="modal">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">Sunjay Kumar</td>
                        <td>30/08/1999</td>
                        <td>9876543210</td>
                        <td>May 9, 2024</td>
                        <td>
                          <div class="d-flex gap-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ResheduledModal">
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" data-bs-target="#CancelBookingModal" data-bs-toggle="modal">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">Sunjay Kumar</td>
                        <td>30/08/1999</td>
                        <td>9876543210</td>
                        <td>May 9, 2024</td>
                        <td>
                          <div class="d-flex gap-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ResheduledModal">
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" data-bs-target="#CancelBookingModal" data-bs-toggle="modal">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">Sunjay Kumar</td>
                        <td>30/08/1999</td>
                        <td>9876543210</td>
                        <td>May 9, 2024</td>
                        <td>
                          <div class="d-flex gap-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ResheduledModal">
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" data-bs-target="#CancelBookingModal" data-bs-toggle="modal">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">Sunjay Kumar</td>
                        <td>30/08/1999</td>
                        <td>9876543210</td>
                        <td>May 9, 2024</td>
                        <td>
                          <div class="d-flex gap-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ResheduledModal">
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 20.5001C14.6944 20.5001 18.5 16.6945 18.5 12.0001C18.5 9.17456 17.1213 6.67103 15 5.1255M11 22.4001L9 20.4001L11 18.4001M10 3.5001C5.30558 3.5001 1.5 7.30568 1.5 12.0001C1.5 14.8256 2.87867 17.3292 5 18.8747M9 5.6001L11 3.6001L9 1.6001" stroke="#2F80ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" data-bs-target="#CancelBookingModal" data-bs-toggle="modal">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.93 3.93L18.07 18.07M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#FF3B30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                   
                </tbody>
            </table>
        </div>

        

        </div>
      </div>
    </div>
    <div class="desbord_card  px-3">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="py-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>10 per page</option>
                        <option value="1">20 per page</option>
                        <option value="2">50 per page</option>
                        <option value="3">100 per page</option>
                    </select>
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

    <!-- Modal Withdraw Modal-->
<div class="modal fade" id="ResheduledModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Rescheduled</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="withdrow_form">
          <div class="sedule_detail flex-wrap gap-2 d-flex justify-content-between">
              <div>
                <p class="mb-1">First name</p>
                <h5>Mohd Tabrej</h5>
              </div>
              <div>
                <p class="mb-1">DOB</p>
                <h5>30/08/1999</h5>
              </div>
              <div>
                <p class="mb-1">Phone Number</p>
                <h5>9876543210</h5>
              </div>
              <div>
                <p class="mb-1"> Date </p>
                <h5>30/08/2024</h5>
              </div>
              <div>
                <p class="mb-1">Time</p>
                <h5>1:00 - 1:15 PM</h5>
              </div>
          </div>
          <form action="">
            <div class="row">
              <div class="col-md-6 py-3">
                <div>
                  <label for="" class="mb-2">Date</label>
                  <div class="input_fild px-3 d-flex align-items-center">
                    <input type="date" placeholder="" class="border-0 w-100">
                   
                  </div>
                </div>
              </div>
              <div class="col-md-6 py-3">
                <div>
                  <label for="" class="mb-2">Time</label>
                  <div class="input_fild px-3 d-flex align-items-center">
                    <input type="time" placeholder="Choose bank" class="border-0 w-100">
                    
                  </div>
                </div>
              </div>
              <div class="col-md-12 py-3">
                <div>
                  <label for="" class="mb-2">Remark</label>
                  <div class="input_fild px-3 d-flex align-items-center" style="min-height: 66px;">
                    <textarea name="" class="border-0 w-100" style="outline: none;" placeholder="Choose date" id=""></textarea>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="text-end">
              <a href="#" class="d-flex justify-content-end" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">
                <div class="confirm_btns d-flex align-item-center justify-content-center">Confirm</div>
              </a>
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
                <h4 class="mb-1">Rescheduled Booking Successfully!</h4>
                <div class="d-flex justify-content-center gap-3 py-3">
                    <div class="time_date">
                        <svg width="21" height="22" class="me-2" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.5 9H1.5M14.5 1V5M6.5 1V5M6.3 21H14.7C16.3802 21 17.2202 21 17.862 20.673C18.4265 20.3854 18.8854 19.9265 19.173 19.362C19.5 18.7202 19.5 17.8802 19.5 16.2V7.8C19.5 6.11984 19.5 5.27976 19.173 4.63803C18.8854 4.07354 18.4265 3.6146 17.862 3.32698C17.2202 3 16.3802 3 14.7 3H6.3C4.61984 3 3.77976 3 3.13803 3.32698C2.57354 3.6146 2.1146 4.07354 1.82698 4.63803C1.5 5.27976 1.5 6.11984 1.5 7.8V16.2C1.5 17.8802 1.5 18.7202 1.82698 19.362C2.1146 19.9265 2.57354 20.3854 3.13803 20.673C3.77976 21 4.61984 21 6.3 21Z" stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>08,Sep 2024
                    </div>
                    <div class="time_date">
                        <svg width="23" height="22" class="me-2" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.5 5V11L15.5 13M21.5 11C21.5 16.5228 17.0228 21 11.5 21C5.97715 21 1.5 16.5228 1.5 11C1.5 5.47715 5.97715 1 11.5 1C17.0228 1 21.5 5.47715 21.5 11Z" stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>12:00 - 12:15 Pm
                    </div>
                </div>
                <div class="time_date">
                    <svg width="23" height="22" class="me-2" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.5 13.2864C2.64864 14.1031 1.5 15.2412 1.5 16.5C1.5 18.9853 5.97715 21 11.5 21C17.0228 21 21.5 18.9853 21.5 16.5C21.5 15.2412 20.3514 14.1031 18.5 13.2864M17.5 7C17.5 11.0637 13 13 11.5 16C10 13 5.5 11.0637 5.5 7C5.5 3.68629 8.18629 1 11.5 1C14.8137 1 17.5 3.68629 17.5 7ZM12.5 7C12.5 7.55228 12.0523 8 11.5 8C10.9477 8 10.5 7.55228 10.5 7C10.5 6.44772 10.9477 6 11.5 6C12.0523 6 12.5 6.44772 12.5 7Z" stroke="#000066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>Apollo Spectra Hospitals Chirag Enclave
                </div>
            </div>
        </div>
      </div>
  
    </div>
  </div>
</div>

<!-- Modal Cancel Booking -->
<div class="modal fade" id="CancelBookingModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="Cancel_Booking_Modal ">
            <div class="text-end">
                <svg width="22" height="22" data-bs-dismiss="modal" aria-label="Close" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 8L8 14M8 8L14 14M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="delete_svg_bg d-flex align-items-center justify-content-center">
              <svg width="60" height="61" viewBox="0 0 60 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_125_10768)">
                <path d="M30 0.5C13.5117 0.5 0 14.0117 0 30.5C0 46.9883 13.5117 60.5 30 60.5C46.4883 60.5 60 46.9883 60 30.5C60 14.0117 46.4883 0.5 30 0.5ZM7.14844 30.5C7.14844 17.9139 17.4139 7.64844 30 7.64844C34.746 7.64844 39.3165 9.12488 43.2188 11.9022L30 25.121L11.4025 43.7188C8.62488 39.8163 7.14844 35.246 7.14844 30.5ZM30 53.3516C25.254 53.3516 20.6835 51.8749 16.7812 49.0975L48.5977 17.2811C51.3751 21.1835 52.8516 25.7538 52.8516 30.5C52.8516 43.0858 42.5861 53.3516 30 53.3516Z" fill="#FF3636"/>
                <path d="M60 30.5C60 46.9883 46.4883 60.5 30 60.5V53.3516C42.5861 53.3516 52.8516 43.0858 52.8516 30.5C52.8516 25.7538 51.3751 21.1835 48.5975 17.2812L30 35.8788V25.121L43.2187 11.9022C39.3165 9.12488 34.746 7.64844 30 7.64844V0.5C46.4883 0.5 60 14.0117 60 30.5Z" fill="#F40000"/>
                </g>
                <defs>
                <clipPath id="clip0_125_10768">
                <rect width="60" height="60" fill="white" transform="translate(0 0.5)"/>
                </clipPath>
                </defs>
                </svg>
            </div>
            <div class="text-center mt-3 mb-4">
                <h4 class="mb-1">Are you sure want to booking?</h4>
                <div class="d-flex justify-content-center gap-3 py-3">
                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                        <div class="custome_no_btn d-flex align-items-center justify-content-center">No</div>
                    </a>
                    <a href="#" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">
                        <div class="custome_yes_btn d-flex align-items-center justify-content-center" >Yes, I want</div>
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="Cancel_Booking_Modal ">
            <div class="text-end">
                <svg width="22" height="22" data-bs-dismiss="modal" aria-label="Close" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 8L8 14M8 8L14 14M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="delete_svg_bg d-flex align-items-center justify-content-center">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="55" height="55" rx="27.5" fill="#FF0000" fill-opacity="0.3"/>
                    <path d="M24.25 16.75H31.75M16.75 20.5H39.25M36.75 20.5L35.8734 33.6491C35.7419 35.6219 35.6761 36.6083 35.25 37.3563C34.8749 38.0147 34.3091 38.5441 33.6271 38.8746C32.8525 39.25 31.8639 39.25 29.8867 39.25H26.1133C24.1361 39.25 23.1475 39.25 22.3729 38.8746C21.6909 38.5441 21.1251 38.0147 20.75 37.3563C20.3239 36.6083 20.2581 35.6219 20.1266 33.6491L19.25 20.5M25.5 26.125V32.375M30.5 26.125V32.375" stroke="#FF0000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="text-center mt-3 mb-4">
                <h4 class="mb-1">Booking has been cancel successfully!  </h4>
                <div class="d-flex justify-content-center gap-3 py-3">
                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                        <div class="custome_yes_btn d-flex align-items-center justify-content-center" >Back to home</div>
                    </a>
                </div>
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div> -->
    </div>
  </div>
</div>

<script>
  $('.scheduled_page').addClass('active_side');
</script>


@endsection