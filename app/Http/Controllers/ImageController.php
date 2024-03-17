<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;


class ImageController extends Controller
{
    public function saveImage(Request $request)
    {
        // Get the image data from the request
        $imageData = $request->input('image');

        // Remove the data URI prefix and decode the base64-encoded image data
        $img = str_replace('data:image/png;base64,', '', $imageData);
        $img = str_replace(' ', '+', $img);
        $decodedImg = base64_decode($img);

        // Generate a unique filename for the image
        $filename = 'expense_details_' . time() . '.png';

        // Save the image to the public assets folder
        $path = public_path('images/' . $filename);
        file_put_contents($path, $decodedImg);

        // Optionally, you can return a response indicating success or failure
        if ($path) {
            return response()->json(['message' => 'Image saved successfully', 'path' => $path], 200);
        } else {
            return response()->json(['message' => 'Failed to save image'], 500);
        }
    }
}

