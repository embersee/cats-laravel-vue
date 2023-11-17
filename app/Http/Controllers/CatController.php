<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Cat;

class CatController extends Controller
{
    public function index(): JsonResponse
    {
        $cats = Cat::with('breed')->get();
        return response()->json($cats);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|url',
            'age' => 'required|integer|min:0',
            'breed_id' => 'required|exists:breeds,id'
        ]);
        // Download and save the image
        $imageContents = file_get_contents($validatedData['image']);
        $imageName = 'cats/' . Str::random(40) . '.jpg';
        Storage::disk('public')->put($imageName, $imageContents);

        // Create the Cat with the local image path
        $cat = (new Cat)->create([
            'name' => $validatedData['name'],
            'image' => Storage::url($imageName),
            'age' => $validatedData['age'],
            'breed_id' => $validatedData['breed_id']
        ]);

        return response()->json($cat, 201);
    }

    public function show(Cat $cat): JsonResponse
    {
        return response()->json($cat);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $cat = Cat::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string',  // used to be url, changed since we store the image on local
            'age' => 'required|integer|min:0',
            'breed_id' => 'required|integer|exists:breeds,id'
        ]);

        // Check if the image URL has changed && download and save the new image
        if ($validatedData['image'] !== $cat->image) {
            $imageContents = file_get_contents($validatedData['image']);
            $imageName = 'cats/' . Str::random(40) . '.jpg';
            Storage::disk('public')->put($imageName, $imageContents);
            $validatedData['image'] = Storage::url($imageName);
        }

        // Update the cat with the new data
        $cat->update($validatedData);

        return response()->json($cat);
    }

    public function destroy(Cat $cat): JsonResponse
    {
        $cat->delete();
        return response()->json(null, 204);
    }

}
