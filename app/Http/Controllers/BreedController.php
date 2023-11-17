<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Breed;

class BreedController extends Controller
{
    public function index(): JsonResponse
    {
        $breeds = Breed::all();
        return response()->json($breeds);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'average_life_expectancy' => 'required|integer'
        ]);

        $breed = (new Breed)->create($validatedData);
        return response()->json($breed, 201);
    }

    public function show(Breed $breed): JsonResponse
    {
        return response()->json($breed);
    }

    public function update(Request $request, Breed $breed): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'average_life_expectancy' => 'required|integer'
        ]);

        $breed->update($validatedData);
        return response()->json($breed);
    }

  public function destroy($id): JsonResponse
  {
    try {
      $breed = Breed::findOrFail($id);

      // Delete all cats associated with this breed
      $breed->cats()->delete();

      // Now delete the breed
      $breed->delete();

      return response()->json(['message' => 'Breed and associated cats deleted successfully']);
    } catch (ModelNotFoundException $e) {
      return response()->json(['message' => 'Breed not found'], 404);
    } catch (\Exception $e) {
      // Generic exception handling if something else goes wrong
      return response()->json(['message' => 'An error occurred'], 500);
    }
  }

}
