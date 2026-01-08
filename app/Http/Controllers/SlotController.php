<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class SlotController extends Controller
{
    /**
     * Display a listing of the slots.
     */
    public function index(Request $request)
    {
        $slots = Slot::all();

        // API Response
        if ($request->wantsJson()) {
            return response()->json($slots);
        }

        // Web View
        return view('doctor-dashboard.addSlot', compact('slots'));
    }

    /**
     * Show the form for creating a new slot.
     */
    public function create()
    {
        // Web View
        return view('slots.create');
    }

    /**
     * Store a newly created slot in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'time_slot' => 'required|string|max:255',
        ]);

        $slot = Slot::create($validated);

        // API Response
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Slot created successfully', 'slot' => $slot], 200);
        }

        // Web View
        return redirect()->route('addSlot')->with('success', 'Slot created successfully');
    }

    /**
     * Display the specified slot.
     */
    public function show(Request $request, $id)
    {
        $slot = Slot::with('doctor')->findOrFail($id);

        // API Response
        if ($request->wantsJson()) {
            return response()->json($slot);
        }

        // Web View
        return view('slots.show', compact('slot'));
    }

    /**
     * Show the form for editing the specified slot.
     */
    public function edit($id)
    {
        $slot = Slot::findOrFail($id);

        // Web View
        return view('slots.edit', compact('slot'));
    }

    /**
     * Update the specified slot in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'time_slot' => 'required|string|max:255',
        ]);

        $slot = Slot::findOrFail($id);
        $slot->update($validated);

        // API Response
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Slot updated successfully', 'slot' => $slot]);
        }

        // Web View
        return redirect()->route('addSlot')->with('success', 'Slot updated successfully');
    }

    /**
     * Remove the specified slot from storage.
     */
    public function destroy(Request $request, $id)
    {
        $slot = Slot::findOrFail($id);
        $slot->delete();

        // API Response
       
            return response()->json(['message' => 'Slot deleted successfully','success'=>true],200);
       

    }
//for only mobile app all slots
public function getDoctorSlots(Request $request, $doctor_id = null)
{
    try {
        // Use the provided doctor_id or the authenticated user's ID
        $doctorId = $doctor_id ?? Auth::id();

        // Fetch slots for the given doctor ID
        $slots = Slot::where('doctor_id', $doctorId)->get();

        // Check if any slots exist
        if ($slots->isEmpty()) {
            $message = 'No slots found for this doctor.';
            // Return response based on request type
            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => $message], 200)
                : view('doctor-dashboard.slots', ['slots' => [], 'message' => $message]);
        }

        // Return slots based on request type
        return $request->expectsJson()
            ? response()->json(['slots' => $slots], 200)
            : view('doctor-dashboard.slots', ['slots' => $slots]);

    } catch (\Exception $e) {
        $errorMessage = 'An error occurred while fetching slots.';
        // Handle error based on request type
        return $request->expectsJson()
            ? response()->json(['message' => $errorMessage, 'error' => $e->getMessage()], 500)
            : back()->withErrors(['error' => $errorMessage]);
    }
}

}
