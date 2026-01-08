

<div class="Dr_details my-3 p-3" data-price="{{ $doctor->price }}" data-gender="{{ strtolower($doctor->gender) }}">
    <div class="row">
        <div class="col-12 col-lg-4 py-3 d-flex align-items-center justify-content-center">
            <div>
                <img src="{{ asset('avatars/' . $doctor->avatar) }}" class="w-100" alt="">
            </div>
        </div>
        <div class="col-12 col-lg-8 py-3">
            <div>
                <div class="d-flex justify-content-between">
                    <div>
                    <h3>Dr. {{ ucwords(strtolower($doctor->first_name.' '.$doctor->last_name)) }}  ({{ ucfirst($doctor->gender)}})  </h3>

                        <div class="d-flex flex-wrap align-items-center mb-3">
                            <h5 class="blue_f mb-0">{{ $doctor->speciality }} </h5>
                            <ul class="mb-0">
                                <li class="blue_f mb-0">{{ $doctor->experience }} Years Exp.</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="rating d-flex align-items-center">
                        
                        <svg width="18" height="18" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" fill="#FFD700" />
</svg>

@if($doctor->reviews)
    {{ round($doctor->reviews->avg('star')+0,1) }}
@endif

@if(isset($reviews))

    {{ round($reviews->avg('star')+0,1) }}

@endif
                        </div>
                        
                    </div>
                </div>
                <div>
                    <p class="grey_f">
                        {{ $doctor->education }}, {{ $doctor->speciality}}
                        <span class="dots">...</span>
                        <span class="more" style="display: none;">{{ $doctor->bio }}</span>
                        <span onclick="myFunction(this)" class="myBtn red_f" style="cursor: pointer;">Read more</span>
                    </p>
                </div>
                <div>
                    <div class="location d-flex align-items-center">
                        <svg width="22" height="22" class="me-2" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 13.2861C2.14864 14.1028 1 15.2409 1 16.4998C1 18.985 5.47715 20.9998 11 20.9998C16.5228 20.9998 21 18.985 21 16.4998C21 15.2409 19.8514 14.1028 18 13.2861M17 6.99976C17 11.0635 12.5 12.9998 11 15.9998C9.5 12.9998 5 11.0635 5 6.99976C5 3.68605 7.68629 0.999756 11 0.999756C14.3137 0.999756 17 3.68605 17 6.99976ZM12 6.99976C12 7.55204 11.5523 7.99976 11 7.99976C10.4477 7.99976 10 7.55204 10 6.99976C10 6.44747 10.4477 5.99976 11 5.99976C11.5523 5.99976 12 6.44747 12 6.99976Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        {{ $doctor->address }}, {{ $doctor->city }}, {{ $doctor->state }} 
                        
                       
                    </div>
                    <div class="location d-flex align-items-center my-2">
                                            <svg width="22" height="20" class="me-2" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.913 15H19.087M11.913 15L10 19M11.913 15L14.7783 9.00902C15.0092 8.52627 15.1246 8.2849 15.2826 8.20862C15.4199 8.14228 15.5801 8.14228 15.7174 8.20862C15.8754 8.2849 15.9908 8.52627 16.2217 9.00902L19.087 15M19.087 15L21 19M1 3H7M7 3H10.5M7 3V1M10.5 3H13M10.5 3C10.0039 5.95729 8.85259 8.63618 7.16555 10.8844M9 12C8.38747 11.7248 7.76265 11.3421 7.16555 10.8844M7.16555 10.8844C5.81302 9.84776 4.60276 8.42664 4 7M7.16555 10.8844C5.56086 13.0229 3.47143 14.7718 1 16" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            {{ $doctor->languages->pluck('name')->implode(', ') }}
                                        </div>
                                        @if (isset($showAppointmentButton) && $showAppointmentButton)
                    <div class="location d-flex align-items-center py-2">
                        <svg width="24" height="24" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 9.99976H3M16 1.99976V5.99976M8 1.99976V5.99976M7.8 21.9998H16.2C17.8802 21.9998 18.7202 21.9998 19.362 21.6728C19.9265 21.3852 20.3854 20.9262 20.673 20.3617C21 19.72 21 18.8799 21 17.1998V8.79976C21 7.1196 21 6.27952 20.673 5.63778C20.3854 5.0733 19.9265 4.61436 19.362 4.32674C18.7202 3.99976 17.8802 3.99976 16.2 3.99976H7.8C6.11984 3.99976 5.27976 3.99976 4.63803 4.32674C4.07354 4.61436 3.6146 5.0733 3.32698 5.63778C3 6.27952 3 7.1196 3 8.79976V17.1998C3 18.8799 3 19.72 3.32698 20.3617C3.6146 20.9262 4.07354 21.3852 4.63803 21.6728C5.27976 21.9998 6.11984 21.9998 7.8 21.9998Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        {{ $doctor->next_available_slot }}
                    </div>
                    @endif
                </div>
                @if (isset($showAppointmentButton) && $showAppointmentButton)
                
                <div class="row mt-3">
                
                    <div class="col-md-6 py-2">
                   
                        <a href="/book-appointment?hashid={{ $doctor->id_sha1 }}" class="link-underline link-underline-opacity-0">
                            <div class="Book_Appointment_btn d-flex justify-content-center align-items-center">Book Appointment</div>
                        </a>

                    </div>
                    <div class="col-md-3 py-2">
                        <a href="" class="link-underline link-underline-opacity-0">
             <div class="Call_Doctor_btn d-flex justify-content-center align-items-center" style="font-size:12px;color:red">Fee : {{round($doctor->price)}}
                
             </div></a>
                </div>
 <div class="col-md-3 py-2">
                                                <a href="https://www.google.com/maps?q={{ $doctor->latitude }},{{ $doctor->longitude }}" target="_blank" class="link-underline link-underline-opacity-0">
                                                 
                                                <div class="Call_Doctor_btn d-flex justify-content-center align-items-center" style="font-size:14px;color:green"> {{($doctor->distance)?round($doctor->distance,2)." KM":""}}  Map <i class="ms-2 fas fa-directions"></i> 
                                                
                                                
                                                </div>
                                                </a>
                                            </div>
                   
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
  
