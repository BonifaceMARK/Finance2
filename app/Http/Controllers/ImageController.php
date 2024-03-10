<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;


class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('admin.receipt.index', compact('images'));
    }

    public function create()
    {
        $images = Image::all();
        return view('admin.receipt.create', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Optionally, you can save the image path to the database here

        return view('admin.receipt.index', ['imagePath' => 'images/' . $imageName]);
    }
    public function destroy($id)
{
    $image = Image::findOrFail($id);
    $image->delete();

    return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
}
}

