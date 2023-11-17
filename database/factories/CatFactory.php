<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Cat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class CatFactory extends Factory
{
  protected $model = Cat::class;

  public function definition(): array
  {
    $imageUrl = $this->fetchCatImageUrl();

    return [
      'name' => $this->faker->name,
      'image' => $imageUrl,
      'age' => $this->faker->numberBetween(1, 15),
      'breed_id' => Breed::pluck('id')->random()
    ];
  }

  private function fetchCatImageUrl(): string
  {
    $apiKey = env('THE_CAT_API_KEY');
    $response = Http::withHeaders([
      'x-api-key' => $apiKey
    ])->get('https://api.thecatapi.com/v1/images/search');

    if ($response->successful() && count($response->json()) > 0) {
      return $response->json()[0]['url'];
    }

    return 'default-image-url'; // Fallback image URL
  }
}
