<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Mail;
use App\Models\Alllanguage;
use App\Models\State;
use App\Models\City;
use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class LocalityController extends Controller
{
     // Fetch all countries
     public function getCountries()
     {
         $countries = Country::all()->pluck('name');
         return response()->json($countries);
     }
 
     // Fetch states for a given country
     
     // Fetch cities for a given state
     public function getCities($state)
     {
         $state = State::where('name', $state)->first();
         if (!$state) {
             return response()->json([]);
         }
         $cities = $state->cities->pluck('name');
         return response()->json($cities);
     }


     
     public function getAllCities(Request $request)
     {
         $query = $request->input('query', '');
     
         // Build the query to get cities based on the country (id=101)
         $citiesQuery = DB::table('cities')
             ->whereIn('state_id', function ($query) {
                 $query->select('id')
                       ->from('states')
                       ->where('country_id', 101);
             })
             ->orderBy('name', 'asc');
     
         // If a search query is provided, filter the cities case-insensitively
         if ($query) {
             // Make both the column and query lowercase for case-insensitive matching
             $citiesQuery->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower($query) . '%');
         }
     
         // Get the cities from the query
         $cities = $citiesQuery->get();
     
         return response()->json($cities);
     }
     
     public function getStates(Request $request)
{
    $query = $request->input('query', '');

    // Build the query to get states based on the country (id=101)
    $statesQuery = DB::table('states')
        ->where('country_id', 101) // Filter for country 101
        ->orderBy('name', 'asc');

    // If a search query is provided, filter the states case-insensitively
    if ($query) {
        $statesQuery->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower($query) . '%');
    }

    // Get the states from the query
    $states = $statesQuery->get();

    // Check for authenticated user
    $user = auth()->check() ? auth()->user() : null;

    return response()->json([
        'states' => $states,
        'userState' => $user ? $user->state : null,
        'userCity' => $user ? $user->city : null,
    ]);
}


public function getLocationByIP()
{
    // Use the client's IP or use a custom IP for testing
    $ip = request()->ip();  // or set to a custom IP for testing, like '8.8.8.8'

    // Call the API to get the geolocation data
    $response = Http::get("http://ip-api.com/json/{$ip}");

    // Check for success
    if ($response->successful()) {
        $data = $response->json();

        // You can retrieve details such as the city, country, region, latitude, and longitude.
        $location = [
            'city' => $data['city'],
            'region' => $data['regionName'],
            'country' => $data['country'],
            'latitude' => $data['lat'],
            'longitude' => $data['lon']
        ];

        return response()->json($location);
    }

    return response()->json(['error' => 'Unable to fetch location'], 400);
}
public function listLanguages()
{
    $languages  = DB::table('alllanguages')->get()->pluck('name');
    return response()->json($languages);
}

public function getCity(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Use a helper function or API to get the city name
        $city = $this->getCityNameFromCoordinates($latitude, $longitude);

        if ($city) {
            return response()->json(['city' => $city], 200);
        }

        return response()->json(['error' => 'Unable to fetch city name.'], 400);
    }

    // Helper function to fetch city name
    private function getCityNameFromCoordinates($latitude, $longitude)
    {
        // Use Geocoding API or any service to fetch city name
        $apiKey = "AIzaSyAkVY54ZKvhxyMy9fJzcK2LS1uIUxVdwEU"; // Ensure you have this in your .env file
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['results'][0]['address_components'])) {
            foreach ($data['results'][0]['address_components'] as $component) {
                if (in_array('locality', $component['types'])) {
                    return $component['long_name'];
                }
            }
        }

        return null;
    }


    public function submitContactForm(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);
    
        // Capitalize first name and last name
        $firstName = ucwords(strtolower($validatedData['first_name']));
        $lastName = ucwords(strtolower($validatedData['last_name']));
    
        // Store the validated data in the contact_forms table
        $contactForm = ContactForm::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'message' => $validatedData['message'],
            'status' => 'Pending', // Default status
        ]);
    
        // Optionally, send an email notification
        // Mail::send('emails.contact', $validatedData, function ($message) use ($validatedData) {
        //     $message->to('support@easygo.com')
        //             ->subject('New Contact Form Submission');
        // });
    
        // Return a success response
        return response()->json(['success' => true, 'message' => 'Form submitted successfully!', 'data' => $contactForm], 201);
    }
    public function contactForms(Request $request)
{
    $query = ContactForm::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('message', 'like', '%' . $search . '%')
              ->orWhere('first_name', 'like', '%' . $search . '%')
              ->orWhere('last_name', 'like', '%' . $search . '%');
        });
        
    }

    $contactForms = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 10));

    return view('admin.contact-forms', compact('contactForms'));
}

}
