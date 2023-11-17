<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CatImageController extends Controller
{
    public function fetch(): JsonResponse
    {
        $apiKey = env('THE_CAT_API_KEY');

        $response = Http::withHeaders([
            'x-api-key' => $apiKey
        ])->get('https://api.thecatapi.com/v1/images/search');

        if ($response->successful()) {
            return response()->json([
                'url' => $response->json()[0]['url']
            ]);
        }

        return response()->json(['error' => 'Unable to fetch cat image'], 500);
    }
}
