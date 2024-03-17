<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class ImageController extends Controller
{

    public function showUploadForm()
    {
        return view('user.cost_allocations.create');
    }

    public function uploadImage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the uploaded image file
        $image = $request->file('image');

        // Generate a unique name for the image
        $imageName = time().'.'.$image->extension();

        // Move the image to the public assets directory
        $image->move(public_path('images'), $imageName);

        // Return a success message
        return back()->with('success', 'Image uploaded successfully.');
    }

}

