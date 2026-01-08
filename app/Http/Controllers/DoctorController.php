<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Condition;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    // Method to update all doctor-related data in one request
    public function updateDoctorData(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'conditions' => 'nullable|array',
            'conditions.*.value' => 'required|string',
            'experiences' => 'nullable|array',
            'experiences.*.name' => 'required|string',
            'experiences.*.from' => 'required|date',
            'experiences.*.to' => 'required|date',
            'languages' => 'nullable|array',
            'languages.*.name' => 'required|string',
            'galleries' => 'nullable|array|max:4',
            'galleries.*' => 'required|image|max:2048', // Validate gallery images
        ]);

        $doctorId = $validated['doctor_id'];

        // Handle conditions
        Condition::where('doctor_id', $doctorId)->delete();
        if (!empty($validated['conditions'])) {
            foreach ($validated['conditions'] as $condition) {
                Condition::create([
                    'doctor_id' => $doctorId,
                    'value' => $condition['value'],
                ]);
            }
        }

        // Handle experiences
        Experience::where('doctor_id', $doctorId)->delete();
        if (!empty($validated['experiences'])) {
            foreach ($validated['experiences'] as $experience) {
                Experience::create([
                    'doctor_id' => $doctorId,
                    'name' => $experience['name'],
                    'from' => $experience['from'],
                    'to' => $experience['to'],
                ]);
            }
        }

        // Handle languages
        Language::where('doctor_id', $doctorId)->delete();
        if (!empty($validated['languages'])) {
            foreach ($validated['languages'] as $language) {
                Language::create([
                    'doctor_id' => $doctorId,
                    'name' => $language['name'],
                ]);
            }
        }

        // Handle galleries (only first 4 images)
        Gallery::where('doctor_id', $doctorId)->delete();
        if (!empty($validated['galleries'])) {
            foreach (array_slice($validated['galleries'], 0, 4) as $imageFile) {
                $imageFilename = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('galleries'), $imageFilename);

                Gallery::create([
                    'doctor_id' => $doctorId,
                    'name' => $imageFilename,
                ]);
            }
        }

        return response()->json(['message' => 'Doctor data updated successfully'], 200);
    }

    // Public method to fetch all doctor-related data
    public function getDoctorConditions($doctorId=0)
    {
        $doctorId=$doctorId?$doctorId:Auth::user()->id;
        $doctorData = [
            'conditions' => Condition::where('doctor_id', $doctorId)->get(),
            'experiences' => Experience::where('doctor_id', $doctorId)->get(),
            'languages' => Language::where('doctor_id', $doctorId)->get(),
            'galleries' => Gallery::where('doctor_id', $doctorId)->get(),
        ];
    
        // Check if the request expects a JSON response
        if (request()->expectsJson()) {
            return response()->json($doctorData);
        }
    // dd($doctorData);
        // Redirect to the conditions route and pass data
        return view('doctor-dashboard.conditions',compact('doctorData'));
    }
     // Public method to fetch all doctor-related data
     public function getDoctorGalleries($doctorId=0)
     {
         $doctorId=$doctorId?$doctorId:Auth::user()->id;
         $doctorData = [
             'conditions' => Condition::where('doctor_id', $doctorId)->get(),
             'experiences' => Experience::where('doctor_id', $doctorId)->get(),
             'languages' => Language::where('doctor_id', $doctorId)->get(),
             'galleries' => Gallery::where('doctor_id', $doctorId)->get(),
         ];
     
         // Check if the request expects a JSON response
         if (request()->expectsJson()) {
             return response()->json($doctorData);
         }
     // dd($doctorData);
         // Redirect to the conditions route and pass data
         return view('doctor-dashboard.galleries',compact('doctorData'));
     }
}
