<?php 
namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|max:4',
            'images.*' => 'image|max:2048',
        ]);
    
        $doctorId = Auth::user()->id;
    
        // Ensure the doctor ID exists
        if (!$doctorId) {
            return response()->json(['success' => false, 'message' => 'Doctor ID not found.'], 200);
        }
    
        // Check the existing number of images for the doctor
        $existingImagesCount = Gallery::where('doctor_id', $doctorId)->count();
    
        if ($existingImagesCount >= 4) {
            return response()->json(['success' => false, 'message' => 'You can only upload a maximum of 4 images.'], 200);
        }
    
        // Store each image
        foreach ($request->file('images') as $image) {
            // Generate a unique filename
            $imageFilename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Check if the image filename already exists
            $existingImage = Gallery::where('doctor_id', $doctorId)
                                     ->where('name', $imageFilename)
                                     ->first();
    
            if ($existingImage) {
                return response()->json(['success' => false, 'message' => 'Image already exists.'], 200);
            }
    
            // Move the image to the galleries directory
            $image->move(public_path('galleries'), $imageFilename);
    
            // Attempt to create a new Gallery record
            try {
                Gallery::create([
                    'doctor_id' => $doctorId,
                    'name' => $imageFilename,
                ]);
            } catch (\Illuminate\Database\QueryException $ex) {
                return response()->json(['success' => false, 'message' => 'Database error: ' . $ex->getMessage()], 200);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Images uploaded successfully.'], 200);
    }
    
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->doctor_id !== Auth::user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 200);
        }

        $imagePath = public_path('galleries/' . $gallery->name);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $gallery->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.'], 200);
    }
}
